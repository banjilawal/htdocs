<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('customer-queries.php');

    session_start();

    $username = isset($_POST['username']) ?? 'nobody';
    $password = isset($_POSt['password']) ?? 'nopass';

    function login ($username, $password) {
        $mysqli = db_connect();
        $ = new Order();

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

    
?>