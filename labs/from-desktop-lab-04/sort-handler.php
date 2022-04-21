<?php
    session_start();
    require('generator.php');
    
    $shoes = unserialize($_SESSION['shoes']);
    $sortOrder = $_GET['sort-order'];
    
    function comparator ($a, $b) {
        if ($a->get_price() > $b->get_price()) {
            //echo  '(' . $a->get_model() . ' ' . $a->get_price() . ') > (' .  $b->get_model() . ' ' . $b->get_price() . ')<br>';
            return -1;
        }
        else if ($a->get_price() < $b->get_price()) return 1;
        else return 0;
    }

    function reverse_comparator ($a, $b) {
        if ($a->get_price() < $b->get_price()) {
            //echo  '(' . $a->get_model() . ' ' . $a->get_price() . ') < (' .  $b->get_model() . ' ' . $b->get_price() . ')<br>';
            return -1;
        }
        else if ($a->get_price() > $b->get_price()) return 1;
        else return 0;
    }

    if ($sortOrder == 'ascending') {
        uasort($shoes->list, 'reverse_comparator');
    } 
    else {
        uasort($shoes->list, 'comparator');
    }

    $title = 'Shoes in ' . ucfirst($sortOrder) . ' of Price';
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <?php
        echo '<title>' . $title . '</title>';
    ?>
</head>

<!--######## Begin Body ########-->
<body>   
<header>
    <?php
        echo '<h1>' . $title . '</h1>';
    ?>
</header>

<main>
    <?php
        echo $shoes->to_table();
    ?>

    <script>
        function send (row) {
            data = row.childNodes[0];
            cell = row.cells[0];
            cookie = document.cookie = "array-index=" + cell.innerHTML; // + "; max-age=5";

            location.href = "shoe.php";
        }
    </script>
</main>

</body>
<html>