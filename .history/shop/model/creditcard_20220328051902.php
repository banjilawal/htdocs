<?php
    class ExpirationDate {
        private $month;
        private $year;

        public function set_month ($number) {
            if ($number < 1 || $number> 12) {
                throw new Exception("not a valid expiration month");     
            }   
            $this->month = $number; 
            return $this;       
        }
        
        public function set_year ($number) {
            if ($number < 0 || $number> 99) {
                throw new Exception("not a valid expiration year");     
            }   
            $this->year = $number; 
            return $this;       
        }

        public function get_month () { return $this->month; }
        public function get_year () { return $this->year; }

        public function __toString() {
            return ($this->number_string($this->month) . '/' . $this->number_string($this->year));
          # return '[' . $this->month . ' ' . $this->year . ']';
          # return ('' . $this->get_month() . '/' . $this->get_year());
        }

        private function number_string($number) {
            $text = '' . $number;

            if ($number < 10) $text = '0' . $number;

            return $text;
        }
    } // end class ExpirationDate


    class SecurityCode {
        private $code;

        public function __construct($var) {
            if (is_numeric($var) == false)
                throw new Exception("security code is not a number");

            if (strlen((string)$var) != 3)  
                throw new Exception("incorrect security code length");  

            $this->code = $var;    
        }

        public function get_code () { return $this->code; }
        public function __toString() { return ('' . $this->code); }
    }

    class CreditCard {
        private $year;
        private $month;
        private $number;
        private $securityCode; 
        private $expirationYear;
        private $expirationMonth;
        
        public function __construct($number, $date, $code) {
            if (get_class($date) != 'ExpirationDate') {
                throw new Exception("date is not an expiration date");
            }

            if (get_class($code) != 'SecurityCode') {
                throw new Exception("code is not a valid credit card security code");    
            }

            $this->number = $number;
            $this->expiration = $date;
            $this->securityCode = $code;
        }

        public function set_number ($number) { 
            $this->number = $number; 
            return $this;
        }

        public function set_month ($number) { 
            if ($number < 1 || $number> 12) {
                throw new Exception("not a valid expiration month");     
            }   
            $this->month = $number; 
            return $this;    
        }

        public function set_year ($number) {
            if ($number < 0 || $number> 99) {
                throw new Exception("not a valid expiration year");     
            }   
            $this->year = $number; 
            return $this;       
        }

        public function set_security_code ($var) {
            if (is_numeric($var) == false)
                throw new Exception("security code is not a number");

            if (strlen((string)$var) != 3)  
                throw new Exception("incorrect security code length");  

            $this->securityCode = $var; 
            return $this;   
        }

        public function get_number () { return $this->number; }
        public function get_expiration () { return $this->expiration; }
        public function get_security_code () { return $this->securityCode; }

        public function __toString() {
            $text = $this->number . ' '
                .= $this->number_string($this->month) . '/' .
                .= $this->number_string($this->year) . ' '
                .= $this->se

            return 'number: ' . $this->number . ', expiration: ' . $this->expiration . ', security code: ' . $this->securityCode;
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
?>