<?php
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
    <h1>Customer Records</h1>
</header>

<nav></nav>
<main>
    <?php  echo $customerBag->to_table(); ?>
    <script>
        function send_customer (row) {
            //var x = row.getAttribute("id")
            //alert(x);
            data = row.childNodes[0];
            cell = row.cells[0];
            //alert(cell.innerHTML);
            cookie = document.cookie = "customerID=" + cell.innerHTML + ""; // + "; max-age=5";

            location.href = "customer.php";
        }
    </script>
</main>
</body>
<html>