<?php
    session_start();
 #   setcookie(session_name(),'',0,'/');
 #   session_regenerate_id(true);
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/customerOrderItem.php');
    require_once ('../db/customer-queries.php');


    $customer = new Customer ();
    $customer = unserialize($_SESSION['customer']);
    $customerItems = customer_proteinbar_query ($customer)
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
      <title>Customer Records</title>
</head>

<body>   
<header>
    <h1>Your Orders</h1>
</header>

<nav></nav>
<main>
    <?php  echo $customerItems->to_table(); ?>
    <script>
        function send_customer_order_item (row) {
            //var x = row.getAttribute("id")
            //alert(x);
            data = row.childNodes[0];
            cell = row.cells[0];
            //alert(cell.innerHTML);
            cookie = document.cookie = "customerItemRow=" + cell.innerHTML + "; max-age=5";

            location.href = "order.php";
        }
    </script>
</main>
</body>
<html>