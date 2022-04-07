<?php
    require_once ('../db/customer-queries.php');
    require_once ('../db/order-queries.php');

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
            $bag->add($customer);
        }
        $mysqli->close();
        return $bag;
    }
  #$customers = collect_customers(20);
  #echo $customers->to_table();

  function collect_orders ($count) {
    $bag = new OrderBag();
    $mysqli = db_connect();

    $query = 'SELECT id FROM shop.orders ORDER BY id LIMIT ?';  

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $count);
    $stmt->execute();
    $stmt->bind_result($id);
    
    while ($stmt->fetch()) {
        $order = order_query($id);            
        $bag->add($order);
    }
    $mysqli->close();
    return $bag;
}

function collect_protein_bars () {
    $bag = new PrBag();
    $mysqli = db_connect();

    $query = 'SELECT id FROM shop.orders ORDER BY id LIMIT ?';  

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $count);
    $stmt->execute();
    $stmt->bind_result($id);
    
    while ($stmt->fetch()) {
        $order = order_query($id);            
        $bag->add($order);
    }
    $mysqli->close();
    return $bag;
}
#$orders = collect_orders(20);
#echo $orders->to_table();
?>
