<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (QUERY_PATH . '/customer-queries.php'); #'../db/customer-queries.php');

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

<main>
    <form id='phone-update-form' name='phone-update-form' method="post" action="../control/update-phone.php">
        <p>
            <label for="phone">New Phone </label>
            <input type="tel" id="phone" name="phone">
        </p>
        <input type="submit" value="Submit">
    </form>
</main>

</body>
<html>