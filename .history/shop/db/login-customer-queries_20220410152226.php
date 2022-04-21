<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('customer-queries.php');

    session_start();

    print_r($_POST) . '<p></p>';

    $email = $_POST['email'];
    $password = $_POST['pass'];

    function login ($email, $password) {
        $mysqli = db_connect();
        $customer = null;

        echo '<br><br>email: ' . $email . '<br>pass: ' . $password . '<br>';

        $query = 'SELECT c.id FROM shop.customer_accounts a INNER JOIN shop.customers c ON a.username = c.username WHERE c.email = ? AND pass = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();

        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            $customer = customer_query($id);
        }
        $mysqli->close();
        return $customer;
    }
    $customer = login($email, $password);

    if (is_null($customer)) {
        echo "No customer exists with those login credentials";
    }
    else {
        
    }



    
?>