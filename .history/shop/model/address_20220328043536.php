<?php
    class PostalAddress {
        private $street;
        private $city;
        private $state;
        private $zip;   
        
        public function street($street){
            $this->street = $street;
            return $this;
        }
        
        public function sex($sex){
            $this->_sex = $sex;
            return $this;
        }
  
        /*
        public function __construct($street, $city, $state, $zip) {
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
*/
        public function __toString () {
            return $this->street . ' ' . $this->city . ', ' . $this->state . ' ' . $this->zip; 
        }

    } // end class StreetAddress
  #  $address = new PostalAddress('250 Turners Crossroad South', 'Golden Valley', 'MN', '55416');

  #  echo $address . '\n' .  gettype($address) . '\n' . get_class($address);

?>