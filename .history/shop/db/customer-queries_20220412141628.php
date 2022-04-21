<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/customerOrderItem.php');
    require_once (MODEL_PATH . '/order.php');

    $customer = null;

    function customer_query ($customerID) {
        $mysqli = db_connect();
        $customer = new Customer();

        $query = 'SELECT id, firstname, lastname, birthdate, email, phone, '
            . 'street, city, state, zip FROM shop.customers WHERE id = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $customerID);
        $stmt->execute();

        $stmt->bind_result($id, $firstname, $lastname, $birthdate, $email, $mobile, $street, $city, $state, $zip);

        while ($stmt->fetch()) {
            $phone = new Phone ();
            $phone->string_to_phone($mobile);
    
            $address = new PostalAddress();
            $address->zip($zip)->state($state)->city($city)->street($street);

            $customer->id($customerID);
            $customer->address($address)->phone($phone);
            $customer->birthdate((new DateTime($birthdate)));
            $customer->firstname($firstname)->lastname($lastname)->email($email);
        }
        $mysqli->close();

        $cards = customer_cards_query($customer);
        $customer->cards($cards);
        return $customer;
    }


    function customer_cards_query ($customer) {
        $creditCardBag = new CreditCardBag();
        $customerID = $customer->get_id();
        $mysqli = db_connect();

        $query = 'SELECT c.id, c.expiration, c.securityCode '
            . 'FROM shop.customers p INNER JOIN shop.cards c '
            . 'ON p.id = c.customerID WHERE p.id = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $customerID);
        $stmt->execute();
        $stmt->bind_result($cardID, $expiration, $securityCode);

        while ($stmt->fetch()) {
            $card = new Creditcard();

            $card->number($cardID);
            $card->security_code($securityCode);
            $card->expiration((new DateTime($expiration)));

            $creditCardBag->add($card);
        }
        $mysqli->close();
        $customer->cards($creditCardBag);
        return $creditCardBag;
    }

    function customer_orders_query ($customer) {
        $customerID = $customer->get_id();
        $orderBag = new OrderBag();
        $mysqli = db_connect();

        $query = 'SELECT o.id orderID, submissionDate, actualDeliveryDate, status, total '
            . ' FROM shop.orders o INNER JOIN shop.customers c '
            . ' ON o.customerID = c.id WHERE c.id = ?' 
           . ' ORDER BY submissionDate DESC';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $customerID);
        $stmt->execute();

        $stmt->bind_result($id, $submissionDate, $actualDelivery, $status, $total);

        while ($stmt->fetch()) {
            $order = new Order();
            $order->id($id);
            $order->status($status);
            $order->customer($customer);

            $order->submission_date(new DateTime($submissionDate));
            $order->actual_delivery(new DateTime($actualDelivery));
            $items = customer_order_details_query($order);

            $orderBag->add($order);
        }
        $mysqli->close();
        echo $orderBag;
        return $orderBag;

    }
    #$orders = customer_orders_query($customer);
    #echo $orders->to_table();
    #$order = $orders->search('GJSEB-15315-UAKU-563');
    #echo $order;

    function customer_order_details_query ($order) {
        $orderItemBag = new OrderItemBag();
        $orderID = $order->get_id();
        $mysqli = db_connect();

        $query = 'SELECT p.id, p.name, p.description, p.grams, p.retailPrice unitCost, '
            . 'i.quantity, i.charge cost FROM shop.orders o '
            . 'INNER JOIN shop.orderItems i INNER JOIN shop.products p '
            . 'ON i.productID = p.id WHERE o.id = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $orderID);
        $stmt->execute();

        $stmt->bind_result($proteinBarID, $proteinBarName, $description, $grams, $retailPrice, $quantity, $cost);

        while ($stmt->fetch()) {
            $proteinBar = new ProteinBar();
            $proteinBar->id($proteinBarID);
            $proteinBar->name($proteinBarName)->grams($grams);
            $proteinBar->description($description)->retailPrice($retailPrice); 
    
            $orderItem = (new OrderItem())->proteinBar($proteinBar)->quantity($quantity);
            $orderItemBag->add($orderItem);
        }
        $order->items($orderItemBag);
        $mysqli->close();
        return $orderItemBag;
    }

    function customer_proteinbar_query ($customer) {
        $customerID = $customer->get_id();
        $bag = new CustomerOrderItemBag();
        $bag->customerID($customerID);
        $mysqli = db_connect();

        $query = 'SELECT p.id productID, name, description, grams, retailPrice unitCost, quantity, '
            . 'o.id orderID, o.actualDeliveryDate, o.status, i.charge cost '
            . 'FROM shop.customers c INNER JOIN shop.orders o INNER JOIN shop.orderItems i '
            . 'INNER JOIN shop.products p ON i.productID = p.id ON o.id = i.orderID ON c.id = o.customerID '
            . 'WHERE c.id = ? AND o.status <> \'cancelled\''
            . 'ORDER BY o.actualDeliveryDate DESC';
        
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $customerID);
        $stmt->execute();

        $stmt->bind_result($barID, $name, $description, $grams, $retailPrice, $quantity, $orderID, $deliveryDate, $status, $cost);

        while ($stmt->fetch()) {
            $proteinBar = new ProteinBar();
            $proteinBar->id($barID);
            $proteinBar->name($name)->grams($grams);
            $proteinBar->description($description)->retailPrice($retailPrice); 
            $orderItem = (new OrderItem())->proteinBar($proteinBar)->quantity($quantity);

            $thing = new CustomerOrderItem ();
            $thing->status($status);
            $thing->item($orderItem);
            $thing->orderID($orderID);
            $thing->arrivalDate((new DateTime($deliveryDate)));

            $bag->add($thing);
        }
        $mysqli->close();
        return $bag;
    }   
    #$orderItems = customer_order_details_query($customer, $order);
    #echo $orderItems->to_table();

    function update_address ($customer, $street, $city, $state, $zip) {
        $customerID = $customer->get_id();
        $mysqli = db_connect();

        $query = 'UPDATE shop.customers SET street = ?, city = ?, state = ?, zip = ? WHERE id = ?';
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('sssss', $street, $city, $state, $zip, $customerID);
        $stmt->execute();
    }

    function insert_credit_card ($customer, $cardID, $expiration, $securityCode) {
        $customerID = $customer->get_id();
        $mysqli = db_connect();

       # echo 'customerID: ' . $customerID . ' cardID: ' . $cardID . ' expiration: ' . $expiration . ' code: ' . $securityCode . '<br>';
        $query = 'INSERT INTO shop.cards VALUES (customerID, id, expiration, securityCode) VALUES (?, ?, ?, ?)';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssss', $customer, $cardID, $expiration, $securityCode);
        $stmt->execute();
    }

    function assign_customer_id () {
        $mysqli = db_connect();
        $result = $mysqli->query('SELECT id FROM shop.available_customer_ids ORDER BY number LIMIT 1');
        $row 

        echo $id;
        print_r($id);
    }

    function insert_customer () {
        $mysqli = db_connect();

       # echo 'customerID: ' . $customerID . ' cardID: ' . $cardID . ' expiration: ' . $expiration . ' code: ' . $securityCode . '<br>';
        $query = 'INSERT INTO shop.customers (firstname, lastname, birthdate, phone, email, street, city, tate, zip) '
            . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('sssssssss', $firstname, $lastname, $birthdate, $phone, $email, $street, $city, $state, $zip);
        $stmt->execute();      
    }
  
?>