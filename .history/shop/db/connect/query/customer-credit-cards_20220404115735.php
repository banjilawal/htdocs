<?php


    function credit_cards ($customerID) {

        $query = ;
        $bag = new CreditCardBag();
        $mysqli = db_connect();
    $result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.products WHERE id = id");

    }
?>