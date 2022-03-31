<?php
    $server = "localhost";
    $user = "cust_01";
    $password = "password";
    $database = "shop";

    // Create connection
    $conn = new mysqli($server, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $result = $conn->query("SELECT name, grams, retailPrice FROM shop.products");
    $rowCount = $conn.->
    echo print_r($result->free_result());
    echo "Affected rows: " . $conn -> affected_rows;
    echo "<table><tr>";

    for($i = 0; $i < mysql_num_fields($result); $i++) {
        $field_info = mysql_fetch_field($result, $i);
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