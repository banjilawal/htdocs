<?php
    DEFINE ('CREDIT_CARD_PATTERN', '/^[A-/i');
    class CreditCard {
        private $year;
        private $month;
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
            $this->number = $number; 
            return $this;
        }

        public function month ($number) { 
            if ($number < 1 || $number> 12) {
                throw new Exception("not a valid expiration month");     
            }   
            $this->month = $number; 
            return $this;    
        }

        public function year ($number) {
            if ($number < 0 || $number> 99) {
                throw new Exception("not a valid expiration year");     
            }   
            $this->year = $number; 
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

        public function get_year () { return $this->year; }
        public function get_month () { return $this->month; }
        public function get_number () { return $this->number; }

        public function get_expiration () { return $this->expirationDate; }
        public function get_security_code () { return $this->securityCode; }

        public function __toString() {
            $text = $this->number
                . ' ' . $this->number_string($this->month) 
                . '/' . $this->number_string($this->year)
                . ' ' . $this->securityCode;

            return $text;
        }

        private function number_string($number) {
            $text = '' . $number;

            if ($number < 10) $text = '0' . $number;
            return $text;
        }

        private function validate_number($var) {
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

    /*
    $card = new CreditCard();
    $card->number("037-10724-0307")->month(5)->year(23)->security_code(677);
    echo $card;
    */
?>
