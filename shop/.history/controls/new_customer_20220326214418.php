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
            <label for='firstname'>First Name</label>
            <input type="text" id="firstname" name="firstname" length="20">

            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" length="20">
        </fieldset>

        <fieldset><legend>Mailing Adddress</legend>
            <p>
                <label for="street">Street</label>
                <input type="text" id="street" name="street" length="100"> 
            </p>

            <p>
                <label for="city">City</label>
                <input type="text" id="city" name="city" length="100"> 
            </p>

            <p>
                <label for="state">State</label>
                <select id="state" name="state">
                    <option value="--Please Select Your State--" default="true"></option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AS">American Samoa</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="AA">Armed Forces Americas</option>
                    <option value="AE">Armed Forces Europe</option>
                    <option value="AP">Armed Forces Pacific</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District of Columbia</option>
                    <option value="FM">Federated States of Micronesia</option>
                    <option value="FL">Florida</option>
                    <option value="Georgia GA">Georgia</option>
                    <option value="Guam GU">Guam</option>
                    <option value="Hawaii HI">Hawaii</option>
                    <option value="Idaho ID">Idaho</option>
                    <option value="Illinois IL">Illinois</option>
                    <option value="Indiana IN">Indiana</option>
                    <option value="Iowa IA">Iowa</option>
                    <option value="Kansas KS">Kansas</option>
                    <option value="Kentucky KY">Kentucky</option>
                    <option value="Louisiana LA">Louisiana</option>
                    <option value="Maine ME">Maine</option>
                    <option value="Marshall Islands MH">Marshall Islands</option>
                    <option value="Maryland MD">Maryland</option>
                    <option value="Massachusetts MA">Massachusetts</option>
                    <option value="Michigan MI">Michigan</option>
                    <option value="Minnesota MN">Minnesota</option>
                    <option value="Mississippi MS">Mississippi</option>
                    <option value="Missouri MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="Nebraska NE">Nebraska</option>
                    <option value="Nevada NV">Nevada</option>
                    <option value="New Hampshire NH">New Hampshire</option>
                    <option value="New Jersey NJ">New Jersey</option>
                    <option value="New Mexico NM">New Mexico</option>
                    <option value="New York NY">New York</option>
                    <option value="North Carolina NC">North Carolina</option>
                    <option value="North Dakota ND">North Dakota</option>
                    <option value="Northern Mariana Islands MP">Northern Mariana Islands</option>
                    <option value="Ohio OH">Ohio</option>
                    <option value="Oklahoma OK">Oklahoma</option>
                    <option value="Oregon OR">Oregon</option>
                    <option value="Palau PW">Palau</option>
                    <option value="Pennsylvania PA">Pennsylvania</option>
                    <option value="Puerto Rico PR">Puerto Rico</option>
                    <option value="Rhode Island RI">Rhode Island</option>
                    <option value="South Carolina SC">South Carolina</option>
                    <option value="South Dakota SD">South Dakota</option>
                    <option value="Tennessee TN">Tennessee</option>
                    <option value="Texas TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VI">Virgin Islands</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
            </p>

        </fieldset>

    </form>
</main>

<footer>
</footer>
</body>
<html>