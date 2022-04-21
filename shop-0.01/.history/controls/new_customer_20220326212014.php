<?php
    require('../models/customer.php');

    #$customer = new Customer();
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" type="text/css" href="style.css" media=”screen"/> --> 
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
    
    <title>The Template Title</title>
</head>

<body>   
<header>
    <hi>The Template Page Heading</hi>
</header>

<nav>
</nav>
<main>
    <form id='new-customer-form' name='new-customer-form' method="post">
        <fieldset><legend>Personalia</legend>
            <label for='first-name'>First Name</label>
            <input type="text" id="firstname" name="firstname" length="20">

            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" length="20">
        </fieldset>

        <fieldset>

    </form>
</main>

<footer>
</footer>
</body>
<html>