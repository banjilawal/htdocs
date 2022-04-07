<?php
    require_once ('customer')
    function collect_customers () {
        $customerBag = new CustomerBag();
        $mysqli = db_connect();

        $query = 'SELECT id FROM shop.customers';  

        $stmt = $mysqli->prepare($query);
        $stmt->execute();

        $stmt->bind_result($id, $firstname, $lastname, $birthdate, $email, $phone, $street, $city, $state, $zip);
        
        while ($stmt->fetch()) {
            $customer
            $phone = new Phone ();
            $phone->string_to_phone($phone);
    
            $address = new PostalAddress();
            $address->zip($zip)->state($state)->city($city)->street($street);

            $customer->id($customerID);
            $customer->address($address)->phone($phone);
            $customer->birthdate((new DateTime($birthdate)));
            $customer->firstname($firstname)->lastname($lastname)->email($email);
        }
        $mysqli->close();
    }
?>