<?php
    session_start();
    require_once("../model/order.php");
    require_once("../model/orderItem.php");
    require_once("../model/proteinBar.php");

    $shoe = unserialize($_SESSION['shoe']);
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];

    $order = new Order($shoe, $size, $quantity);

    $_SESSION['order'] = NULL;
    $_SESSION['order'] = serialize($order);

    $title = 'Please Verify the Information About Your Order Is Correct';
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <?php
        echo '<title>' .  $title . '</title>';
    ?>
</head>

<body>
<header>
    <?php
        echo '<h1>' . $title . '</h1>';
    ?>
</header>

<main>
    <form id="order-verification-form" name="order-verification-form" method="post" action="ship-order.php">
        <?php
            echo '<p>' . $order . '</p>';
            echo $order->to_table();
        ?>
        <input id="verify-order-button" name="verify-order-button" type="submit" value="Everything is Correct">
    </form>
</main>
</body>
<html>