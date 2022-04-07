<?php
    require_once('../bootstrap.php');
    
    DEFINE ('CREDIT_CARD_PATTERN', '/([0-9]{3,}-){2,}/i');
    DEFINE ('CARD_STATES', array('chargable', 'expired', 'declined'));
    class CreditCard {
        private $status;
        private $number;
        private $securityCode; 
        private $expirationDate;

        public function __construct()   {
            $this->status = null;
            $this->number = null;
            $this->securityCode = null;
            $this->expirationDate = new DateTime('0000-00-01');
        }

        public function expiration ($date) {
            if (($date instanceof DateTime) != 1) {
                throw new Exception($date . " is not a valid date type");
            }
            $this->expirationDate = $date;
            return $this;
        }

        public function number ($number) { 
           if (preg_match(CREDIT_CARD_PATTERN, $number) != 1) {
                throw new Exception($number . " is not a valid credit card number");
            }
            $this->number = $number; 
            return $this;
        }

        public function security_code ($var) {
            if (is_numeric($var) == false)
                throw new Exception("security code is not a number");

            if (strlen((string)$var) != 3)  
                throw new Exception("incorrect security code length");  

            $this->securityCode = $var; 
            return $this;   
        }

        public function status ($status) {
            if (in_array($this->status, CARD_STATES, $strict = true) == false) {
                throw new Exception($status . " is not a valid state acronym");
            }
            $this->status = $status;
            return $this;
        }

        public function to_row () {
            $elem = '<tr id="' . $this->number . '" onclick="send_card(this)">'
                    . '<td>**-' . $this->print_number() . '</td>'
                    . '<td>' .  $this->date_string() .'</td>'
                    . '<td>' . $this->securityCode . '</td>'                
                . '</tr>';
            return $elem;    
        }   


        public function to_table () {
            $elem = '<table class="card-table">'
                . '<tr>'
                    . '<td>**-' . $this->print_number() . '</td>'
                    . '<td>' .  $this->date_string() .'</td>'
                    . '<td>' . $this->securityCode . '</td>'                
                . '</tr>'     
            . '</table>';
    
            return $elem;
        }

        public function __toString() {
            $text = '[**-' . $this->print_number() 
                . ' '. $this->date_string()
                . ' ' . $this->securityCode . ']';
            return $text;
        }

        public function print_number () {
            $blocks = explode('-', $this->number); 
            $length = sizeof($blocks);

            return $blocks[$length - 1];
        }

        private function date_string () {
            return $this->expirationDate->format('m') . '/' . $this->expirationDate->format('y');
        }
        
        private function validate_securityCode($var) {
            $result = 'fail';

            if (is_string($var)) {
                if ((is_numeric($var) && (strlen($var) == 3)))
                    $result = 'pass';
            }
            
            if (is_int($var)) {
                if (strlen((string)$var) == 3)
                    $result = 'pass';      
            }
            return $result;
        }

        public function get_status () { return $this->status; }
        public function get_number () { return $this->number; }
        public function get_expiration () { return $this->expirationDate; }
        public function get_security_code () { return $this->securityCode; }

    } // end CreditCard class


    /*   
        echo (new DateTime('0000-01-01'))->format('Y-m-d');
        #$date = (new DateTime('2021-7-18'));
        $card = new CreditCard();
        $card->number("2037-10724-0307-8385-1280")->expiration((new DateTime('2020-10-24')))->security_code(677);
        echo $card->to_table();
    */

    class CreditCardBag {
        private $list = array();

        public function get_list () { return $this->list; }

        public function add ($card) {
            if (get_class($cardm) != 'CreditCard') {
                throw new Exception("Not a valid class member for CreditCard collector");
            }

            $cardID = $card->get_id();

            if (array_key_exists($customerID, $this->list) == true) {
                throw new Exception("The customer is already in the list");
            } 

            if ($this->search($item->get_number()) != null) {
                throw new Exception("The credit card is already in the list");
            }
            $this->list[] = $item;
            if (get_class($customer) != 'Customer') {
                throw new Exception("Not a valid class member for CreditCard collector");
            }

            $customerID = $customer->get_id();


            $this->list[$customerID] = $customer;
        }

        public function search ($target) {
            $result = null;

            foreach ($this->list as $card) {
                if ($card->get_number() == $target) {
                    $result = $card;
                    break;
                }
            }
            return $result;
        } // close search_model

        public function __toString() {
            $string = "";

            foreach ($this->list as $card) { $string  .= $card . '<br>' . PHP_EOL; }
            return $string;
        } // close toString

        public function to_table () {
    
            $elem = '<table class="table" id="credit-cards-table" name="credit-cards-table">'
                        . '<thead class="table-head" id="credit-cards-table-head" name="credit-cards-table-head">'
                        . '<tr class="header-row" id="credit-cards-table-header-row" name=""credit-cards-table-header-row>'
                            . '<th class="id-column" hidden="true">Row</th>'
                            . '<th class="card-column">Card Number</th>'
                            . '<th class="card-colum">Expiration</th>'
                            . '<th class="card-colum">Security Code</th>'                           
                        . '</tr>'
                    . '</thead>'
                . '<tbody class="table-body" id="cards-table-body" name="cards-table-body">';
    
                foreach ($this->list as $card) {
                   $elem .= '<tr id="' . $card->print_number() . '" name="' . $card->print_number() . '" onclick="send(this)">'
                        . '<td hidden="true">' . $card->print_number() . '</td>'
                        . '<td>' . $card->to_table() . '</td>'
                        . '</tr>';
                }
                
                $elem .= '<tbody></table>';
    
                return $elem;
            }

    } // end class CreditCards
?>
