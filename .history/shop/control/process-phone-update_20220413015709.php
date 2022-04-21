<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (QUERY_PATH . '/customer-queries.php'); #'../db/customer-queries.php');

    $phone = $_POST['zip'];
    
    $customer = unserialize($_SESSION['customer']);
    $id = $customer->get_id();

    echo '<p>old phone: ' . $customer->get_phone() . '</p>'; 

    update_phone($customer, $phone);
    $customer = customer_query($id);

    echo $customer->to_table();
?>