<?php
    require('../models/customer.php');
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" type="text/css" href="style.css" media=”screen"/> --> 
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
    
    <title>New Customer Registration</title>
</head>

<body>   
<header>
    <hi>New Customer Registration Form</hi>
</header>

<nav>
</nav>
<main>
    <form id='new-customer-form' name='new-customer-form' method="post">
        <fieldset><legend>Personalia</legend>
            <p>
                <label for='firstname'> First Name </label>
                <input type="text" id="firstname" name="firstname" minlength="2" maxlength="50" size="60" pattern="[A-Z]+" required>
            </p>
            <p>
                <label for="lastname"> Last Name </label>
                <input type="text" id="lastname" name="lastname" minlength="2" maxlength="50" size="60" pattern="[A-Z]+" required>
            </p>
        </fieldset>

        <fieldset><legend>Mailing Address</legend>
            <p>
                <label for="street">Street </label>
                <input type="text" id="street" name="street" minlength="2" maxlength="60" size="50" required> 
            </p>
            <p>
                <label for="city">City </label>
                <input type="text" id="city" name="city" minlength="2" maxlength="70" size="50" required> 
            </p>
            <p>
                <label for="state"> State </label>
                <select id="state" name="state" required>
                    <option value="" selected>--Please Select Your State--</option>
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
                    <option value="GA">Georgia</option>
                    <option value="GU">Guam</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PW">Palau</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VI">Virgin Islands</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>

                <label for="zip"> Zip </label>
                <input type="text" id="zip" name="zip" maxlength="5" minlength="5" size="5" pattern="[0-9]{5}" required>
            </p>
        </fieldset>

        <fieldset><legend>Contact Methods</legend>
            <p>
                <label for="phone">Phone</label>
                <input type="tel">
            </p>

            <p>
                <label>Email</label>
                <input type="email" size="60" required>
            </p>
        </fieldset>

        <fieldset><legend>Credit Card</legend>
            <p>
                <label for="card">Card</label>
                <input type="text" id="card" name="card" minlength="15" maxlength="25" size="35">
            </p>

            <p>
                <label for="code">Security Code</label>
                <input id="code" name="code" type="text" minlength="3" maxlength="3" size="3" pattern="[0-9]{3}" required>
            </p>

            <fieldset><legend>Expiration</legend>
                <label for="month">Month</label>
                <select>
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
                <select>
                    <option value="" select>--Select Year--</option>
                    <option value="22">22</option>
                    <option value="23">23</option> 
                    <option value="24">24</option>
                    <option value="25">25</option>  
                    <option value="26">26</option>
                    <option value="27">27</option> 
                    <option value="28">28</option>
                    <option value="29">29</option>    
                    <option value="00">30</option>
                    <option value="01">31</option> 
                    <option value="02">32</option>
                    <option value="03">33</option>              
                </select>
            </fieldset>
        </fieldset>

        <fieldset><legend>Password</legend>
            <p>
            <label for="pass">Password</label>
                <input type="password" id="pass" name="pass" minlength="8" maxlength="15" size="25" required>          
            </p>
            <p>
            <label for="pass">Confirm Password</label>
            <input type="password" id="confirmPass" name="confirmpPass" minlength="8" maxlength="15" size="25" required>          
            <input type="password" id="pass" name="pass" minlength="8" maxlength="15" size="25" required>
            </p>
        </fieldset>

        <input type="submit" value="Submit">
    </form>
</main>

<footer>
</footer>
</body>
<html>