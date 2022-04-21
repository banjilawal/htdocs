<?php
    $server = "localhost";
    $user = "cust_01";
    $pass = "password";
    $database = "shop";

    $conn = new mysqli($server, $user, $pass, $database);


    $stmt = "SELECT name, grams, retailPrice FROM shop.products";
    $result = $conn-mysql_query($stmt) or die(mysql_error());

    // Print the column names as the headers of a table
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
