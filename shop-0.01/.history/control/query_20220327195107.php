<?php
    $server = "localhost";
    $user = "cust_01";
    $pass = "password";
    $database = "shop";

    $conn = new mysqli($server, $user, $pass, $database);


    $stmt = "SELECT name, grams, retailPrice FROM shop.products";
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $result = $conn->query($stmt);

    // Print the column names as the headers of a table
    echo "<table><tr>";
    for($index = 0; $index < mysql_num_fields($result); $index++) {
        $field_info = mysql_fetch_field($result, $iindex);
        echo "<th>{$field_info->name}</th>";
    }

    // Print the data
    while($row = mysql_fetch_row($result)) {
        echo "<tr>";
        foreach($row as $_column) {
            echo "<td>{$_column}</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
?>
