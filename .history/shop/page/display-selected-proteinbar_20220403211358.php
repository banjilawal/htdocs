<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');

    $cart = new OrderItemBag ();
    $orderItem = new OrderItem();
    $proteinBar = new ProteinBar();
    $proteinBarBag = new ProteinBarBag();

    echo pr$_COOKIE[];

    #$index = $_COOKIE[];
    
    $proteinBarBag = unserialize($_SESSION['proteinBars']);
    $shoe = $shoes->list[$index];
   
    /*
    $mysqli = db_connect();
    $result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.products WHERE id = ;");

    while($row = $result->fetch_assoc()) {
        $bar = (new ProteinBar())->id($row['id'])->name($row['name'])->grams($row['grams']);
        $bar->description($row['description'])->retailPrice($row['retailPrice']); 

        $proteinBars->add($bar);
        #echo $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] . ', '.  $row['grams'] . ', ' .  $row['retailPrice'] . '<br>';
    }

    $result->free();
    $mysqli->close();
    */

    //print_r($_SESSION);


/*
    $_SESSION['shoe'] = NULL;
    $_SESSION['shoe'] = serialize($shoe);
    $title = $shoe->get_name() .  ' Sneakers at ' . $shoe->report_price();

    function make_html_selector($sizes) {
        $elem = '<label for="shoe-size-selector">Pick your shoe size</label>';
        $elem .= '<select id="size" name="size" form="shoe-order-form">';
        $elem .= '<option value="">Available Sizes</option>';

        foreach ($sizes as $size) {
            $elem .= '<option value="' . $size . '">' . $size . '</option>';
        }
        $elem .= '</select>';
        return $elem;
    }
*/    
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <?php
        echo '<title>Sneakers and Heels Shoe - ' . $proteinBar->get_name() . '</title>';
    ?>
</head>

<body>   
<header>
    <?php
        echo '<h1>' .  $proteinBar->get_name() . '</h1>';
    ?>
</header>

<main>
    <table>
        <tr>
            <td>
                <?php
                    echo '<img src="' . $proteinBar->get_imagePath() . '" width="600" height="400">';
                ?>
            </td>
            <td>
                <?php
                    echo '<h3>' . $proteinBar->get_name() . '</h3>';
                ?>
            </td>
            <td>
                <h2>Price</h2>
                <?php
                    echo $proteinBar->retailPrice;
                ?>
            </td>
            <td>
                <div>
                    <p>
                    <button type="submit" id="order" name="order" value="order" onclick="launch_order_process()">Order</button>
                    </p>
                </div>
                <div>
                    <p>
                    <button type="submit" id="review" name="order" value="order" onclick="launch_review_process()">Review</button>
                    </p>
                </div>
            </td>
        </tr>
    </table>

    <script>
        function launch_review_process () { location.href = "complete-review.php"; } 
        function launch_order_process () { location.href = "fill-order-form.php"; }
    </script>
</main>

</body>
<html>