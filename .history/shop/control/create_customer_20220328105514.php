<?php
    require_once ('../model/customer.php');

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $POST["state"];
    

    print_r($_POST);

    echo '<p></p>' . $firstname . ' ' . $email . '<p></p>';

    $domain = substr($email, (strpos($email,'@') + 1));
    $account = substr($email, 0, (strpos($email,'@')));

    $principal = '\'' . $account . '\'@\'' . $domain . '\'';
    
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

    $conn->query("DROP USER IF EXISTS $account ");
    $conn->query("CREATE USER IF NOT EXISTS $account");
    $conn->query("GRANT ALL PRIVILEGES ON *.* TO $account");
    $conn->close();

    $user = $account;
    $database = "shop";

    $conn = new mysqli($server, $user, $pass, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully" . '<p></p>';

    $stmt = "SELECT c.firstname, c.lastname, c.email, o.total, o.status FROM shop.customers c INNER JOIN shop.orders o ON o.customerID = c.id";

    $result = $conn->query($stmt);
    $row = $result->fetch_assoc();

    #printf ("\n%s %s %s\n", $row["name"], $row["grams"], $row["retailPrice"]);

    while ( $row = mysqli_fetch_row($result) ) {
        #printf ("%s \n", print_r($row));
        print_r($row);
    }
    mysqli_free_result($result);


?>