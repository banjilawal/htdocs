<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');

    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once ('../db/protein-bar-queries.php');

    #echo '<p>POST<br>' . print_r($_POST) . '</p>';
    #echo '<p>SESSION: '. print_r($_SESSION['proteinBar']) . '</p>';
 
    $quantity = $_POST['quantity'];
    $proteinBar = unserialize($_SESSION['proteinBar']);

    $new orderItem = orderItem


    if (isset($_SESSION['customer']) == false) {
        $_SESSION['previousPage'] = $_SERVER['SCRIPT_NAME'];
        #echo 'previous page ' . $_SESSION['previousPage'];
        #echo 'script name: ' . $_SERVER['SCRIPT_NAME'];
        header('../view/login-form.php');       
    }
    else {
        $customer = unserialize($_SESSION['customer']);
        echo $customer->to_table() . '<br>';
        $cards = $customer->get_cards();
        echo '<br>' . $cards->to_table();
    }
?>