<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (QUERY_PATH . '/customer_queries.php');

    //print_r($_POST);

    if (isset($_POST['firstname'])) $firstname = $_POST['firstname']; 
    if (isset($_POST['lastname'])) $lastname = $_POST['lastname']; 
    if (isset($_POST['birthdate'])) $birthdate = $_POST['birthdate']; 
    if (isset($_POST['phone'])) $phone = $_POST['phone']; 
    if (isset($_POST['email'])) $email = $_POST['email']; 
    if (isset($_POST['street'])) $street = $_POST['street']; 
    if (isset($_POST['city'])) $city = $_POST['city']; 
    if (isset($_POST['state'])) $state = $_POST['state']; 
    if (isset($_POST['zip'])) $zip = $_POST['zip']; 
    if (isset($_POST['card'])) $card = $_POST['card']; 
    if (isset($_POST['expiration'])) $expiration = $_POST['expiration']; 
    if (isset($_POST['code'])) $code = $_POST['code']; 
    if (isset($_POST['pass'])) $pass = $_POST['pass']; 


    $string = '<p>' . $firstname . ' ' . $lastname . ' ' . $birthdate . ' '. $phone . ' ' . $email 
        . ' ' . $street  . ' ' . $city . ' ' . $state . ' ' . $zip
        . ' ' . $card . ' ' . $expiration . ' ' . $code 
        . ' ' . $pass . ' ' . $_POST['confirmPass'] . '</p>'; 
    
    $customerID = assign_customer_id ();
    
    echo 'customerID: ' . $customerID . $tring;
    

    echo $string;    
?>