<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (QUERY_PATH . '/customer-queries.php'); #'../db/customer-queries.php');

    echo print_r($_POST);
    echo print_r($_SESSION);
    
    $customer = unserialize($_SESSION['customer']);

    

    
?>