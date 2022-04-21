<?php
    if(session_id() == '') {
        session_start();
    }
    $customer = unserialize($_SESSION['customer']);
    $title = 'Hello' . $customer->get_firstname();
 #   session_start();
 #   session_unset();
 #   session_destroy();
 #   session_write_close();
 #   setcookie(session_name(),'',0,'/');
 #   session_regenerate_id(true);
    require_once ('../bootstrap.php');

    require_once (MODEL_PATH . '/proteinBar.php');
    require_once ('../db/collection-queries.php');

    $proteinBarBag = collect_protein_bars(115);
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
      <title>Protein Bars</title>
</head>

<body>   
<header>
    <?php echo '<h1>' .
</header>
<nav>
    <ul>
        <li><button type="button" onclick="get_customer_items(id)">Your Previous Orders</button></li>
        <li><button type="button" onclick="change_address()">Update Your Addresss</button></li>
        <li><button type="button" onclick="change_phone()">Update Your Phone</button></li>
        <li><button type="button" onclick="new_card()">Add Credit Card</button></li>
    </ul>
</nav>

<main>
    <h1>Our Protein Bars</h1>
    <?php  echo $proteinBarBag->to_table(); ?>

    <script>
        function get_customer_items() {
            location.href = "customer-order-item-bag.php";
        }

        function change_address() {
            location.href = "../view/address-update-form.php";
        }

        function change_phone() {
            location.href = "../view/phone-update-form.php";
        }

        function new_card() {
            location.href = "../view/new-credit-card-form.php";
        }

        function send_protein_bar (row) {
            data = row.childNodes[0];
            cell = row.cells[0];
            cookie = document.cookie = "proteinBarID=" + cell.innerHTML + ""; // + "; max-age=5";

            location.href = "protein-bar.php";
        }
    </script>
</main>
</body>
<html>