<?php
    session_start();

    require_once("../");
    require_once("../model/orderItem.php");

    $index = $_COOKIE['array-index'];
    $shoes = unserialize($_SESSION['shoes']);

    $shoe = $shoes->list[$index];
    $_SESSION['shoe'] = serialize($shoe);

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
    <table>
        <tr>
            <td>
                <?php
                    echo '<img src="' . $shoe->get_imagePath() . '" width="600" height="400">';
                ?>
            </td>
            <td>
                <?php
                    echo '<h3>' . $shoe->get_name() . '</h3>';
                ?>
            </td>
            <td>
                <h2>Price</h2>
                <?php
                    echo '<h3>' . $shoe->get_current_price() . '</h3>';
                ?>
            </td>
            <td>
                <form id="order" name="order" method="POST" action="verify-order.php">
                    <div>
                        <h3>Select Shoe Size</h3>
                        <?php
                            $e = make_html_selector($shoe->get_sizes()->get_list());
                            echo $e;
                        ?>
                        <p></p>
                    </div>
                    <div>
                        <p></p>
                        <h3>Number of Pairs (10 Maximum)</h3>
                        <input type="number" id="quantity" name="quantity" min="1" max="10" value="1">
                        <p></p>
                    </div>
                    <input id="submit" name="submit" type="submit" value="Submit Order">
                </form>
            </td>
        </tr>
    </table>
</main>

<footer>
</footer>
</body>
<html>