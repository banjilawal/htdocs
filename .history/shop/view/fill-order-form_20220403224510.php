<?php
    session_start();
    sess

    require_once("../model/order.php");
    require_once("../model/orderItem.php");
    require_once("../model/proteinBar.php");

    echo print_r($_SESSION);

    $bar = unserialize($_SESSION['bar']);
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
            <td><?php echo '<h2>' . $proteinBar->get_description() . '</h2>'; ?></td>
            <td> <h2>Price</h2> <?php echo '<h2>' . $bar->get_description() . '</h2>'; ?> </td>
            <td>
                <form id="order" name="order" method="POST" action="verify-order.php">
                    <div>
                        <p></p>
                        <h3>Number of Bars (20 Maximum)</h3>
                        <input type="number" id="quantity" name="quantity" min="1" max="20" value="1">
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