<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "mysql";

    $conn = new mysqli($server, $user, $pass, $database);


    $stmt = "INSERT INTO users VALUES VALUES('localhost','korinna-kenny@comcast.net',PASSWORD('pass'),'Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y')";
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully" . '<p></p>';

    $result = $conn->query($stmt);
    $conn->query("FLUSH PRIVILEGES;")
?>