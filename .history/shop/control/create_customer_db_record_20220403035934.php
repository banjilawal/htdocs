<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');

    $email = $_POST["email"];


    

    function create_db_account ($email) {
        $mysqli = new mysqli("localhost", "root", "", "mysql");



    } // close create_db_account
?>