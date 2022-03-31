<?php
    require_once('../model/customer.php');

?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" type="text/css" href="style.css" media=”screen"/> --> 
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
    
    <title>Update Phone Number Form</title>
</head>

<body>   
<header>
    <hi>Update Phone Number Form</hi>
</header>

<nav>
</nav>
<main>
    <form id='phone-update-form' name='phone-update-form' method="post" action="../control/update-phone.php">
    <p>
        Please confirm the last four digits of your previous phone number
        <label for="confirm">
            <in 
    </p>

        <p>
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone">
            </p>
        <input type="submit" value="Submit">
    </form>
</main>

<footer>
</footer>
</body>
<html>