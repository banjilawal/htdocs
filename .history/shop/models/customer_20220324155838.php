<?php
    //require_once('creditcard.php');  

use CreditCard as GlobalCreditCard;

    class CreditCard {
        private $number;
        private $expiration;
        private $securityCode; 
        
        public function __construct($number, $date, $code) {
            $this->number = $number;
            $this->expiration = $date;
            $this->securityCode = $code;
        }

        public function get_number () { return $this->number; }
        public function get_expiration () { return $this->expiration; }
        public function get_security_code () { return $this->securityCode; }

        public function set_number ($number) { $this->number = $number; }
        public function set_expiration ($date) { $this->expiration = $date; }
        public function set_security_code ($numericStr) { $this->securityCode = $$numericStr; }

        public function __toString() {
            return 'number: ' . $this->number . ', expiration: ' . $this->expiration . ', security code: ' . $this->securityCode;
        }
    } // end CreditCard class

    $card = new CreditCard('1234-5040-8553-4993', '04/25', '909');
    echo $card;

    class StreetAddress {
        private $street;
        private $city;
        private $state;
        private $zip;    
        
        public function __construct($street, $city, $state, $zip) {
            $this->street = $street;
            $this->city = $city;
            $this->state = $state;
            $this->zip = $zip;
        }
        
        public function get_street () { return $this->street; }
        public function get_city () { return $this->city; }
        public function get_state () { return $this->state; }
        public function get_zip () { return $this->zip; }
        public function get_card () { return $this->card; }

        public function set_street ($street) { $this->street = $street; }
        public function set_city ($city) { $this->city = $city; }
        public function set_state ($state) { $this->state = $state; }
        public function set_zip ($zip) { $this->zip = $zip; }

        public function __toString () {
            return $this->street . ' ' . $this->city . ', ' . $this->state . ' ' . $this->zip; 
        }

    } // end class StreetAddress
    $address = new StreetAddress('CN-72-FPN-VO', 'Adaya', 'Crawford', '1992-04-27 00:00:00', '(317) 735-8016', 'adaya.crawford@yahoo.com', '250 Turners Crossroad South', 'Golden Valley', 'MN', '55416', '1'
    )
    
    class Customer {
        private $firstname;
        private $lastname;
        private $birthdate;
        private $phone;
        private $email;
        private $address;

        private $id;
        private $card;

        public function __construct($firstname, $lastName, $birthdate, $phone, $email, $address) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->birthdate = $birthdate;
            $this->phone = $phone;
            $this->email = $email;
            $this->address = $address;
        }

        public function get_firstname () { return $this->firstname; }
        public function get_lastname () { return $this->lastname; }
        public function get_birthdate () { return $this->birthdate; }
        public function get_phone () { return $this->phone; }
        public function get_email () { return $this->email; }
        public function get_address () { return $this->adddress; }
        
        public function set_firstname ($name) { $this->firstname = $name; }
        public function set_lastname ($name) { $this->lastname = $name; }
        public function set_birthdate ($date) { $this->birthdate = $date; }
        public function set_phone ($phone) { $this->phone = $phone; }
        public function set_email ($email) { $this->email = $email; }
        public function set_address ($address) { $this->address = $address;  }

        public function set_card ($card) { $this->card = $card; }
        

        public function __toString() {
           $string = 'firstname: ' . $this->firstname . '<br>' . PHP_EOL;
           $string .= 'lastname: ' . $this->lastname . '<br>' . PHP_EOL;
           $string .= 'birthdate: ' . $this->birthdate . '<br>' . PHP_EOL;
           $string .= 'phone: ' . $this->phone . '<br>' . PHP_EOL;
           $string .= 'email: ' . $this->email . '<br>' . PHP_EOL;
           $string .= 'address: ' . $this->address->to_string() . '<br>' . PHP_EOL;
           $string .= 'card: ' . $this->card->to_string() . '<br>' . PHP_EOL;

           return $string;     
        }

    } // end class Customer
    $customer 

?>

</head>

<body>

</body>
<html>