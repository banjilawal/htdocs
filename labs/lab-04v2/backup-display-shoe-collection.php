<?php
    require('shoe-generator.php');

    $shoes = new Shoes();
    $list = $shoes->get_list();

    function price_comparator ($a, $b) {
        if ($a->get_price() > $b->get_price()) {
            echo  '(' . $a->get_model() . ' ' . $a->get_price() . ') > (' .  $b->get_model() . ' ' . $b->get_price() . ')<br>';
            return -1;
        }
        else if ($a->get_price() < $b->get_price()) return 1;
        else return 0;
    }

    //echo '<p><h1>Presort</h1>' . $shoes . '</p>';
    echo '<p><h1>Presort</h1></p>';
    foreach ($list as $item) {
        echo $item . '<br>';
    }

    //usort($shoes->list, 'price_comparator');

    echo '<p></p><p></p>';
    usort($list, 'price_comparator');
    usort($shoes->list, 'price_comparator');
    echo '<p></p><p></p>';

    //echo '<p><h1>postsort</h1>' . $shoes . '</p>';
    echo '<p><h1>Postsort</h1></p>';
    foreach ($list as $item) {
        echo $item . '<br>';
    }
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" media=”screen” />
    <!--<script type="text/php" src="shoe-generator.php.js"></script> --> 
    <script type="text/php" src="shoe-generator.php"></script>
    
    <title>Welcome to Sneakers and Heels</title>
</head>

<!--######## Begin Body ########-->
<body>   
<!--######## Start Header Section ########-->
<header>
    <h1 class="h1">Welcome to Sneakers and Heels</h1>
</header>

<!--######## Start Nav Section ########-->
<nav>
</nav>

<!--######## Start Main Section ########-->
<main>
    <table class="table" id="shoes-table" name="shoes-table">
        <thead class="table-head" id="shoes-table-head" name="shoes-table-head">
            <tr class="header-row" id="shoes-table-header-row" name=""shoes-table-header-row>
               <!-- <th class="type-column">Type</th> !-->
                <th class="id-column">Product ID</th>
                <th class="image-column">Picture</th>
                <th class="brand-column">Brand</th>
                <th class="model-column">Model</th>
                <th class="size-column">Sizes</th>
                <th class="price-colum">Price</th>
                <th class="order-column">Order</th>
            </tr>
        </thead>

        <tbody class="table-body" id="shoes-table-body" name="shoes-table-body">
            <?php
                function make_html_list($items) {
                    $elem = '<table>';

                    foreach ($items as $item) {
                        $elem .= '<tr><td>' . trim($item, ' ') . '</td></tr>';
                    }
                    $elem .= '</table>';

                    return trim($elem, ' ');
                }



                $counter = 0;

                foreach ($shoes->get_list() as $id => $shoe) {
                    $row = '<tr onclick="send($hoe)">'; 
                    $row .= '<td>' . $id . '</td>';
                    $row .= '<td><img src="' . $shoe->get_imagePath() . '" width="300" height="400"></td>';
                    $row .= '<td>' . $shoe->get_brand() . '</td>';
                    $row .= '<td>' . $shoe->get_model() . '</td>';
                    $row .= '<td>' . make_html_list($shoe->get_sizes()) . '</td>';
                    $row .= '<td>' . $shoe->get_price() . '</td>';
                    $row .= '<td> <button type="button">Order</button> </tr>';
                    $row .= '</tr>';
                    echo $row;
                }

            ?>
        </tbody>
    </table>
</main>

<?php
    $_SESSION['shoe_collection'] = array();
    session_unset();
    session_destroy();
?>

<!--######## Start Footer Section ########-->   
<footer>

</footer>
</body>
<!--######## Finish Body ########-->
<html>