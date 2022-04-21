<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once ('../display/customer.php');

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
        }
        $mysqli->close();
        return $customerID;
    }
    $customerID = login($email, $password);
    echo $customerID; 

    if (isset($_SESSION['previousPage'])) {
        header($_SESSION['previousPage']);
    }
    else 

    if (is_null($customerID)) {
        echo "No customer exists with those login credentials";
    }
    #else {
        $cookieName = 'customerID';
        setcookie('customerID', $customerID, time()+3600); 
        print_r($_COOKIE);
        header('customer.php');
    #}    
?>