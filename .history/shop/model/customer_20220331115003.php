<?php
    require_once('address.php');
    require_once('phone.php');
    require_once('creditcard.php');

    define ('CUSTOMER_ID_PATTERN', '/^CN-[2-9][2-9]-[A-Z][A-Z][A-Z]-[M-Z][2-9]$/i');

    class Customer {
        private $firstname;
        private $lastname;
        private $birthdate;
        private $phone;
        private $email;
        private $address;
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
        public function get_birthdate () { return $this->birthdate; }      

        public function to_table () {

            $elem = '<table class="customer-table">'
            . '<thead class="customer-table-head>'
            . '<tr class="customer-table-header-row">'
            .   '<th>Street</th>'
            .   '<th>City</th>'
            .   '<th>State</th>'
            .   '<th>Zip</th>'
            .   '</tr>'
            . '</thead>'
            . '<tbody>'
            . '<tr>'
            . '<td>' . $this->firstname . '</td>'
            . '<td>' . $this->lastname. '</td>'
            . '<td>' . $this->birthdate . '</td>'
            . '<td>' . $this->email . '</td>'
            . '</tr>'
            . '</tbody>'
            . '</table>';

            return $elem; 
        }

        public function __toString() {
           $string = 'firstname: ' . $this->firstname . '<br>' . PHP_EOL;
           $string .= 'lastname: ' . $this->lastname . '<br>' . PHP_EOL;
           $string .= 'birthdate: ' . $this->birthdate . '<br>' . PHP_EOL;
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
    $customer->firstname('Hannia')->lastname('Free')->birthdate('1976-06-17')->phone($phone)->address($address)->card($card)->email('hannia-free@aim.com');
    echo $customer;
    */

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
                . '<tr class="header-row" id="customers-table-header-row" name=""customers-table-header-row>'
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
                        . '<td>Phone Name/th>'
                        . '<td>EmailName/th>'
                        . '<td>Address Name/th>'
                        . '</td>';
                }
                
                $elem .= '<tbody></table>';
    
                return $elem;
            }

    } // end class CreditCards   
?>