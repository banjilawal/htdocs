<?php
    class Phone {
        private $areaCode;
        private $exchange;
        private $number;    
        
        public function __construct($areaCode, $exchange, $number) {
            if (is_numeric($areaCode) != 1) {
                throw new Exception("Error Processing Request", 1);
                
            }

            if ()

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
            $result = 'fail'
            if (is_numeric($var) = 1) {
                throw new Exception("Error Processing Request", 1);
                
            }
        }

    } // end class StreetAddress
    $address = new StreetAddress('250 Turners Crossroad South', 'Golden Valley', 'MN', '55416');

    echo $address . '\n' .  gettype($address) . '\n' . get_class($address);
?>