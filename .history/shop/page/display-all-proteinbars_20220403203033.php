<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');

    session_start();
    $proteinBars = new ProteinBarBag();

    $mysqli = db_connect();
    $result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.products;");

    while($row = $result->fetch_assoc()) {
        $proteinBars = (new ProteinBar())->id($row['id'])->name($row['name'])->grams($row['grams']);
        $$proteinBars->description($row['description'])->retailPrice($row['retailPrice']); 

        $proteinBars->->add($bar);
        #echo $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] . ', '.  $row['grams'] . ', ' .  $row['retailPrice'] . '<br>';
    }

    $result->free();
    $mysqli->close();

    $_SESSION['proteinBars'] = serialize($proteinBars);
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
    
    <title>Our Protein Bars</title>
</head>

<body>   
<header>
    <h1>Our Protein Bars</h1>
</header>

<nav>
</nav>

<main>
        <?php
            echo $bag->to_table();
        ?>

    <script>
        function send (row) {
            data = row.childNodes[0];
            cell = row.cells[0];
            cookie = document.cookie = "array-index=" + cell.innerHTML; // + "; max-age=5";

            location.href = "display-selected-proteinbar.php";
        }
    </script>
</main>

<footer>
</footer>
</body>
<html>