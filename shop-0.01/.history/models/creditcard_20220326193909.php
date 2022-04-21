<?php
    class ExpirationDate {
        private $month;
        private $year;

        public function __construct($month, $year) {
            if ($month < 1 || $month > 12) {
                throw new Exception("not a valid month");
                
            }

            if ($year < 0 || $year > 99) {
                throw new Exception("Not a valid expiration year");
            } 

            $this->$month = $month;
            $this->$year = $year;
        }

        public function get_month () { return $this->month; }
        public function get_year () { return $this->year; }

        public function set_month ($number) {
            if ($number < 1 || $number> 12) {
                throw new Exception("not a valid expiration month");     
            }   
            $this->month = $number;        
        }
        
        public function set_year ($number) {
            if ($number < 0 || $number> 99) {
                throw new Exception("not a valid expiration year");     
            }   
            $this->year = $number;        
        }

        public function __toString() {
            $text = '';
            
            if ($month < 10) 
        }

        private function number_string($number) {
            if ($number < 10) return ('0' . $this->month);
            else return $this->month;
        }
        
        
        private function yearr_string() {
            if ($this->year < 10) return ('0' . $this->month);
            else return $this->month;
        }

    } // end class ExpirationDate
    class CreditCard {
        private $number;
        private $expiration;
        private $securityCode; 
        
        public function __construct($number, $date, $code) {
            $this->number = $number;
            $this->expiration = $date;
            $this->securityCode = $code;
        }

        public function get_number () { return $this->number; }
        public function get_expiration () { return $this->expiration; }
        public function get_security_code () { return $this->securityCode; }

        public function set_number ($number) { $this->number = $number; }
        public function set_expiration ($date) { $this->expiration = $date; }
        public function set_security_code ($numericStr) { $this->securityCode = $$numericStr; }

        public function __toString() {
            return 'number: ' . $this->number . ', expiration: ' . $this->expiration . ', security code: ' . $this->securityCode;
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

    $card = new CreditCard('5043-55422-2462', '09/25', '202');
    echo $card;

?>