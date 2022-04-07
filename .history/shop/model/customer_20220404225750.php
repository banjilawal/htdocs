<?php
    require_once('../bootstrap.php');
    require_once('postalAddress.php');
    require_once('creditCard.php');
    require_once('phone.php');

    define ('CUSTOMER_ID_PATTERN', '/CN-[2-9]{2}-[A-Z]{3}-[M-Z][2-9]/i');

    class Customer {
        private $firstname;
        private $lastname;
        private $birthdate;
        private $phone;
        private $email;
        private $address;
        private $cards;
        private $id;

        public function __construct() {
            $this->birthday = new DateTime('0000-01-01');
            $this->address = new PostalAddress ();
            $this->cards = new CreditCardBag ();
            $this->phone = new Phone ();
            $this->firstname = null;
            $this->lastname = null;
            $this->id = null;
        }

        public function phone ($phone) { 
            if (get_class($phone) != 'Phone')
                throw new Exception("Not a valid phone number");            
            $this->phone = $phone; 
            return $this;
        }

        public function address ($address) { 
            if (get_class($address) != 'PostalAddress') {
                throw new Exception("address is not of the correct type");
            }
            $this->address = $address; 
            return $this; 
        }

        public function cards ($creditCardBag) {
            if (get_class($creditCardBag) != 'CreditCardBag') {
                throw new Exception("this is not a CreditCardBag object");
            }
            $this->cards = $creditCardBag;
        }

        public function add_card ($card) { 
            if (get_class($card) != 'CreditCard') {
                throw new Exception("Not a valid credit card");
            }
            $this->cards->add($card); 
            return $this;
        }

        public function id ($id) { 
            if (preg_match(CUSTOMER_ID_PATTERN, $id) != 1) {
                throw new Exception("Not valid customer ID");
            }
            $this->id = $id;
            return $this; 
        } 

        public function firstname ($name) { 
            if (preg_match(NAME_PATTERN, $name) != 1) {
                throw new Exception("first name can only have letters and a space");
            } 
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
            if (get_class($birthdate) != get_class(new DateTime())) {
                throw new Exception("Must pass a valid DateTime to birthdate class member");
            }
            $this->birthdate = $birthdate;
            return $this;
        }

        public function get_firstname () { return $this->firstname; }
        public function get_lastname () { return $this->lastname; }
        public function get_phone () { return $this->phone; }
        public function get_email () { return $this->email; }
        public function get_address () { return $this->address; }  
        public function get_birthdate () { return $this->birthdate; }   
        public function get_id () { return $this->id; }     

        public function to_row () {

            $elem = '<tr id="' . $this->id .  '" onclick="send_customer(this)">'
                    . '<td>' . $this->firstname . '</td>'
                    . '<td>' . $this->lastname. '</td>'
                    . '<td>' . $this->birthdate->format('Y-m-d') . '</td>'
                    . '<td>' . $this->phone . '</td>'
                    . '<td>' . $this->email . '</td>'
                    . '<td>' . $this->address->get_street() . '</td>' 
                    . '<td>' . $this->address->get_city() . '</td>'    
                    . '<td>' . $this->address->get_state() . '</td>' 
                    . '<td>' . $this->address->get_zip() . '</td>' 
                . '</tr>';

            return $elem; 
        }

        public function to_table () {

            $elem = '<table class="customer-table">'
            . '<thead class="customer-table-head>'
            . '<tr class="customer-table-header-row">'
                    .  '<th>ID</th>'
                    .  '<th>First Name</th>'
                    .  '<th>Last Name</th>'
                    .  '<th>Birthdate</th>'
                    .  '<th>Phone</th>'
                    .  '<th>Email</th>'
            .   '</tr>'
            . '</thead>'
            . '<tbody>'
                    . '<tr>'
                        . '<td>' . $this->id . '</td>'
                        . '<td>' . $this->firstname . '</td>'
                        . '<td>' . $this->lastname. '</td>'
                        . '<td>' . $this->birthdate->format('Y-m-d') . '</td>'
                        . '<td>' . $this->phone . '</td>'
                        . '<td>' . $this->email . '</td>'
                . '</tr>'
                     . $this->address->to_row()
            . '</tbody>'
            . '</table>' . '<p></p>'
            . $this->cards->to_table(); 

            return $elem; 
        }

        public function __toString() {
           $string = 'id: ' .$this->id . '<br>' . PHP_EOL
            . 'firstname: ' . $this->firstname . '<br>' . PHP_EOL   
            . 'lastname: ' . $this->lastname . '<br>' . PHP_EOL
            . 'birthdate: ' . $this->birthdate->format('Y-m-d') . '<br>' . PHP_EOL
            . 'phone: ' . $this->phone . '<br>' . PHP_EOL
            . 'email: ' . $this->email . '<br>' . PHP_EOL
            . 'address: ' . $this->address . '<br>' . PHP_EOL
            . 'cards: ' . $this->cards . '<br>' . PHP_EOL;

           return $string;     
        }

    } // end class Customer

    #/*
    $address = new PostalAddress();
    $address->street('250 Turners Crossroad South')->city('Golden Valley')->state('MN')->zip('55416');

    $card = new CreditCard();
    $card->number('8440-51076-0887-4428')->expiration((new DateTime('2022-06-15')))->security_code('237');

    $phone = new Phone();
    $phone->area_code('340')->exchange(679)->number(8013);
    
    $customer = new Customer();
    $customer->firstname('Hannia')->lastname('Free')->birthdate((new DateTime('1976-06-17')));
    $customer->phone($phone)->address($address)->add_card($card)->email('hannia-free@aim.com')->id('CN-28-JQU-T3');

    $card = (new CreditCard ())->number('0848-2320-4261-2043-4135')->expiration((new DateTime('2025-12-09')))->security_code('016');

    $customer->add_card($card);
    #echo '<p>' . $customer . '</p>';

    #echo '<p>' . $customer->to_table() . '</p>';
    #*/

    class CustomerBag {
        private $list = array();

        public function add ($customer) {
            if (get_class($customer) != 'Customer') {
                throw new Exception("Not a valid class member for CreditCard collector");
            }

            $customerID = $customer->get_id();

            if (array_key_exists($customerID, $this->list) == true) {
                throw new Exception("The customer is already in the list");
            } 
            $this->list[$customerID] = $customer;
        }

        public function __toString() {
            $string = "";

            foreach ($this->list as $customer) { $string  .= $customer . '<br>' . PHP_EOL; }
            return $string;
        } // close toString

        public function to_table () {
            $elem = '<table class="table" id="customers-table" name="customers-table">'
                . '<thead class="table-head" id="customers-table-head" name="customers-table-head">'
                        .'<tr class="header-row" id="customers-table-header-row" name=""customers-table-header-row>'
                        . '<th>ID</th>'
                        . '<th>First Name</th>'
                        . '<th>Last Name</th>'
                        . '<th>Phone</th>'
                        . '<th>Email</th>'
                        . '<th>class="customer-column" Address</th>'
                    . '</tr>'
                . '</thead>'
                . '<tbody class="table-body" id="customers-table-body" name="customers-table-body">';

                foreach ($this->list as $id => $customer) {
                    $customer->to_row();
                /*    
                    $elem .= '<tr id="' . $id . '" name="' . $id . '" onclick="send(this)">'
                    . '<td hidden>' . $customer->get_id() . '</td>'
                    . '<td>' . $this->list[$id]->get_firstname() . '</th>'
                    . '<td>' . $this->list[$id]->get_lastname() . '</th>'
                    . '<td>' .  $this->list[$id]->get_phone() . '</th>'
                    . '<td>' .  $this->list[$id]->get_email() . '</th>'
                    . '<td>' .  $this->list[$id]->get_address() . '</td>'
                    . '</tr>';
                */    
                }

                $elem .= '<tbody></table>';
                return $elem;
            }

            public function get_list () { return $this->list; }

    } // end class Customers   
?>