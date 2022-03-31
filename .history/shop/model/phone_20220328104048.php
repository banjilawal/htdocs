<?php
    class Phone {
        private $areaCode;
        private $exchange;
        private $number;    

        public function area_code ($areaCode) { 
            if ($this->validate_code($areaCode) == 'fail') {
                throw new Exception("not a valid area code", 1);    
            }
            $this->areaCode = $areaCode; 
            return $this;  
        }

        public function exchange ($exchange) { 
            if ($this->validate_code($exchange) == 'fail') {
                throw new Exception("not a valid phone exchange", 1);    
            }
            $this->exchange = $exchange;   
            return $this;    
        }

        public function number ($number) { 
            if ($this->validate_number($number) == 'fail') {
                throw new Exception("not a valid extension", 1);    
            }
            $this->number = $number;
            return $this;
        }

        public function string_to_phone ($text) {
            $this-areaCode = substr($text, (strpos($text,('(') + 1)) )
        }

        public function get_area_code () { return $this->areaCode; }
        public function get_exchange () { return $this->exchange; }
        public function get_number () { return $this->number; }

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
/*    
$phone = new Phone();
$phone->area_code('340')->exchange(679)->number(8013);
echo $phone;
*/
?>