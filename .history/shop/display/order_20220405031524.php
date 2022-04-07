<?php
    session_start();
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('../db/order-queries.php');

    print_r($_COOKIE);
    $id = $_COOKIE['orderID']; 

    $order = order_query($id);
    $orderItemBag = order_details_query($order);
    #echo $orderItems->to_table();  
?>


<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php echo '<title>' . $order->get_id() .  '</title>'; ?>
</head>

<body>   
<header>
    <?php echo '<h1>' .  $order->get_id() .  '</h1>'; ?>
</header>

<main>
    <?php 
        echo '<h1>' . $order->get_id() . '</h1>'; 
        echo $order->to_table() .
    ?>


    <script>
        function launch_review_process () { location.href = "complete-review.php"; } 
        function launch_order_process () { location.href = "../view/fill-order-form.php"; }
    </script>
</main>

</body>
<html>