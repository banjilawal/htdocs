<?php
    $server = "localhost";
    $user = "cust_01";
    $password = "password";
    $database = "shop";

    // Create connection
    $conn = new mysqli($server, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $result = $conn->query("SELECT name, grams FROM shop.products");
    print_r($result->free_result());
    echo "Affected rows: " . $conn -> affected_rows;
?> 