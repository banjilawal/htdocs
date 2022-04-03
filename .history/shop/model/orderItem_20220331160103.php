<?php
    require_once('proteinBar.php');

    class OrderItem {
        private $id;
        private $proteinBar;
        private $quantity;
        private $cost;

        public function __construct() {
            $this->id = null;
            $this->proteinBar= new ProteinBar();
            $this->quantity = 0;
            $this->cost = 0.00;
        }

        public function add ($bar) {
            if (get_class($bar) != get_class((new ProteinBar())) {
                throw new Exception("this is not a valid ProteinBar object");
            }
            $this->proteinBar = $bar;
        }

        public function quantity ($number) {
            if ($number <= 0) {
                throw new Exception ("The quantity must be greater than zero");
            }
            $this->quantity = $number;
            $this->cost = 
            return $this;
        }






        public function get_id () { return $this->id; }
        public function get_customer () { return $this->customer; }
        public function get_item () { return $this->$item; }
        public function get_qauntity () { return $this->quantity; }

        public function get_cost () { 
            return ($this->item->get_retailPrice() * $this->quantity); 
        }

 

        public function __toString() {
            $text = $this->id . ' ' 
                . $this->customerID 
                . ' ' . $this->protenBar 
                . ' ' . $this->quantity  
                . ' ' . $this->cost;
            return $text;
        }

    } // end class OrderItem
?>