<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');

    $mysqli = db_connect();

    $result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.products;");

    while($row = $result->fetch_assoc()) {
        echo print_r($row);
      }
    
   // print_r($_POST);


    $bag = new ProteinBarBag();

    while ($row = $result->fetch_row()) {
        echo $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] . ', '.  $row['grams'] . ', ' .  $row['retailPrice'] . '<br>';
      }

    while ($result->fetch($row)) {

    }
    $result->free();

    $mysqli->close();

?>