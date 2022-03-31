<?php
    class Phone {
        private $areaCode;
        private $exchange;
        private $number;    

        public function set_area_code ($areaCode) { 
            if ($this->validate_code($areaCode) == 'fail') {
                throw new Exception("not a valid area code", 1);    
            }
            $this->areaCode = $areaCode; 
            return $this;  
        }

        public function set_exchange ($exchange) { 
            if ($this->validate_code($exchange) == 'fail') {
                throw new Exception("not a valid phone exchange", 1);    
            }
            $this->exchange = $exchange;   
            return $this;    
        }

        public function set_number ($number) { 
            if ($this->validate_number($number) == 'fail') {
                throw new Exception("not a valid extension", 1);    
            }
            $this->number = $number;
            return $this;
        }

        public function get_area_code () { return $this->areaCode; }
        public function get_exchange_code () { return $this->areaCode; }
        public function get_area_code () { return $this->areaCode; }

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
            $result = 'fail';

            if (is_string($var)) {
                if ((is_numeric($var) && (strlen($var) == 4)))
                    $result = 'pass';
            }
            
            if (is_int($var)) {
                if (strlen((string)$var) == 4)
                    $result = 'pass';      
            }

            return $result;
        }


    } // end class Phone
$phone = new Phone('340', 679, 8013);
#echo $phone;
?>