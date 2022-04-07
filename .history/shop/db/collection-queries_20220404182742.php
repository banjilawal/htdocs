<?php
    require_once ('customer_queries.php');

    function collect_customers () {
        $bag = new CustomerBag();
        $mysqli = db_connect();

        $query = 'SELECT id FROM shop.customers';  

        $stmt = $mysqli->prepare($query);
        $stmt->execute();

        $stmt->bind_result($id); #, $firstname, $lastname, $birthdate, $email, $phone, $street, $city, $state, $zip);
        
        while ($stmt->fetch()) {
            $customer = customer_query($id);
            $bag->add($customer);
        }
        $mysqli->close();
    }
?>
echo .col