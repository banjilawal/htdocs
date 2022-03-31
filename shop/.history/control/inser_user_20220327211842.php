<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "mysql";

    $conn = new mysqli($server, $user, $pass, $database);


    $stmt = "INSERT INTO d";
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully" . '<p></p>';

    $result = $conn->query($stmt);
    $row = $result->fetch_assoc();

    #printf ("\n%s %s %s\n", $row["name"], $row["grams"], $row["retailPrice"]);

    while ( $row = mysqli_fetch_row($result) ) {
        #printf ("%s \n", print_r($row));
        print_r($row);
    }
    mysqli_free_result($result);
?>


INSERT INTO user
    ->     VALUES('localhost','monty',PASSWORD('some_pass'),
    ->     'Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y')