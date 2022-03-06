<?php
    session_start();
    //print_r($_SESSION);
    require("shoe-generator.php");

    $data = $_SESSION['shoe'];
    $shoe = unserialize($data);

    $shoe = new Shoe();

    function make_title($shoe) {
        return  ($shoe->get_name() . ' Sneakers at ' . $shoe->get_price());
    }

    function make_html_selector($sizes) {
        $elem = '<label for="shoe-size-selector">Pick your shoe size</label>';
        $elem .= '<select id="size" name="size" form="shoe-order-form">';
        $elem .= '<option value="">Available Sizes</option>';

        foreach ($sizes as $size) {
            $elem .= '<option value="' . $size . '">' . $size . '</option>';
            //echo $size . '<br>';
        }
        $elem .= '</select>';
        return $elem;
    }
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 

    <?php
        echo '<title>Sneakers and Heels Shoe - ' . make_title($shoe) . '</title>';
    ?>
</head>

<!--######## Begin Body ########-->
<body>   
<header>
    <?php
        echo '<h1>' . make_title($shoe) . '</h1>';
    ?>
</header>

<main>
    <table>
        <tr>
            <td>
                <?php
                    echo '<img src="' . $shoe->get_imagePath() . '" width="600" height="400">';
                ?>
            </td>
            <td>
                <?php
                    echo '<h3>' . $shoe->get_brand() . ' ' . $shoe->get_model() . '</h3>';
                ?>
            </td>
            <td>
                <h2>Price</h2>
                <?php
                    echo '<h3>' . $shoe->get_price() . '</h3>';
                ?>
                <br>
                <div>
                    <form id="shoe-order-form" name="shoe-order-form" method="POST" action="order-verification.php">
                        <div id="shoe-size-selector-div" name="shoe-size-selector-div">
                            Select Shoe Size<br>
                            <?php
                                $e = make_html_selector($shoe->get_sizes());
                                echo $e;
                            ?>
                        </div>
                        <div id="order-quantity-div" name="order-quantity-div">
                            <p></p>
                            Number of Pairs<br>
                            <label for="quantity">Order Qauntity (between 1 and 10)</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="10" value="1">
                        </div>
                        <input id="order-submit-button" name="order-submit-button" type="submit" value="Submit Order">
                    </form>
                </div>
            </td>
        </tr>
    </table>
</main>
   
<footer>
</footer>
</body>
<html>