<?php
    DEFINE ('CREDIT_CARD_PATTERN', '/^[0-9]{4,6}-/i');
    class CreditCard {
        private $number;
        private $securityCode; 
        private $expirationDate;

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

        public function get_number () { return $this->number; }
        public function get_expiration () { return $this->expirationDate; }
        public function get_security_code () { return $this->securityCode; }

        public function to_table () {

            $elem = '<table class="card-table">'
                    . '<tr class="card-table-header-row">'
                        . '<th>Number</th>'
                        . '<th>Expiration</th>'
                        . '<th>Security Code</th>'
                    . '</tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr>'
                        . '<td>' . $this->number . '</td>'
                        . '<td>' .  $this->date .'</td>'
                        . '<td>' . $this->securityCode . '</td>'                
                    . '</tr>'
                . '</tbody>'      
            . '</table>';
    
            return $elem;
        }

        public function __toString() {
            $text = 'card: ' . $this->number . ' expiration: '
                . ' ' . $this->expirationDate->format('m')
                . '/' . $this->expirationDate->format('y')
                . ' code: ' . $this->securityCode;

            return $text;
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
    } // end CreditCard class

    #/*
    #$date = (new DateTime('2021-7-18'));
    $card = new CreditCard();
    $card->number("037-10724-0307")->expiration((new DateTime('2020-10-24')))->security_code(677);#month(5)->year(23)->security_code(677);
    echo $card;
    echo $card->to_table();
    #*/

    class CreditCards {
        private $list = array();

        public function get_list () { return $this->list; }

        public function add ($item) {
            if (get_class($item) != get_class(new CreditCard())) {
                throw new Exception("Not a valid class member for CreditCard collector");
            }

            if ()
            array_push($this->list, $item);
        }


        public function search ($target) {
            $result = null;

            foreach ($this->list as $item) {
                if ($item->get_number() == $target) {
                    $result = $item;
                    break;
                }
            }
            return $result;
        } // close search_model

        public function search_id ($target) {
            $result = null;

            foreach ($this->list as $item) {
                if ($item->get_id() == $target) {
                    $result = $item;
                    break;
                }
            }
            return $result;
        } // close search_id

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
                . '<th class="card-column">Protein Bars/th>'
                . '</tr>'
                . '</thead>'
                . '<tbody class="table-body" id="cards-table-body" name="cards-table-body">';
    
                foreach ($this->list as $card) {
                   $elem .= '<tr id="' . $card->get_id() . '" name="' . $card->get_id() . '" onclick="send(this)">'
                        . '<td hidden="true">' . $card->get_id() . '</td>'
                        . '<td>' . $card->to_table() . '</td>'
                        . '</tr>';
                }
                
                $elem .= '<tbody></table>';
    
                return $elem;
            }

    } // end class CreditCards
?>
