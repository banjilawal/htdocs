<?php
    if(session_id() == '') {
        session_start();
    }
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (QUERY_PATH . '/customer-queries.php'); 

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

    $customerID = insert_customer($firstname, $lastname, $birthdate, $phone, $email, $street, $city, $state, $zip);
    
    echo '<br>Assigned customerID: ' . $customerID . '<br>' . $string;
    
    $customer = customer_query($customerID);
    insert_credit_card ($customer, $card, $expiration, $code);

    $_SESSION['customer'] = serialize($customer);
    setcookie('customerID', $customerID); 

    echo 'Welcome ' . $customer->get_firstname() . $customer->get_lastname() . ' Thank you for joining our site.'; 
    customer_cards_query($customer);
    echo $customer->to_table() . '<br><br>' . $customer->get_cards()->to_table();

    echo '<br>username: ' . (insert_customer_account ($customer, $pass)); 
    setcookier('pass', $)
    $_SESSION['email'] = $email;
    $_SESSION['pass'] = $pass;
    header ('Location:  login-handler.php');
?>