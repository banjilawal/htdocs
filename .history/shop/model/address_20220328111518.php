<?php
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
        
        public function set_zip ($zip) {
            $this->zip = $zip;
            return $this;
        }  
 
        public function get_street () { return $this->street; }
        public function get_city () { return $this->city; }
        public function get_state () { return $this->state; }
        public function get_zip () { return $this->zip; }
        public function get_card () { return $this->card; }

        public function __toString () {
            return $this->street . ' ' . $this->city . ', ' . $this->state . ' ' . $this->zip; 
        }

    } // end class StreetAddress
    /*
  $address = new PostalAddress();
  $address->set_street('250 Turners Crossroad South')->set_city('Golden Valley')->set_state('MN')->set_zip('55416');
  echo $address . '\n' .  gettype($address) . '\n' . get_class($address);
*/
?>