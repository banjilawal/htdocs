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


        <fieldset><legend>Contact Methods</legend>
            <p>
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone">
            </p>

            <p>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" size="60" required>
            </p>
        </fieldset>

        <fieldset><legend>Optional Credit Card Information</legend>
            <p>
                <label for="card">Card</label>
                <input type="text" id="card" name="card" minlength="15" maxlength="25" size="35">
            </p>

            <p>
                <label for="code">Security Code</label>
                <input id="code" name="code" type="text" minlength="3" maxlength="3" size="3" pattern="[0-9]{3}">
            </p>

            <fieldset><legend>Expiration</legend>
                <label for="month">Month</label>
                <select id="month" name="month">
                    <option value="" select>--Select Expiration Month--</option>
                    <option value="1">January</option>
                    <option value="2">February</option> 
                    <option value="3">March</option>
                    <option value="4">April</option>  
                    <option value="5">May</option>
                    <option value="6">June</option> 
                    <option value="7">July</option>
                    <option value="8">August</option>    
                    <option value="9">September</option>
                    <option value="10">October</option> 
                    <option value="11">November</option>
                    <option value="12">December</option>              
                </select>

                <label for="year">Year</label>
                <select id="year" name="year">
                    <option value="" select>--Select Year--</option>
                    <option value="22">2022</option>
                    <option value="23">2023</option> 
                    <option value="24">2024</option>
                    <option value="25">2025</option>  
                    <option value="26">2026</option>
                    <option value="27">2027</option> 
                    <option value="28">2028</option>
                    <option value="29">2029</option>    
                    <option value="00">2030</option>
                    <option value="01">2031</option> 
                    <option value="02">2032</option>
                    <option value="03">2033</option>              
                </select>
            </fieldset>
        </fieldset>

        <fieldset><legend>Password</legend>
            <p>
                <label for="pass">Password</label>
                <input type="password" id="pass" name="pass" minlength="1" maxlength="15" size="25" required>          
            </p>
            <p>
                <label for="confirmPass">Confirm Password</label>
                <input type="password" id="confirmPass" name="confirmPass" minlength="1" maxlength="15" size="25" required>          
            </p>
        </fieldset>

        <input type="submit" value="login">
    </form>
</main>
</main>
</body>
<html>