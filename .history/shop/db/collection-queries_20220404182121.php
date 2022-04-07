<?php

    function collect_customers () {
        $customerBag = new CustomerBag();
        $mysqli = db_connect();

        $query = 'SELECT id, firstname, lastname, birthdate, email, '
            . 'phone, street, city, state, zip. '
            . 'FROM shop.customers';  

        $stmt = $mysqli->prepare($query);
        $stmt->execute();

        $stmt->bind_result($id, $firstname, $lastname, $birthdate, $email, $phone, $street, $city, $state, $zip);
        
        
    }
?>