<?php
    session_start();
    require_once ('../bootstrap.php');

    require_once (MODEL_PATH . '/review.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once ('../protein-bar-queries.php');

    #print_r($_COOKIE);
    $id = $_COOKIE['proteinBarID']; 
    $proteinBar = protein_bar_query($id);
    $reviewBag = protein_bar_review_query($proteinBar);

    $_SESSION['proteinBag'] = serialize($proteinBag);

    $title = $proteinBar->get_name() . ' ' . $proteinBar->get_grams() . $proteinBar->get_retailPrice();
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

<nav>
    <ul>
        <li><button type="button" onclick="get_customer_items(id)">Your Previous Orders></button></li>
        <li><button>Update Your Personal Information</button></li>
        <li><button>Update Payment Options</button></li>
        <li><button>Change Your Password</button></li>
    </ul>
</nav>
<main>
    <?php 
        echo '<p>' . $proteinBar->to_table() . '</p>';

        echo '<h2>Reviews</h2>';
        echo $reviewBag->to_table
    ?>

    <script>
        function send_order(row) {
            data = row.childNodes[0];
            cell = row.cells[0];
            cookie = document.cookie = "orderID=" + cell.innerHTML; // + "; max-age=5";

            location.href = "order.php";
        }
    </script>
</main>

</body>
<html>