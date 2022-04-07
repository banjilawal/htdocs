<?php
    require_once ('../db/customer-queries.php');

    function collect_customers () {
        $bag = new CustomerBag();
        $mysqli = db_connect();

        $query = 'SELECT id FROM shop.customers ORDER BY id LIMIT ';  

        $stmt = $mysqli->prepare($query);
        $stmt->execute();

        $stmt->bind_result($id); #, $firstname, $lastname, $birthdate, $email, $phone, $street, $city, $state, $zip);
        
        while ($stmt->fetch()) {
            echo $id . '<br>';
            #$customer = customer_query($id);
            #$bag->add($customer);
        }
        $mysqli->close();
    }
    echo collect_customers();
?>
