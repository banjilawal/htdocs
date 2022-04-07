<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');

    $mysqli = 

    $result = $mysqli->query("SELECT * FROM shop.products;");
    var_dump($result);
    print_r($_POST);


?>