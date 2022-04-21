<?php
    require('models/customer.php');

    $customer = new Customer();
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
            
        <p><label for="patient_firstName">First Name: <input type="text" id="patientFirstName" name="patient_firstName"></label> 
        <label for="middlleInitial">Middle Initial: <input type="text" id="middlleInitial" name="middlleInitial" minLengh="0" maxlength="1"></label>
        <label for="patientLastName">LastName: <input type="text" id="patientLastName" name="patient_lasstName"></label>	
        <p><label for="birthdate"></label>birthdate<input type="date" id="birthdate" name="birhdate"></label></p>
        </fieldset>

    </form>
</main>

<footer>
</footer>
</body>
<html>