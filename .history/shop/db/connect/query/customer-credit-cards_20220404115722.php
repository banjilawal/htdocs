<?php


    function credit_cards ($customerID) {
        $mysqli = db_connect();
        $query = ;
        $bag = new CreditCardBag();
    $result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.products WHERE id = id");

    }
?>