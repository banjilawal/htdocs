<?php
    session_start();
    require_once ('../bootstrap.php');

    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once ('../control/process-order.php');
    require_once ('../db/protein-bar-queries.php');

    $quantity = $_POST['quantity'];
    $proteinBar = unserialize($_SESSION['proteinBar']);
    $customer = unserialize($_SESSION['customer']);

    echo $customer->to_table()

    $cards = $customer->get_cards();
    echo $cards->to_table();
?>