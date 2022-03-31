<?php
    require_once (../g)
    define ('MIN_GRAMS', 10);
    define ('MAX_GRAMS', 100);
    define ('LOWEST_PRICE', 1.05);
    define ('HIGHEST_PRICE', 10.99);
    define ('WORD_PATTERN', '/^[A-Z]{5,}$/i');
    define ('NAME_PATTERN', '/^[A-Z]{5,}$|^[A-Z]{5,}\s[A-Z]{5,}$/i');

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