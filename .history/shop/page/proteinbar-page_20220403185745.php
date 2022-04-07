<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');

    $mysqli = db_connect();

    $result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.products;");

    $bag = new ProteinBarBag();

    while($row = $result->fetch_assoc()) {
        #echo print_r($row) . '<br>';
        $bar = (new ProteinBar())->id($row['id'])->name($row['name'])->grams($row['grams']);
        $bar->description($row['description'])->retailPrice($row['retailPrice']); 

        #echo $bar . '<br>';
        $bag->add($bar);
        #echo $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] . ', '.  $row['grams'] . ', ' .  $row['retailPrice'] . '<br>';
    }
    
   // print_r($_POST);

   



/*
    while ($row = $result->fetch_row()) {
        echo print_r($row) . '<br>';
        #echo $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] . ', '.  $row['grams'] . ', ' .  $row['retailPrice'] . '<br>';
      }
*/
    $result->free();

    $mysqli->close();

?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" type="text/css" href="style.css" media=”screen"/> --> 
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
    
    <title>The Template Title</title>
</head>

<body>   
    <header>
        <hi>The Template Page Heading</hi>
    </header>

    <nav>
    </nav>

    <main>
        <?php
            $bag->to_table
        ?>
    </main>

    <footer>
    </footer>
</body>
<html>