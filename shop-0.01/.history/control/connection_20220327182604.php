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

    $conn -> query("SELECT * FROM shop.products");
    echo "Affected rows: " . $conn -> affected_rows;
?> 