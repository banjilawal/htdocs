<?php
    require_once('../model/product.php');
    session_start();

    $bars = array();

    $bar = new ProteinBar();
    $bar->id('PN-XGO-654-T')->name('Alta')->grams(64)->retailPrice(2.99);
    array_push($bars, $bar);

    $bar->id('PN-SDD-427-Y')->name('Kabaiwanska')->grams(78)->retailPrice(2.99);
    array_push($bars, $bar);

    $bar->id('PN-FOT-272-S')->name('Watching')->grams(95)->retailPrice(2.99);
    array_push($bars, $bar);

    $bar->id('PN-MSE-577-Q')->name('Hearted')->grams(95)->retailPrice(2.99);
    array_push($bars, $bar);  

    function make_html_selector ($bars) {
        $elem = '<form name="item-order-form" id="item-order-form" action="add-to-cart.php" method="post">'
        . '<label for="item">Select a Protein Bar</label>'
        . '<select id="item" name="item">';

        foreach ($bars as $bar) {
            $elem .= '<option value="' . $bar->get_name() . ' '. $bar->get_retailPrice() . '">' . $bar->get_name() . '</option>';
            //echo $size . '<br>';
        }
        $elem .= '</select>';
        return $elem;
        } 

    echo make_html_selector($bars);    

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

<body>
    <form name="item-order-form" id="item-order-form" action="add-to-cart.php" method="post">

    </form>
                . '<label for="item">Select a Protein Bar</label>'
        . '<select id="item" name="item">';
</body>
<html>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 

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
    <form id="order-form" name="order-form" method="post" action="process-order.php">
        <label for  > 
    </form>
</main>

<footer>
</footer>
</body>
<html>