<?php
    session_start();
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once ('../db/customer-queries.php');

    #$id = $_COOKIE['id']; 

    $customer = customer_query('CN-27-QQN-P3');
    $orderBag = customer_orders_query($customer);
    $order = $orderBag->search('GJSEB-15315-UAKU-563');
    echo $order->to_table();


?>


<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>   
<header>
    <?php echo '<h1>' . $customer->get_firstname() . ' ' .  $customer->get_lastname() . '</h1>'; ?>
</header>

<main>
    <?php 
        echo '<h1>' . $customer->get_firstname() . ' ' .  $customer->get_lastname() . '</h1>'; 
        echo '<p>' . $customer->to_table() . '</p>';
        echo '<h2>Order History</h2><br>';
        echo $orderBag->to_table();

    ?>


    <script>
        //function launch_review_process () { location.href = ""; } 
        -function launch_order_process () { location.href = ""; }
    </script>
</main>

</body>
<html>