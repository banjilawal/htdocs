<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('customer-queries.php');

    session_start();

    $username = is_set($_POST['username']);
    $password = is_set($_POSt['password'];

    function login ()

    
?>