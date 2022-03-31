<?php
    require_once('address.php');
    require_once('phone.php');
    require_once('creditcard.php');

    class Customer {
        private $firstname;
        private $lastname;
        private $phone;
        private $email;
        private $address;

        private $id;
        private $card;

        public function phone ($phone) { 
            if (get_class($phone) != 'Phone')
                throw new Exception("Not a valid phone number");            
            $this->phone = $phone; 
            return $this;
        }

        public function address ($address) { 
            if (get_class($address) != 'PostalAddress')
                throw new Exception("address is not of the correct type");
            $this->address = $address; 
            return $this; 
        }

        public function card ($card) { 
            if (get_class($card) != 'CreditCard') 
                throw new Exception("Not a valid credit card");
            $this->card = $card; 
            return $this;
        }

        public function id ($id) { 
            $this->id = $id;
            return $this; 
        } 

        public function firstname ($name) { 
            $this->firstname = $name;
            return $this;
        }
        public function lastname ($name) { 
            $this->lastname = $name;
            return $this;
        }

        public function email ($email) { 
            $this->email = $email;
            return $this;
        }

        public function get_firstname () { return $this->firstname; }
        public function get_lastname () { return $this->lastname; }
        public function get_phone () { return $this->phone; }
        public function get_email () { return $this->email; }
        public function get_address () { return $this->adddress; }        

        public function __toString() {
           $string = 'firstname: ' . $this->firstname . '<br>' . PHP_EOL;
           $string .= 'lastname: ' . $this->lastname . '<br>' . PHP_EOL;
           $string .= 'phone: ' . $this->phone . '<br>' . PHP_EOL;
           $string .= 'email: ' . $this->email . '<br>' . PHP_EOL;
           $string .= 'address: ' . $this->address . '<br>' . PHP_EOL;
           $string .= 'card: ' . $this->card . '<br>' . PHP_EOL;

           return $string;     
        }

    } // end class Customer

    $address = new PostalAddress();
    $address->set_street('250 Turners Crossroad South')->set_city('Golden Valley')->set_state('MN')->set_zip('55416');

    $date = new ExpirationDate(11, 26);
    $code = new SecurityCode(352);
    $card = new CreditCard('5043-55422-2462-8632', $date, $code);
    #echo $card;

    $phone = new Phone('236', '155','1825');
    $address = new PostalAddress('11681 Theatre Drive North', 'Champlin', 'MN', '55316');
    
    $customer = new Customer('Hannia', 'Free', $phone, 'hannia-free@aim.com', $address);
    $customer->set_id('CN-38-VDL-M7');
    $customer->set_card($card);

 #   echo $customer;
?>