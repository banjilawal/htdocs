<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (QUERY_PATH . '/customer-queries.php');
    #require_once (WEB_PAGE_PATH . '/customer.php'); #' . '../display/customer.php');

    if (preg_match("/registration/i",$_SERVER['HTTP_REFERER'])) {
    }
    else if (preg_match("/welcome/i",$_SERVER['HTTP_REFERER'])) {

    }
    else {
        if (isset($_POST['email'])) $email =  $_POST['email'];
        if (isset($_POST[]))$password = $_POST['pass'];
    }

    print_r($_POST) . '<p></p>';
    echo 'redirect to ' . $_SESSION['redirectPage'];



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

    if (is_null($customerID)) {
        echo "No customer exists with those login credentials";
    }
    else {
        $cookieName = 'customerID';
        setcookie('customerID', $customerID, time()+3600); 
        #$customer = customer_query($customerID);
        $_SESSION['customer'] = serialize(customer_query($customerID));
        print_r($_SESSION['customer']);
        print_r($_COOKIE);
    }    

    if (isset($_SESSION['redirectPage'])) {
        echo 'redirect to: ' . $_SESSION['redirectPage'];
        header($_SESSION['redirectPage']);
    }
    else {
        header(WEB_PAGE_PATH . '../display/customer.php');
    }


?>