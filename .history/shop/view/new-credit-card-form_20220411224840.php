<?php
    require('../model/customer.php');
    $customer = new Customer();
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" type="text/css" href="style.css" media=”screen"/> --> 
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
    
    <title>New Credit Card Form</title>
</head>

<body>   
<header>
    <hi>Change Address Form</hi>
</header>

<nav>
</nav>
<main>
    <form id='new-card-form' name='new-card-form' method="post" action="../control/add-card.php">

        <input type="submit" value="Submit">
    </form>
</main>

<footer>
</footer>
</body>
<html>