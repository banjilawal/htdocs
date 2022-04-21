<?php
    require_once('creditcard.php');  
    require_once('address.php');

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

            if (get_class())
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
    $customer = new Customer('Adaya', 'Crawford', '1992-04-27 00:00:00', '(317) 735-8016', 'adaya.crawford@yahoo.com', $address, );
    $customer->set_id('CN-72-FPN-VO');

?>

</head>

<body>

</body>
<html>