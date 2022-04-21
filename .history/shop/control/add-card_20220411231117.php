<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (QUERY_PATH . '/customer-queries.php'); #'../db/customer-queries.php');

   # echo print_r($_POST);
  #endregion  echo print_r($_SESSION);
    
    $id = $_POST['cardID'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $sec = $_POST['zip'];
    
    $customer = unserialize($_SESSION['customer']);
    $id = $customer->get_id();

    echo '<p>old address: ' . $customer->get_address() . '</p>'; 

    update_address($customer, $street, $city, $state, $zip);
    $customer = customer_query($id);

    echo $customer->to_table();
?>