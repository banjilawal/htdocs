<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (QUERY_PATH . '/customer-queries.php'); #'../db/customer-queries.php');

    if (isset($_SESSION['customer']) == false) {
       // print_r($_COOKIE) . '<p></p>';
        $id = $_COOKIE['customerID']; 
        $customer = customer_query($id);   
        $_SESSION['customer'] = serialize($customer);
    }
    else {
        $customer = unserialize($_SESSION['customer']);
    }

    $orderBag = customer_orders_query($customer);
    #echo $orderItems->to_table();
?>


<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>   
<header>
    <?php echo '<h1>Hello ' . $customer->get_firstname() . ' ' .  $customer->get_lastname() . '</h1>'; ?>
</header>

<nav>
    <ul>
        <li><button type="button" onclick="get_customer_items(id)">Your Previous Orders</button></li>
        <li><button type="button" onclick="get_customer_items(id)">Your Previous Orders</button></li>
        <li><button>Update Payment Options</button></li>
        <li><button>Change Your Password</button></li>
    </ul>
</nav>
<main>
    <?php 
        echo '<p>' . $customer->to_table() . '</p>';

        echo '<h2>Credit Cards</h2>';
        echo $customer->get_cards()->to_table() . '<br>';

        echo '<h2>Order History</h2><br>';
        echo $orderBag->to_table();
    ?>

    <script>
        function get_customer_items() {
            location.href = "customer-order-item-bag.php";
        }

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