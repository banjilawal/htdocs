<?php
    session_start();

    require_once("../model/order.php");
    require_once("../model/orderItem.php");
    require_once("../model/proteinBar.php");

    $bar = unserialize($_SESSION['proteinBar']);
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 

    <?php echo '<title>' . $bar->get_name() . ' ' . $bar->get_grams() . $bar->get_retailPrice() . '</title>' ;?>
</head>

<!--######## Begin Body ########-->
<body>   
<header>
    <?php echo '<h1>' . $bar->get_name() . ' ' . $bar->get_grams() . $bar->get_retailPrice() . '</h1>'; ?>
</header>

<main>
    <table>
        <tr>
            <td> <?php echo '<img src="' . $bar->get_imagePath() . '" width="600" height="400">'; ?></td>
            <td> <?php echo '<h2>' . $bar->get_name() . '</h2>'; ?></td>
            <td> <h2>Price</h2> <?php echo '<h2>' . $bar->get_e() . '</h2>';
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