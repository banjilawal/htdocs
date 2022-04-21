<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('customer-queries.php');

    session_start();

    print_r($_POST) . '<p></p>';

    $email = isset($_POST['email']) ?? 'nobody';
    $password = isset($_POSt['password']) ?? 'nopass';

    function login ($email, $password) {
        $mysqli = db_connect();
        $customer = null;

        $query = 'SELECT a.username, a.pass, c.id customerID, firstname, lastname, '
            . 'birthdate, email, phone, street, city, state, zip FROM shop.customer_accounts a '
            . 'INNER JOIN shop.customers c ON a.username = c.username'; # WHERE c.email = ?'; # = ? AND pass = ?';

        #$stmt = $mysqli->prepare($query);
        #$stmt->bind_param('s', $email); #, $password);
        #$stmt->query->execute();

        $result = $mysqli->query

        $rowCount = $stmt->affected_rows;
        echo $rowCount . ' rows' . '<br>';

        /*
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
*/
    }
    login($email, $password);

    
?>