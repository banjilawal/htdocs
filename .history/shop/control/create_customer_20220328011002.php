<?php
    require_once ('../model/customer.php');

    print_r($_POST);
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    echo '<p></p>' . $firstname . ' ' . $email . '<p></p>';

    $domain = substr($email, (strpos($email,'@') + 1));
    $account = substr($email, 0, (strpos($email,'@')));

    $principal = '\'' . $account . '\'@\'' . $domain . '\'';

    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "mysql";
    $stmt = $pdo -> prepare("SELECT * FROM table WHERE id = ?");
    $stmt -> execute(array($rid));
    $results = $stmt -> fetchAll(); // for many rows
    
    $stmt = $pr -> prepare("SELECT id FROM table WHERE name = ?");
    $stmt -> execute(array($name));
    $id = $stmt -> fetchColumn(); // for single scalar value
    
    $stmt = $pdo -> prepare("SELECT * FROM table WHERE id = ? LIMIT 1");
    $stmt -> execute(array($rid));
    $row = $stmt -> fetch(); // for single row
    

    $conn = new mysqli($server, $user, $pass, $database);


    $stmt = "CREATE USER IF NOT EXISTS $principal";
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully" . '<p></p>';

    $result = $conn->query($stmt);
    $conn->query("FLUSH PRIVILEGES;");
?>