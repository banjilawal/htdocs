<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once (MODEL_PATH . '/orderItem.php');
    require_once (MODEL_PATH . '/customer.php');
    require_once (MODEL_PATH . '/order.php');
    require_once ('customer-queries.php');

    session_start();

    print_r($_POST) . '<p></p>';

    $email = isset($_POST['email']) ?? 'nobody';
    $password = isset($_POSt['password']) ?? 'nopass';

    function login ($email, $password) {
        $mysqli = db_connect();
        $customer = null;

        

        $query = 'SELECT a.username, a.pass, c.id customerID, firstname, lastname, '
            . 'birthdate, email, phone, street, city, state, zip FROM shop.customer_accounts a '
            . 'INNER JOIN shop.customers c ON a.username = c.username WHERE c.email = ?'; # = ? AND pass = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $email); #, $password);
        $stmt->query->execute();

        $stmt->bind_result($customerID, $firstname, $lastname, $birthdate, $email, $mobile, $street, $city, $state, $zip);
        while ($stmt->fetch()) {
            $customer = new Customer();

            $phone = new Phone ();
            $phone->string_to_phone($mobile);
    
            $address = new PostalAddress();
            $address->zip($zip)->state($state)->city($city)->street($street);

            $customer->id($customerID);
            $customer->address($address)->phone($phone);
            $customer->birthdate((new DateTime($birthdate)));
            $customer->firstname($firstname)->lastname($lastname)->email($email);
        }
        $mysqli->close();
        echo '<p></p>' . $customer->to_table();
    }
    login($email, $password);

    
?>