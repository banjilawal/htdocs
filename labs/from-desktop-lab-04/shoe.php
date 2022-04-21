<?php
    session_start();
    $title = "";
    require("generator.php");

    $index = $_COOKIE['array-index'];
    $shoes = unserialize($_SESSION['shoes']);

    $shoe = $shoes->list[$index];
    $_SESSION['shoe'] = serialize($shoe);

    $title = $shoe->get_name() .  ' Sneakers at ' . $shoe->get_price();

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
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <?php
        echo '<title>Sneakers and Heels Shoe - ' . $title . '</title>';
    ?>
</head>

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
                    echo '<h3>' . $shoe->get_price() . '</h3>';
                ?>
            </td>
            <td>
                <h2>Sizes</h2>
                <?php
                    $e = $shoe->get_sizes()->html_list();
                    echo $e;
                ?>
            </td>
            <td>
                <div>
                    <p>
                    <button type="submit" id="order" name="order" value="order" onclick="call_order()">Order</button>
                    </p>
                </div>
                <div>
                    <p>
                    <button onclick="call_rating()">Review</button>
                    </p>
                </div>
            </td>
        </tr>
    </table>

    <script>
        function call_rating () { location.href = "give-rating.php"; } 

        function call_order () { location.href = "submit-order.php"; }
    </script>
</main>

</body>
<html>