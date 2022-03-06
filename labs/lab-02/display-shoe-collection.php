<?php
    session_start();
    require('shoe-generator.php');
    $shoes = new Shoes();
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!--<script type="text/javascript" src="script.js"></script>!--> 
    <!--<script type="text/php" src="shoe-generator.php"></script>!-->
    
    <title>Welcome to Sneakers and Heels</title>
</head>

<body>   
<header>
    <h1 class="h1">Welcome to Sneakers and Heels</h1>
</header>

<main>
    <form id="shoes-form" name="shoes-form" action="shoe.php" method="post">
    <table class="table" id="shoes-table" name="shoes-table">
        <thead class="table-head" id="shoes-table-head" name="shoes-table-head">
            <tr class="header-row" id="shoes-table-header-row" name=""shoes-table-header-row>
            <!-- <th class="type-column">Type</th> !-->
                <th class="id-column">Number</th>
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
                $index = 0;

                foreach ($shoes->list as $id => $shoe) {
                    $row_id = $index;
                    $row = '<tr id="shoes-table-row-' . $index . '" name="shoes-table-row-' . $index . ' value="' . $index . '" "onclick="submit_row(this)">'; 
                    $row .= '<td id="shoe-id-' . $index . '">' . $id . '</td>';
                    $row .= '<td><img src="' . $shoe->get_imagePath() . '" width="500" height="400"></td>';
                    $row .= '<td>' . $shoe->get_brand() . '</td>';
                    $row .= '<td>' . $shoe->get_model() . '</td>';
                    $row .= '<td>' . make_html_list($shoe->get_sizes()) . '</td>';
                    $row .= '<td>' . $shoe->get_price() . '</td>';
                    $row .= '<td> <button type="button" value="submit" onclick="submit_handler()">Order</button> </td>';
                    $row .= '</tr>';
                    echo $row;
                    $index++;
                }
                echo '<p></p>';
            ?>
        </tbody>
    </table>
    </form>

    <script type="text/javascript">
        function submit_row (x) {
            //cell = x.cells[0];
            cookie = document.cookie = "array-index=" + cell.innerHTML; // + "; max-age=5";
            //alert(cookie);
        }
    </script>

    <?php
        //print_r($_COOKIE);
        //echo $_COOKIE['array-index'] . '<br>';
        $index = $_COOKIE['array-index'];

        //echo $index . '<br>';
        //echo $shoes->list[$index];

        $shoe = $shoes->list[$index];
        $data = serialize($shoe);

        $_SESSION['shoe'] = NULL;
        $_SESSION['shoe'] = $data;
        header('shoe.php');
        exit();
    ?>
</main>

<footer>
</footer>
</body>
<html>