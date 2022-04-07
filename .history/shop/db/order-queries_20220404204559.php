<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('customer-queries.php');

    $customer = null;

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
        return $order;
    }
    $order = order_query('ULJNT-28040-DNWB-553');

    function order_items_query ($order, $customer) {
        $mysqli = db_connect();

        $orderID = $order->get_id();
        $customerID = $customer->

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
        return $order;
    }
    $order = order_query('ULJNT-28040-DNWB-553');
?>