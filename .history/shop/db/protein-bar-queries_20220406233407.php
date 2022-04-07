<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('customer-queries.php');

    function review_query ($proteinBar) {
        $mysqli = db_connect();
        $proteinBarID = $proteinBar->get_id();

        $bag = new ReviewBag();
        $bag->proteinBarID($proteinBarID);

        $query = 'SELECT c.id customerID, firstname, lastname, birthdate, email, phone, street, city, '
            . 'state, zip, r.id reviewID, r.stars, r.comments, r.timestamp, p.id productID, name, description, grams, '
            . 'retailPrice FROM shop.products p INNER JOIN shop.product_reviews r INNER JOIN shop.customers c '
             .'ON r.customerID = c.id ON p.id = r.productID WHERE p.id = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $proteinBarID);
        $stmt->execute();

        $stmt->bind_result(
            $customerID, $firstname, $lastname, $birthdate, $email, $mobile, $street, 
            $city, $state, $zip, $reviewID, $stars, $comments, $timestamp, $productID
        );

        while ($stmt->fetch()) {
            $phone = new Phone ();
            $phone->string_to_phone($mobile);
    
            $address = new PostalAddress();
            $address->zip($zip)->state($state)->city($city)->street($street);

            $customer = new Customer();
            $customer->id($customerID);
            $customer->address($address)->phone($phone);
            $customer->birthdate((new DateTime($birthdate)));
            $customer->firstname($firstname)->lastname($lastname)->email($email);

            $review = new Review();
            $review->id($reviewID)
            $review->stars($stars)

        }
        $mysqli->close();
        $items = order_details_query($order);
        return $order;
    }
    $order = order_query('ULJNT-28040-DNWB-553');

    function order_details_query ($order) {
        $mysqli = db_connect();
        $orderID = $order->get_id();
        $bag = new orderItemBag ();

        $bag->orderID($orderID);

        $query = 'SELECT p.id productID, name, description, grams, retailPrice unitCost, quantity, '
            . 'i.charge cost FROM shop.orders o INNER JOIN shop.orderItems i '
            . 'INNER JOIN shop.products p ON i.productID = p.id ON o.id = i.orderID '
            . 'WHERE o.id = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $orderID);
        $stmt->execute();

        $stmt->bind_result($proteinBarID, $name, $description, $grams, $unitCost, $quantity, $cost);

        while ($stmt->fetch()) {
            $proteinBar = new ProteinBar();
            $proteinBar->id($proteinBarID);
            $proteinBar->name($name)->grams($grams);
            $proteinBar->description($description)->retailPrice($unitCost); 
    
            $orderItem = new OrderItem();
            $orderItem->proteinBar($proteinBar)->quantity($quantity);

            $bag->add($orderItem);
        }
        $mysqli->close();
        $order->items($bag);
        return $bag;
    }
    #$items = order_details_query($order);
    #echo '<p>' . $items->to_table() . '</p>';
    #echo $order->to_table();
?>