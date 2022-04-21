<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (QUERY_PATH . '/customer-queries.php');

    $cardID = $_POST['cardID'];
    $expiration = $_POST['expiration'];
    $code = $_POST['code'];
    
#echo 'cardID: ' . $cardID . ' expiration: ' . $expiration . ' code: ' . $code . '<br>';

    $customer = unserialize($_SESSION['customer']);
    echo '<h2>Old Credit Card Information for ' . $customer->get_firstname() . ' ' . $customer->get_lastname() . '</h2>';
    echo '<p>' . $customer->get_cards()->to_table() . '</p>';

    $customerID = $customer->get_id();
    insert_credit_card ($customer, $cardID, $expiration, $code);

// Get the customer's information again.
    $customer = customer_query($customerID);
/*
    echo '<h2>Updated  Credit Card Information for ' . $customer->get_firstname() . ' ' . $customer->get_lastname() . '</h2>';
    echo '<p>' . $customer->get_cards()->to_table() . '</p>';
    echo $customer->get_cards()->to_table();
*/
?>