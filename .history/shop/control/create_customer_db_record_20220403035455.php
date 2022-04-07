<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');

    function create_db_account ($email) {
        $connection = mysqli(DB_SERVER, DB_ADMIN_USER, DB_ADMIN_PASS, ADMIN_DB); 
        $mysqli = $mysqli = new mysqli("example.com", "user", "password", "database");



    } // close create_db_account
?>