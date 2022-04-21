<?php
    #require_once('creditcard.php');  
    require_once('address.php');
    require_once('phone.php');
    require_once('creditcard.php');

    class Customer {
        private $firstname;
        private $lastname;
        private $birthdate;
        private $phone;
        private $email;
        private $address;

        private $id;
        private $card;

        public function __construct($firstname, $lastname, $phone, $email, $address) {

            if (get_class($address) != 'PostalAddress') {
                throw new Exception("address is not of the correct type");
            }

            if (get_class($phone) != 'Phone') {
                throw new Exception("Not a valid phone number", 1);    
            }

            $this->firstname = $firstname;
            $this->lastname = $lastname;
            #$this->birthdate = $birthdate;
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
        public function set_email ($email) { $this->email = $email; }

        public function set_phone ($phone) { 
            if (get_class($phone) != 'Phone')
                throw new Exception("Not a valid phone number");    
                  
            $this->phone = $phone; 
        }

        public function set_address ($address) { 
            if (get_class($address) != 'PostalAddress')
                throw new Exception("address is not of the correct type");

            $this->address = $address;  
        }

        public function set_card ($card) { 
            if (get_class($card) != 'CreditCard') 
                throw new Exception("Not a valid credit card");
                
            $this->card = $card; 
        }

        public function set_id ($id) { $this->id = $id; }       
        

        public function __toString() {
           $string = 'firstname: ' . $this->firstname . '<br>' . PHP_EOL;
           $string .= 'lastname: ' . $this->lastname . '<br>' . PHP_EOL;
          # $string .= 'birthdate: ' . $this->birthdate . '<br>' . PHP_EOL;
           $string .= 'phone: ' . $this->phone . '<br>' . PHP_EOL;
           $string .= 'email: ' . $this->email . '<br>' . PHP_EOL;
           $string .= 'address: ' . $this->address . '<br>' . PHP_EOL;
           $string .= 'card: ' . $this->card . '<br>' . PHP_EOL;

           return $string;     
        }

    } // end class Customer

    $phone = new Phone('236', '155','1825');
    $address = new PostalAddress('11681 Theatre Drive North', 'Champlin', 'MN', '55316');
    $customer = new Customer('Hannia', 'Free', $phone, 'hannia-free@aim.com', $address);
    $customer->set_id('CN-38-VDL-M7');

    echo $customer;
?>