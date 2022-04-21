<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('customer-queries.php');

    function order_query ($orderID) {
        $mysqli = db_connect();
        $order = new Order();

        $query = 'SELECT id, submissionDate, estimatedDeliveryDate, actualDeliveryDate, '
            . ' status, customerID FROM shop.orders WHERE id = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $orderID);
        $stmt->execute();

        $stmt->bind_result($id, $submitDate, $estimatedDelivery, $actualDelivery, $status, $customerID);

        while ($stmt->fetch()) {
            $order->id($id);
            $order->status($status);
            $order->submission_date(new DateTime($submitDate));
            $order->actual_delivery(new DateTime($actualDelivery));
            $order->customer(customer_query($customerID));
        }
        $mysqli->close();
        $items = order_details_query($order);
        return $order;
    }

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

    function insert_order () {
        $mysqli = db_connect();

        $query = ' CALL shop.orderID_sp(@id);';
        $mysql-

    }
    #$items = order_details_query($order);
    #echo '<p>' . $items->to_table() . '</p>';
    #echo $order->to_table();
?>