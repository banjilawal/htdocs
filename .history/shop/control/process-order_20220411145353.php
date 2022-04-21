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
    #require_once ('../view/login-form.php');

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
        echo $cards-> to_selector();
        echo '<br>' . $cards->to_table();
    }
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>   
<header>
  #  <h1>Select Your Credit Card</h1>
</header>

<main>

<for
    <?php 
       
    ?>
  
</main>

</body>
<html>