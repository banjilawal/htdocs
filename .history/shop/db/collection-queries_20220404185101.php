<?php
    require_once ('../db/customer-queries.php');

    function collect_customers ($count) {
        $bag = new CustomerBag();
        $mysqli = db_connect();

        $query = 'SELECT id FROM shop.customers ORDER BY id LIMIT ?';  

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $count);
        $stmt->execute();


        $stmt->bind_result($id); #, $firstname, $lastname, $birthdate, $email, $phone, $street, $city, $state, $zip);
        
        while ($stmt->fetch()) {
            echo $id . '<br>';
            $customer = customer_query($id);
            echo $customer;
            
            $bag->add($customer);
        }
        $mysqli->close();
    }
    echo collect_customers(10);
?>
