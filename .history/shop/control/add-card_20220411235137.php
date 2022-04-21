<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (QUERY_PATH . '/customer-queries.php'); #'../db/customer-queries.php');

    $id = $_POST['cardID'];
    $expiration = $_POST['expiration'];
    $code = $_POST['code'];

    echo 'PRIOR CARD INSERT<br>';

    $customer = unserialize($_SESSION['customer']);
    echo $customer->to_table() . '<br>' . $customer->get_cards()->to_table();
    $id = $customer->get_id();

    echo '<p>old address: ' . $customer->get_address() . '</p>'; 

    insert_credit_card ($customer, $number, $expiration, $code);
    $customer = customer_query($id);

    echo $customer->to_table();
?>