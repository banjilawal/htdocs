<?php
    require_once ('../model/customer.php');

    print_r($_POST);
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    echo '<p></p>' . $firstname . ' ' . $email . '<p></p>';

    $domain = substr($email, (strpos($email,'@') + 1));
    $account = substr($email, 0, (strpos($email,'@')));

    #$principal = '\'' . $account . '\'@\'' . $domain . '\'';
    
    #$principal = $account . '@' . $domain;
    echo $principal . '<br>';

    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "mysql";

    $conn = new mysqli($server, $user, $pass, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully" . '<p></p>';

    $conn->query("DROP USER IF EXISTS $principal");
    $conn->query("CREATE USER IF NOT EXISTS $principal");
    $conn->query("GRANT ALL ON show.* TO $principal");
?>