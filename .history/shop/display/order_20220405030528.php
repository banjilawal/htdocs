<?php
    session_start();
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/order.php');

    print_r($_COOKIE);
    $id = $_COOKIE['customerID']; 

    $customer = customer_query($id);
    $orderBag = customer_orders_query($customer);
    #echo $orderItems->to_table();  
?>


<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php echo '<title>' . $order->get_name() . ' ' . $order->get_grams() . $order->get_retailPrice() . '</title>'; ?>
</head>

<body>   
<header>
    <?php echo '<h1>' . $order->get_name() . ' ' . $order->get_grams() . $order->get_retailPrice() . '</h1>'; ?>
</header>

<main>
    <?php echo '<h1>' . $order->get_name() . ' ' . $order->get_grams() . $order->get_retailPrice() . '</h1>'; ?>
    <table>
        <tr>
            <td><?php echo '<img src="' . $order->get_imagePath() . '" width="600" height="400">'; ?></td>
            <td> <?php echo '<h2>' . $order->get_name() . '</h2>'; ?></td>
            <td><?php echo '<h2>' . $order->get_description() . '</h2>'; ?></td>
                <h2>Price</h2>
                <?php echo $order->get_retailPrice(); ?>
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