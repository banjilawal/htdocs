<?php
    require_once ('../model/customer.php');

    print_r($_POST);
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    echo '<p></p>' . $firstName . ' ' . $email . '<p></p>';

    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "mysql";

    $account = $firstname . ""

    $conn = new mysqli($server, $user, $pass, $database);


    $stmt = "CREATE USER $email";
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully" . '<p></p>';

    $result = $conn->query($stmt);
    $conn->query("FLUSH PRIVILEGES;");
?>