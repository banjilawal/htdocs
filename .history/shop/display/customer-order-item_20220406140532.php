<?php
    session_start();
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('../db/order-queries.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/customerOrderItem.php');
    require_once ('../db/customer-queries.php');

    print_r($_COOKIE);
    $row = $_COOKIE['customerItemRow']; 
    echo $row;

    $customerOrderItemBag = serialize($_SESSION['customerOrderItemBag']);
    echo $customerOrderItemBag[$row];
    #echo get_class($customerItem);

    #echo $orderItems->to_table();  

  #  $title = 'Order ' . $customerItem->get_proteinBar()->get_name() . ' Details';
?>


<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php #echo '<title>' . $title .  '</title>'; ?>
</head>

<body>   
<header>
    <?php #echo '<h1>' . $title .  '</h1>'; ?>
</header>

<main>
    <?php
       # echo $customerItem->to_table();
    ?>

<script>

</script>
</main>

</body>
<html>