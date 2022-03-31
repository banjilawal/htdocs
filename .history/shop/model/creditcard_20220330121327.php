<?php
    DEFINE ('CREDIT_CARD_PATTERN', '/^[0-9]{4,5}-/i');
    class CreditCard {
        private $number;
        private $securityCode; 
        private $expirationDate;

        public function expiration ($date) {
            if (($date instanceof DateTime) != 1) {
                throw new Exception($date . " is not a valid date type");
            }
            #$this->expirationDate = new DateTime();
            $this->expirationDate = $date;
            return $this;
        }

        public function number ($number) { 
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

        public function __toString() {
            $text = 'card: ' . $this->number . ' expiration: '
                . ' ' . $this->expirationDate->format('m')
                . '/' . $this->expirationDate->format('y')
                . ' code: ' . $this->securityCode;

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

    #/*
    #$date = (new DateTime('2021-7-18'));
    $card = new CreditCard();
    $card->number("037-10724-0307")->expiration((new DateTime('2020-10-24')))->security_code(677);#month(5)->year(23)->security_code(677);
    echo $card;
    #*/

    
?>
