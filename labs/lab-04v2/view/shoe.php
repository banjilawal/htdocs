<?php
    namespace View\Shoe;

    use Model\Shoe\Shoe;
    use Model\Shoe\Shoes;

    session_start();
    require('../model/shoes.php');

    $b = new Shoe();
    echo $b;


    $index = $_COOKIE['array-index'];
    $shoes = unserialize($_SESSION['shoes']);
    echo -$shoes->to_table();

    $shoe = $shoes->list[$index];
    $_SESSION['shoe'] = serialize($shoe);

    $title = $shoe->get_name() .  ' Sneakers at ' . $shoe->report_price();

    $title = "";

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
        echo '<title>Sneakers and Heels Shoe - ' . $title. '</title>';
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
                    echo $shoe->price_table();
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
        function launch_review_process () { location.href = "control/give-review.php"; } 

        function launch_order_process () { location.href = "control/submit-order.php"; }
    </script>
</main>

</body>
<html>