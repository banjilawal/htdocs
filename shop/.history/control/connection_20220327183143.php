<?php
    $server = "localhost";
    $user = "visitor_01";
    $password = "";
    $database = "shop";

    // Create connection
    $conn = new mysqli($server, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $result = $conn->query("SELECT * FROM shop.products");
    $result->free_result();
    list
    echo "Affected rows: " . $conn -> affected_rows;
?> 