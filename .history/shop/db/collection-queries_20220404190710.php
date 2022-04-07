<?php
    require_once ('../db/customer-queries.php');

    function collect_customers ($count) {
        $bag = new CustomerBag();
        $mysqli = db_connect();

        $query = 'SELECT id FROM shop.customers ORDER BY id LIMIT ?';  

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $count);
        $stmt->execute();
        $stmt->bind_result($id);
        
        while ($stmt->fetch()) {
            $customer = customer_query($id);
            #echo $customer;
            
            $bag->add($customer);
        }
        $mysqli->close();
        return $bag;
    }
  $bag = collect_customers(10);
  echo $bag;
?>
