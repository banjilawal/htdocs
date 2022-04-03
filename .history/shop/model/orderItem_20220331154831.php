<?php
    require_once('proteinBar.php');
    require_once('customer.php');

    class OrderItem {
        private $id;
        private $customer;
        private $item;
        private $quantity;
        private $cost;

        public function __construct() {
            $this->id = null;
            $this->customer = new Customer();
            $this->item = new ProteinBar();
            $this->quantity = 0;
            $this->cost = 0.00;
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