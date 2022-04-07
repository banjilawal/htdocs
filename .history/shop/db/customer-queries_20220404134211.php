<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');

    function customer_query ($customerID) {
        $mysqli = db_connect();
        $customer = new Customer();

        $query = 'SELECT id, firstname, lastname, birthdate, email, phone, '
            . 'street, city, state, zip FROM shop.customers WHERE id = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $customerID);
        $stmt->execute();

        $stmt->bind_result($id, $firstname, $lastname, $birthdate, $email, $phone, $street, $city, $state, $zip);

        while ($stmt->fetch()) {
            $phone = new Phone ();
            $phone->string_to_phone($phone);
    
            $address = new PostalAddress();
            $address->zip($zip)->state($state)->city($city)->street($street);

            $customer->id($customerID);
            $customer->address($address)->phone($phone);
            $customer->birthdate((new DateTime($birthdate)));
            $customer->firstname($firstname)->lastname($lastname)->email($email);
        }
        $cards = customer_cards_query($customerID);
        $

        return $customer;
        $mysqli->close();
    }
    echo customer_query('CN-73-MNX-N3');


    function customer_cards_query ($customerID) {
        $bag = new CreditCardBag();

        $query = 'SELECT '
            . 'c.id, '
            . 'c.expiration, '
            .  'c.securityCode '
            . 'FROM shop.customers p '
            . 'INNER JOIN shop.cards c '
            . 'ON p.id = c.customerID '
            . 'WHERE p.id = ?';

        $mysqli = db_connect();

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $customerID);
        $stmt->execute();
        $stmt->bind_result($number, $expiration, $securityCode);

        while ($stmt->fetch()) {
            $card = new Creditcard();

            $card->number($number);
            $card->security_code($securityCode);
            $card->expiration((new DateTime($expiration)));

            $bag->add($card);
        }
 #       echo $bag;
 #       echo $bag->to_table();
        return $bag;
        $mysqli->close();
    }
?>