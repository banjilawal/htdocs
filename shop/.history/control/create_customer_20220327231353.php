<?php
    require_once ('../model/customer.php');

    print_r($_POST);
    $firstName = $_POST["firstname"];
    $email = $_POST["email"];
    echo '<p></p>' . $firstName . ' ' . $email . '<p></p>';

    
?>