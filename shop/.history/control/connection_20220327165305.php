<?php
    $server = "localhost";
    $user = "cust_01";
    $password = "password";
    $database = "shop";

    // Create connection
    $conn = new mysqli($server, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
?> 