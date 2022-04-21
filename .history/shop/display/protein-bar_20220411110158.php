<?php
    session_start();
    require_once ('../bootstrap.php');

    require_once (MODEL_PATH . '/review.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once ('../control/process-order.php');
    require_once ('../db/protein-bar-queries.php');

    #print_r($_COOKIE);
    $id = $_COOKIE['proteinBarID']; 
    $proteinBar = protein_bar_query($id);
    $reviewBag = protein_bar_review_query($proteinBar);

    $_SESSION['proteinBar'] = serialize($proteinBar);

    $title = $proteinBar->get_name() . ', ' . $proteinBar->get_grams() . ' grams ' . $proteinBar->get_retailPrice();
?>


<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>   
<header>
    <?php echo '<h1>' . $title . '</h1>'; ?>
</header>

<main>
    <!--
    <form id="order-form" name="order-form" method="POST" action="../control/process-order.php">
        <div>
            <h3>Number of Bars (10 Maximum)</h3>
            <label for="quantity"></label>
            <input type="number" id="quantity" name="quantity" min="1" max="10" value="1">
            <p></p>
        </div>
        <input id="submit" name="submit" type="submit" value="Submit Order">
    </form>
-->

    <?php 
        echo '<p>' . $proteinBar->to_table() . '</p>';
    ?>

<!--
    <form id="submit-rating-form" name="submit-rating-form" method="get" action="../control/process-rating.php">
        <table>
            <tr>
                <td>
                    <p>
                        <label for="stars">How Many Stars?</label><br>
                        <select id="stars" name="stars" required="true" form="rating">
                            <option value="">-- Pick Your Rating --</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </p>
                    <p>
                        <label for="comments">Comments</label><br>
                        <textarea id="comments" name="comments" rows="30" cols="100"></textarea>
                    </p>
                </td>
            </tr>
        </table>
        <input type="submit" id="submit-rating" name="submit-rating" value="Submit Rating"></input>
    </form>
-->
    <?php
        echo '<h2>Reviews</h2>';
        echo '<p>' . $reviewBag->to_table() . '</p>';
    ?>
<!--
    <script>
        function send_order(row) {
            data = row.childNodes[0];
            cell = row.cells[0];
            cookie = document.cookie = "orderID=" + cell.innerHTML; // + "; max-age=5";

            location.href = "order.php";
        }
    </script>
-->    
</main>

</body>
<html>