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
    
    <title>New Credit Card Form</title>
</head>

<body>   
<header>
    <hi>New Credit Card Form</hi>
</header>

<nav>
</nav>
<main>
    <form id='new-card-form' name='new-card-form' method="post" action="../control/process-card-addition.php">
        <fieldset><legend></legend>
                <p>
                    <label for="card">Card</label>
                    <input type="text" id="cardID" name="cardID" minlength="15" maxlength="25" size="35">

                    <label for="code"> Security Code </label>
                    <input id="code" name="code" type="text" minlength="3" maxlength="3" size="3" pattern="[0-9]{3}">
                </p>
                <p>
                    <label for="expiration"> Expiration Date </label>
                    <input type=date id="expiration" name="expiration">       
                </p>
        <input type="submit" value="Submit">
    </form>
</main>

<footer>
</footer>
</body>
<html>