<?php
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
 #   setcookie(session_name(),'',0,'/');
 #   session_regenerate_id(true);
    require_once ('../bootstrap.php');
    require_once ('../model/customer.php');
    require_once ('../model/order.php');
    require_once ('../model/orderItem.php');
    require_once (MODEL_PATH . '/proteinBar.php');

    $orderID = null;
    $status = null;   
    $amount = 0.00;
    $total = 0.00;   
    $customer = new Customer();
    $items = new OrderItemBag ();
    $submissionTime = new DateTime('0000-01-01');
    $estimatedDelivery = new DateTime('0000-01-01');
    $actualDelivery = new DateTime('0000-01-01');

    $orderBag = new OrderBag ();




    $mysqli = db_connect();

    $query = 'SELECT '
        . 'o.id orderID, '
        . 'o.status, '
        . 'o.submissionDate,. '
        . 'o.estimatedDeliveryDate,. '
        . 'o.actualDeliveryDate,. '
        . 'c.id customerID,. '
        . 'c.firstname, '
        . 'c.lastname, '
        . 'c.email, '
        . 'c.phone, '
        . 'c.street, '
        . 'c.city, '
        . 'c.state, '
        . 'c.zip, '
        . 'i.quantity, '
        . 'i.charge cost, '
        . 'o.total, '
        . 'p.id productID, '
        . 'p.name, '
        . 'p.description, '
        . 'p.grams, '
        . 'p.retailPrice '
    . 'FROM shop.customers c '
    . 'INNER JOIN shop.orders o '
        . 'INNER JOIN shop.orderItems i '
            . 'INNER JOIN shop.products p '
            . 'ON i.productID = p.id '
        . 'ON o.id = i.orderID '
    . 'ON c.id = o.customerID ';
    

    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()) {
        $orderID = ['orderID'];
        $status = ['status'];
        $submissionTime = ['submissionDate'];
        $estimatedDelivery = ['estimatedDeliveryDate'];
        $actualDelivery = ['actualDeliveryDate'];
        $customerID = ['customerID'];
        $firstname = ['firstname'];
        $lastname = ['lastname'];
        $email = ['email'];
        $phone = ['phone'];
        $street = ['street'];
        $city = ['city'];
        $state = ['state'];
        $zip = ['zip'];
        $quantity = ['quantity'];
        $cost = ['cost'];
        $total = ['total'];
        $productID = ['productID'];
        $name = ['name'];
        $description = ['description'];
        $grams = ['grams'];
        $retailPrice = ['retailPrice'];

        $proteinBar = new ProteinBar();
        $proteinBar->id($row['id'])->name($row['name'])->grams($row['grams']);
        $proteinBar->description($row['description'])->retailPrice($row['retailPrice']); 

        $orderItem = new OrderItem();
        $orderItem->proteinBar($proteinBar)->quantity(3);

        $phone = (new Phone ())->string_to_phone((new OrderItem())->proteinBar($proteinBar)->quantity(3)
        $customer = new Customer();


        $order = (new order())->id($row['orderID'])->status($row['status'])->su($row['grams']);
        $order->description($row['description'])->retailPrice($row['retailPrice']); 
        $string  .=  'orderID:' . $item->get_id() . ' customerID:' . $item->get_customer()->get_id() 
        . ' status:' . $item->get_status()
        . ' total:' . $item->get_total()
        . ' tax:' . $item->get_tax()
        . ' submitted:' . $item->get_submission_time()->format('Y-m-d hh:mm:s')
        . ' delivered:' . $item-> get_actual_delivery()->format('Y-m-d hh:mm:s') . '<br>' .PHP_EOL;
        $orderBag->add($order);
        #echo $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] . ', '.  $row['grams'] . ', ' .  $row['retailPrice'] . '<br>';
    }

    $result->free();
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
      <title>Orders</title>
</head>

<body>   
<header>
    <h1>Orders</h1>
</header>

<nav></nav>
<main>
    <?php  echo $orderBag->to_table(); ?>
    <script>
        function send (row) {
            //var x = row.getAttribute("id")
            //alert(x);
            data = row.childNodes[0];
            cell = row.cells[0];
            //alert(cell.innerHTML);
            cookie = document.cookie = "id=" + cell.innerHTML; // + "; max-age=5";

            location.href = "display-selected-protein-bar.php";
        }
    </script>
</main>
</body>
<html>