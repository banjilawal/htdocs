<?php
    class Phone {
        private $areaCode;
        private $exchange;
        private $number;    
        
        public function __construct($areaCode, $exchange, $number) {
            if (validate_code($areaCode) == 'fail') {
                throw new Exception("Error Processing Request", 1);
                
            }

            $this->street = $street;
            $this->city = $city;
            $this->state = $state;
            $this->zip = $zip;
        }
        
        public function get_street () { return $this->street; }
        public function get_city () { return $this->city; }
        public function get_state () { return $this->state; }
        public function get_zip () { return $this->zip; }
        public function get_card () { return $this->card; }

        public function set_street ($street) { $this->street = $street; }
        public function set_city ($city) { $this->city = $city; }
        public function set_state ($state) { $this->state = $state; }
        public function set_zip ($zip) { $this->zip = $zip; }

        public function __toString () {
            return $this->street . ' ' . $this->city . ', ' . $this->state . ' ' . $this->zip; 
        }

        private function validate_code($var) {
            $result = 'pass';

            if (is_string($var)) {
                if ((is_numeric($var) && (strlen($var) == 3)))
                    $result = 'pass';
            }
            else if (is_int($var)) {
                if (strlen(string($var)) == 3)
                    $result = 'pass';      
            }
            else { $result = 'fail';}

            return $result;
        }
        
        private function validate_number($var) {
            $result = 'pass';

            if (is_string($var)) {
                if ((is_numeric($var) && (strlen($var) == 4)))
                    $result = 'pass';
            }
            else if (is_int($var)) {
                if (strlen(string($var)) == 4)
                    $result = 'pass';      
            }
            else { $result = 'fail';}

            return $result;
        }


    } // end class StreetAddress
    $address = new StreetAddress('250 Turners Crossroad South', 'Golden Valley', 'MN', '55416');

    echo $address . '\n' .  gettype($address) . '\n' . get_class($address);
?>