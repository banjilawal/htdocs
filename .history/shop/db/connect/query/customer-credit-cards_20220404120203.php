<?php


    function credit_cards ($customerID) {
        $bag = new CreditCardBag();

        $query = 'SELECT'
            . ' c.id,'
            . ' c.expiration,'
            c.securityCode,
    FROM 
    shop.customers p
    INNER JOIN shop.cards c
    ON p.id = c.customerID
    WHERE p.id = ?;
        $mysqli = db_connect();
    $result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.products WHERE id = id");
         return $bag;
    }
?>