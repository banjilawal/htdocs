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
        private $birthdate;
        private $card;
        private $id;


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

        public function birthdate ($birthdate) {
            $this->birthdate = $birthdate;
            return $this;
        }

        public function get_firstname () { return $this->firstname; }
        public function get_lastname () { return $this->lastname; }
        public function get_phone () { return $this->phone; }
        public function get_email () { return $this->email; }
        public function get_address () { return $this->adddress; }  
        public function get_birthdate      

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

    /*
    $address = new PostalAddress();
    $address->set_street('250 Turners Crossroad South')->set_city('Golden Valley')->set_state('MN')->set_zip('55416');

    $card = new CreditCard();
    $card->number("037-10724-0307")->month(5)->year(23)->security_code(677);

    $phone = new Phone();
    $phone->area_code('340')->exchange(679)->number(8013);
    
    $customer = new Customer();
    $customer->firstname('Hannia')->lastname('Free')->phone($phone)->address($address)->card($card)->email('hannia-free@aim.com');
    echo $customer;
    */
?>