<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once ('../display/customer.php');

    session_start();

    print_r($_POST) . '<p></p>';

    $email = $_POST['email'];
    $password = $_POST['pass'];

    function login ($email, $password) {
        $mysqli = db_connect();

        echo '<br><br>email: ' . $email . '<br>pass: ' . $password . '<br>';

        $query = 'SELECT c.id FROM shop.customer_accounts a INNER JOIN shop.customers c ON a.username = c.username WHERE c.email = ? AND pass = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();

        $stmt->bind_result($customerID);
        while ($stmt->fetch()) {
            $customerID;
            $cookieName = 'customerID';
            setcookie($cookieName, $customerID);
            print_r($_COOKIE);
        }
        $mysqli->close();
        return $customerID;
    }
    $customerID = login($email, $password);
    echo 

    if (is_null($customerID)) {
        echo "No customer exists with those login credentials";
    }
    #else {


        #header('customer.php');
    #}    
?>