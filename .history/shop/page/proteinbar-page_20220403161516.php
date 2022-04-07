<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');

    $mysqli = db_connect();

    $result = $mysqli->query("SELECT * FROM shop.products;");

    while($row = $result->fetch_assoc()) {
        echo r;
      }
    
    print_r($_POST);
    $mysqli->close();

?>