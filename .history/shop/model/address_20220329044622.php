<?php
    require_once ('../global-defs.php');
    define ('ZIP_PATTERN', '/^[0-9]{5}$/');
    define ('STATES', array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z'));

    class PostalAddress {
        private $street;
        private $city;
        private $state;
        private $zip;   
        
        public function street ($street) {
            $this->street = $street;
            return $this;
        }
        
        public function city ($city) {
            $this->city = $city;
            return $this;
        }

        public function state ($state) {
            $this->state = $state;
            return $this;
        }
        
        public function zip ($zip) {
            $this->zip = $zip;
            return $this;
        }  
 
        public function get_street () { return $this->street; }
        public function get_city () { return $this->city; }
        public function get_state () { return $this->state; }
        public function get_zip () { return $this->zip; }
        public function get_card () { return $this->card; }

        public function __toString () {
            return ($this->street . ' ' . $this->city . ', ' . $this->state . ' ' . $this->zip); 
        }

    } // end class StreetAddress
/*
    $address = new PostalAddress();
    $address->street('250 Turners Crossroad South')->city('Golden Valley')->state('MN')->zip('55416');
    echo $address; # . '<br>' .  gettype($address) . '<br>' . get_class($address);
*/
?>