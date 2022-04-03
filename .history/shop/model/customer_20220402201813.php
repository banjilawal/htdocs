<?php
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
            if (get_class($phone) != get_class((new Phone())))
                throw new Exception("Not a valid phone number");            
            $this->phone = $phone; 
            return $this;
        }

        public function address ($address) { 
            if (get_class($address) != get_class(new PostalAddress ())) {
                throw new Exception("address is not of the correct type");
            }
            $this->address = $address; 
            return $this; 
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
        public function get_address () { return $this->adddress; }  
        public function get_birthdate () { return $this->birthdate; }      

        public function to_row () {

            $elem = '<tr id="' . $this->id . '" onclick></tr>'
                    . '<td>' . $this->firstname . '</td>'
                    . '<td>' . $this->lastname. '</td>'
                    . '<td>' . $this->birthdate->format('Y-m-d') . '</td>'
                    . '<td>' . $this->phone . '</td>'
                    . '<td>' . $this->email . '</td>'
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
                     . $this->address->to_row() . '</td>' 
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
            . 'card: ' . $this->cards . '<br>' . PHP_EOL;

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

    class Customers {
        private $list = array();

        public function get_list () { return $this->list; }

        public function add ($customer) {
            if (get_class($customer) != get_class(new Customer())) {
                throw new Exception("Not a valid class member for CreditCard collector");
            }

            if ($this->search($customer->get_id()) != null) {
                throw new Exception("The customer is already in the list");
            }
            array_push($this->list, $customer);
        }

        public function search ($target) {
            $result = null;

            foreach ($this->list as $item) {
                if ($item->get_id() == $target) {
                    $result = $item;
                    break;
                }
            }
            return $result;
        } // close search_model

        public function __toString() {
            $string = "";

            foreach ($this->list as $customer) { $string  .= $customer . '<br>' . PHP_EOL; }
            return $string;
        } // close toString

        public function to_table () {
            $elem = '<table class="table" id="customers-table" name="customers-table">'
                . '<thead class="table-head" id="customers-table-head" name="customers-table-head">'
                        .'<tr class="header-row" id="customers-table-header-row" name=""customers-table-header-row>'
                        . '<th class="id-column" hidden="true">ID</th>'
                        . '<th class="customer-column">First Name</th>'
                        . '<th class="customer-column">Last Name</th>'
                        . '<th class="customer-column">Phone</th>'
                        . '<th class="customer-column">Email</th>'
                        . '<th class="customer-column">Address</th>'
                    . '</tr>'
                . '</thead>'
                . '<tbody class="table-body" id="customers-table-body" name="customers-table-body">';
    
                foreach ($this->list as $customer) {
                   $elem .= '<tr id="' . $customer->get_id() . '" name="' . $customer->get_id() . '" onclick="send(this)">'
                        . '<td>' . $customer->get_id() . '</td>'
                        . '<td>' . $customer->get_firstname() . '</th>'
                        . '<td>' . $customer->get_lastname() . '</th>'
                        . '<td>' . $customer->get_phone() . '</th>'
                        . '<td>' . $customer->get_email() . '</th>'
                        . '<td>' . $customer->get_address->to_table() . '</th>'
                        . '</td>';
                } 

                $elem .= '<tbody></table>';
                return $elem;
            }

    } // end class Customers   
?>