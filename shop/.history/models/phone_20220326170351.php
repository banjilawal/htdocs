<?php
    class Phone {
        private $areaCode;
        private $exchange;
        private $number;    
        
        public function __construct($areaCode, $exchange, $number) {
            if ($this->validate_code($areaCode) == 'fail') {
                throw new Exception("not a valid area code", 1);    
            }
            
            if ($this->validate_code($exchange) == 'fail') {
                throw new Exception("not a valid phone exchange", 1);    
            }
            
            if ($this->validate_number($number) == 'fail') {
                throw new Exception("not a valid extension", 1);    
            }

            $this->areaCode = $areaCode;
            $this->exchange = $exchange;
            $this->number = $number;
        }
        
        public function get_street () { return $this->street; }
        public function get_city () { return $this->city; }
        public function get_state () { return $this->state; }
        public function get_zip () { return $this->zip; }
        public function get_card () { return $this->card; }

        public function set_area_code ($areaCode) { 
            if ($this->validate_code($areaCode) == 'fail') {
                throw new Exception("not a valid area code", 1);    
            }
            $this->areaCode = $areaCode;   
        }

        public function set_exchange ($exchange) { 
            if ($this->validate_code($exchange) == 'fail') {
                throw new Exception("not a valid phone exchange", 1);    
            }
            $this->exchange = $exchange;       
        }

        public function set_number ($number) { 
            if ($this->validate_number($number) == 'fail') {
                throw new Exception("not a valid extension", 1);    
            }
            $this->number = $number;
        }

        public function __toString () {
            return '(' . $this->areaCode . ') ' . $this->exchange . '-' . $this->number; 
        }

        private function validate_code($var) {
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
        
        private function validate_number($var) {
            $result = 'pass';

            if (is_string($var)) {
                if ((is_numeric($var) && (strlen($var) == 4)))
                    $result = 'pass';
            }
            else if (is_int($var)) {
                if (strlen((string)$var) == 4)
                    $result = 'pass';      
            }
            else { $result = 'fail';}

            return $result;
        }


    } // end class Phone
    $phone = new Phone('rice','340', '1234');
    echo $phone;
?>