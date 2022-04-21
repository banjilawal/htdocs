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
    <h1>Welcome Login</h1>
</header>

<nav></nav>
<main>
<form id='new-customer-form' name='new-customer-form' method="post" action="../control/process-customer-registration.php">
<fieldset><legend>Password</legend>
            <p>
            <label for="email">Email</label>
                <input type="email" id="email" name="email" size="60" required>
            </p>

            <p>
                <label for="pass">Password</label>
                <input type="password" id="pass" name="pass" minlength="1" maxlength="15" size="25" required>          
            </p>
        </fieldset>

            </p>
        </fieldset>




        <input type="submit" value="login">
    </form>
</main>
</main>
</body>
<html>