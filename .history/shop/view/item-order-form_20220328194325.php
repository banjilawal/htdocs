<?php
    require_once('../model/product.php');
    session_start();

    $bars = array();
    $bar = new ProteinBar();
    $bar->id('ghyf-12')->name('')
# picture, id, name, description, grams, retailPrice, surrogateID
?, $bars += (new ProteinBar())->id('PN-XGO-654-T')->name('Alta')->grams(64)->retailPrice('2.99');
?, 'PN-SDD-427-Y', 'Kabaiwanska', NULL, '78', '2.99', '2'
?, 'PN-FOT-272-S', 'Watching', NULL, '95', '2.99', '3'
?, 'PN-FAU-284-Q', 'Amorosa', NULL, '99', '2.99', '4'
?, 'PN-MSE-577-Q', 'Hearted', NULL, '95', '2.99', '5'
?, 'PN-CVQ-856-T', 'Manzoni', NULL, '93', '1.99', '6'
?, 'PN-PLP-824-T', 'Hands', NULL, '62', '1.99', '7'


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

</body>
<html>

<?php





    $title = $shoe->get_name() . ' Sneakers at ' . $shoe->get_current_price();

    // I should probably have not created the whole selector in PHP.  I think this makes
    // it too fragile.  Its' basically like hard coding but I don't have time to change 
    // it.
    function make_html_selector($sizes) {
        $elem = '<label for="size">Pick your shoe size</label>';
        $elem .= '<select id="size" name="size" form="order">';
        $elem .= '<option value="">Available Sizes</option>';

        foreach ($sizes as $size) {
            $elem .= '<option value="' . $size . '">' . $size . '</option>';
            //echo $size . '<br>';
        }
        $elem .= '</select>';
        return $elem;
    }
    header($title);
?>

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