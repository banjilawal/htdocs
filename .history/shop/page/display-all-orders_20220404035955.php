<?php
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
 #   setcookie(session_name(),'',0,'/');
 #   session_regenerate_id(true);
    require_once ('../bootstrap.php');
    require_once ('../model/customer.php');
    require_once ('../model/order.php');
    require_once ('../model/orderItem.php');
    require_once (MODEL_PATH . '/proteinBar.php');

    $order = new order();
    $orderBag = new OrderBag ();

    $mysqli = db_connect();
    $result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.orders");

    while($row = $result->fetch_assoc()) {
        $order = (new ProteinBar())->id($row['id'])->name($row['name'])->grams($row['grams']);
        $order->description($row['description'])->retailPrice($row['retailPrice']); 

        $orderBag->add($order);
        #echo $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] . ', '.  $row['grams'] . ', ' .  $row['retailPrice'] . '<br>';
    }

    $result->free();
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
      <title>Orders</title>
</head>

<body>   
<header>
    <h1>Our Protein Bars</h1>
</header>

<nav></nav>
<main>
    <?php  echo $bag->to_table(); ?>
    <script>
        function send (row) {
            //var x = row.getAttribute("id")
            //alert(x);
            data = row.childNodes[0];
            cell = row.cells[0];
            //alert(cell.innerHTML);
            cookie = document.cookie = "id=" + cell.innerHTML; // + "; max-age=5";

            location.href = "display-selected-protein-bar.php";
        }
    </script>
</main>
</body>
<html>