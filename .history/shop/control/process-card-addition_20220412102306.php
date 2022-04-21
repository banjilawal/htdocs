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


    $customer = unserialize($_SESSION['customer']);
    echo $customer->to_table() . '<br>' . $customer->get_cards()->to_table();

    $customerID = $customer->get_id();

    insert_credit_card ($customer, $cardID, $expiration, $code);
    $customer = customer_query($customerID);

    echo 'AFTER CARD INSERT<br>';
    echo $customer->get_cards()->to_table();
?>