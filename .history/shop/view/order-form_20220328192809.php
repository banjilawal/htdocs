<?php
    require_once('../model/order.php');
    session_start();


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
    <form id="
</main>

<footer>
</footer>
</body>
<html>