<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('customer-queries.php');

    session_start();

    $username = isset($_POST['username']) ?? 'nobody';
    $password = isset($_POSt['password']) ?? 'nopass';

    function login ($username, $password) {
        

    }

    
?>