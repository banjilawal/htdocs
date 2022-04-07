<?php
    require_once ('../../bootstrap.php');
   # require_once('../../model/creditCard.php');

    function credit_cards () { #$customerID) {
     #   $bag = new CreditCardBag();

        $query = 'SELECT '
            . 'c.id, '
            . 'c.expiration, '
            .  'c.securityCode, '
            . 'FROM shop.customers p '
            . 'INNER JOIN shop.cards c '
            . 'ON p.id = c.customerID ';
           # . 'WHERE p.id = ?';

        $mysqli = db_connect();
        $result = $mysqli->query($query);
        #$stmt = $mysqli->prepare($query);
      #  $stmt->bind_param('s', $customerID);
       # $stmt->execute();
       # $stmt->bind_result($$number, $expiration, $securityCode);

        while ($stmt->fetch()) {
            echo $number . ',' . $numberexpiration . ',' . $securityCode;
        }
        #$result = $stmt->get_result();

        #$result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.products WHERE id = id");
        #return $bag;
    }
    credit_cards();
?>