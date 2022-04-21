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
    require_once ('../view/login-form.php');

    #echo '<p>POST<br>' . print_r($_POST) . '</p>';
    #echo '<p>SESSION: '. print_r($_SESSION['proteinBar']) . '</p>';
 
    $quantity = $_POST['quantity'];
    $proteinBar = unserialize($_SESSION['proteinBar']);

    if (isset($_SESSION['customer']) == false) {
        $_SESSION['redirectPage'] = '../control/process-order.php'; #$_SERVER['SCRIPT_NAME'];
        #echo 'previous page ' . $_SESSION['previousPage'];
        #echo 'script name: ' . $_SERVER['SCRIPT_NAME'];
        header('../view/login-form-php'); #'../view/login-form.php');       
    }
    else {
        $customer = unserialize($_SESSION['customer']);
        echo $customer->to_table() . '<br>';
        $cards = $customer->get_cards();
        echo '<br>' . $cards->to_table();
    }

    function credit_card_selector($cards) {
        $elem = '<label for="credit-card-selector">Pick your shoe size</label>';
        $elem .= '<select id="credit-card-selector" name=""credit-card-selector" form="shoe-order-form">';
        $elem .= '<option value="">Select a Payment Method</option>';

        foreach ($cards as $id => $card) {
            $elem .= '<option value="' . $id . '">' . $card->to_string() . '</option>';
        }
        $elem .= '</select>';
        return $elem;
    }
?>

