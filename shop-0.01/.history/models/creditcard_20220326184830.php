<?php
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

    $card = new CreditCard('5043-55422-2462', '09/25', '202', , '3'
);

?>