<?php
    $server = "localhost";
    $user = "cust_01";
    $pass = "password";
    $database = "shop";

    $conn = new mysqli($server, $user, $pass, $database);


    $stmt = "SELECT c.firstname, c.lastname, c.email, o.submissionDate, o.total, o.status FROM shop.customers c INNER JOIN shop.orders o ON o.customerID = c.id";
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
