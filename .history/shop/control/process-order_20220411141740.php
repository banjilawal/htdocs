<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');

    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once ('../db/protein-bar-queries.php');
    require_once ('../view/login-form.php');

    #echo '<p>POST<br>' . print_r($_POST) . '</p>';
    #echo '<p>SESSION: '. print_r($_SESSION['proteinBar']) . '</p>';
 
    $quantity = $_POST['quantity'];
    $proteinBar = unserialize($_SESSION['proteinBar']);

    if (isset($_SESSION['customer']) == false) {
        $_SESSION['redirectPage'] = '../control/process-order.php'; #$_SERVER['SCRIPT_NAME'];
        #echo 'previous page ' . $_SESSION['previousPage'];
        #echo 'script name: ' . $_SERVER['SCRIPT_NAME'];
        header('../view/login-form-php'); #'../view/login-form.php');       
    }
    else {
        $customer = unserialize($_SESSION['customer']);
        echo $customer->to_table() . '<br>';
        $cards = $customer->get_cards();
        echo '<br>' . $cards->to_table();
    }

    function credit_card_selector($cards) {
        $elem = '<label for="credit-card-selector">Pick your shoe size</label>';
        $elem .= '<select id="credit-card-selector" name=""credit-card-selector" form="shoe-order-form">';
        $elem .= '<option value="">Select a Payment Method</option>';

        foreach ($cards as $id => $card) {
            $elem .= '<option value="' . $id . '">' . $card->to_string() . '</option>';
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
</head>

<body>   
<header>
    <?php echo '<h1>' . $title . '</h1>'; ?>
</header>

<main>


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