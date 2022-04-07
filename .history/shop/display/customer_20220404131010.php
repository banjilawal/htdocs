<?php
    session_start();
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once ('')

    $customer = new Customer();
    $id = $_COOKIE['id'];   

    $mysqli = db_connect();
    $result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.products WHERE id = id");

    while($row = $result->fetch_assoc()) {
        $bar = (new ProteinBar())->id($row['id'])->name($row['name'])->grams($row['grams']);
        $bar->description($row['description'])->retailPrice($row['retailPrice']);
    }

    $_SESSION['bar'] = serialize($bar);
    print_r($_SESSION);
    $pageTitle = $bar->get_name() . ' ' . $bar->get_grams() . $bar->get_retailPrice();
    #echo  $pageTitle;

    $result->free();
    $mysqli->close();    
?>


<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php echo '<title>' . $bar->get_name() . ' ' . $bar->get_grams() . $bar->get_retailPrice() . '</title>'; ?>
</head>

<body>   
<header>
    <?php echo '<h1>' . $bar->get_name() . ' ' . $bar->get_grams() . $bar->get_retailPrice() . '</h1>'; ?>
</header>

<main>
    <?php echo '<h1>' . $bar->get_name() . ' ' . $bar->get_grams() . $bar->get_retailPrice() . '</h1>'; ?>
    <table>
        <tr>
            <td><?php echo '<img src="' . $proteinBar->get_imagePath() . '" width="600" height="400">'; ?></td>
            <td> <?php echo '<h2>' . $proteinBar->get_name() . '</h2>'; ?></td>
            <td><?php echo '<h2>' . $proteinBar->get_description() . '</h2>'; ?></td>
                <h2>Price</h2>
                <?php echo $proteinBar->get_retailPrice(); ?>
            </td>
            <td>
                <div><p>
                    <button type="submit" id="order" name="order" value="order" onclick="launch_order_process()">Order</button>
                </p></div>
                <div><p>
                    <button type="submit" id="review" name="order" value="order" onclick="launch_review_process()">Review</button>
                </p></div>
            </td>
        </tr>
    </table>

    <script>
        function launch_review_process () { location.href = "complete-review.php"; } 
        function launch_order_process () { location.href = "../view/fill-order-form.php"; }
    </script>
</main>

</body>
<html>