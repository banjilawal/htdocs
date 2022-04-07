<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');

    $email = $_POST["email"];




    function create_db_account ($email) {
        $domain = substr($email, (strpos($email,'@') + 1));
        $account = substr($email, 0, (strpos($email,'@')));

        $mysqli = new mysqli("localhost", "root", "", "mysql");
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        echo "Connected successfully" . '<br>';

        $stmt = $conn->prepare("CREATE USER IF NOT EXISTS ?");
        $stmt->bind_param('s', $principal);
        $stmt->execute();

    } // close create_db_account
?>