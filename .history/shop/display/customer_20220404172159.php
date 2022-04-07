<?php
    session_start();
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once ('../db/customer-queries.php');

    #$id = $_COOKIE['id']; 

    $customer = customer_query('CN-27-QQN-P3');
    $orders = customer_orders_query($customer);

   # $orderItems = customer_order_details_query($customer, $orders);
  
   # $customer = new Customer();
    #$orders = new OrderBag ();
    #$reviews = new ReviewBag ();
   # $creditCards = new CreditCardBag ();

    $customerQuery = 'SELECT '
        . ' id, '
        . ' firstname, '
        . ' lastname, '
        . ' birthdate, '
        . ' email, '
        . ' phone, '
        . ' street, '
        . ' city, '
        . ' state, '
        . 'zip '
    . 'FROM shop.customers WHERE id = ?';  

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
</head>

<body>   
<header>
    <?php echo '<h1>' . $customer->get_firstname() . ' ' .  $customer->get_lastname() . '</h1>'; ?>
</header>

<main>
    <?php 
        echo '<h1>' . $customer->get_firstname() . ' ' .  $customer->get_lastname() . '</h1>'; 
        echo '<p>' . $customer->to_table() . '</p>';
        echo '<h2>Order History</h2><br>';
        echo $orders->to_table();

    ?>


    <script>
        function launch_review_process () { location.href = ""; } 
        function launch_order_process () { location.href = ""; }
    </script>
</main>

</body>
<html>