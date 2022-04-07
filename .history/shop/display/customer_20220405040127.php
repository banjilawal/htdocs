<?php
    session_start();
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once ('../db/customer-queries.php');

    print_r($_COOKIE);
    $id = $_COOKIE['customerID']; 

    $customer = customer_query($id);
    $orderBag = customer_orders_query($customer);
    #echo $orderItems->to_table();


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
        echo '<p>' . $customer->to_table() . '</p>';

        echo '<h2>Credit Cards</h2><br>';
        echo $customer->to_table();

        echo '<h2>Order History</h2><br>';
        echo $orderBag->to_table();
    ?>


    <script>
        function send_order(row) {
            data = row.childNodes[0];
            cell = row.cells[0];
            cookie = document.cookie = "orderID=" + cell.innerHTML; // + "; max-age=5";

            location.href = "order.php";
        }
    </script>
</main>

</body>
<html>