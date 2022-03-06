<?php
    session_start();
    //print_r($_SESSION);
    require("shoe-generator.php");
    require("order-verification.php");

    //$orderData = $_SESSION['order'];
    //$shoeData = $_SESSION['shoe'];


    $shoe = new Shoe();
    $order = new Order($shoe);
    

    //$order = unserialize($orderData);
    //$shoe = $order->get_shoe();


?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <?php
        echo '<title>Sneakers and Heels Shoe</title>';
    ?>
</head>

<body>   >
<header>
    <?php
        echo '<h1>Thank You For Your Order</h1>';
    ?>
</header>

<main>
    <?php
        echo '<p>'. $order . '</p>';
        echo 'Submitted on ' . date('H:i, jS F Y');
    ?>
</main>
</body>
<html>