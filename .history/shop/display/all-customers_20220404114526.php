<?php
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
 #   setcookie(session_name(),'',0,'/');
 #   session_regenerate_id(true);
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');

    $customerBag = new CustomerBag();

    $mysqli = db_connect();
    
    $query = 'SELECT '
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
    . 'FROM shop.customers';    
    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()) {
        $customerID = ['customerID'];
        $firstname = ['firstname'];
        $lastname = ['lastname'];
        $birthdate = ['birthdate'];
        $email = ['email'];
        $phone = ['phone'];
        $street = ['street'];
        $city = ['city'];
        $state = ['state'];
        $zip = ['zip'];

        $phone = new Phone ();
        $phone->string_to_phone($phone);

        $address = new PostalAddress();
        $address->zip($zip)->state($state)->city($city)->street($street);

        $customer = new Customer();
        $customer->id($customerID);
        $customer->address($address)->phone($phone);
        $customer->firstname($firstname)->lastname($lastname)->email($email);

        echo $customer . '<br>';

        $customers->add($customer);
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
      <title>Our Customers</title>
</head>

<body>   
<header>
    <h1>Our Protein Bars</h1>
</header>

<nav></nav>
<main>
    <?php  echo $customerBag->to_table(); ?>
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