<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');

    function create_db_account ($email) {
        $mysqli = new mysqli("localhost", "user", "password", "database");



    } // close create_db_account
?>