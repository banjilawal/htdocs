<?php
    require_once('proteinBar.php');

    class OrderItem {
        private $id;
        private $item;
        private $quantity;
        private $cost;

        public function __construct() {
            $this->id = null;
            $this->item = new ProteinBar();
            $this->quantity = 0;
            $this->cost = 0.00;
        }

        public function add ($item) {
            if (get_class($item) != 'ProteinBar') {
                throw new Exception("this is not a valid ProteinBar object");
            }
            $this->item = $item;
            return $this;
        }

        public function quantity ($number) {
            if ($number <= 0) {
                throw new Exception ("The quantity must be greater than zero");
            }
            $this->quantity = $number;
            $this->cost = $this->quantity * $this->item->get_retailPrice();
;           return $this;
        }

        public function get_id () { return $this->id; }
        public function get_item () { return $this->$item; }
        public function get_quantity () { return $this->quantity; }

        public function get_cost () { 
            return ($this->item->get_retailPrice() * $this->quantity); 
        }

        public function __toString() {
            $text = $this->id . ' ' 
                . ' ' . $this->item->__toString()
                . ' ' . $this->quantity  
                . ' ' . $this->cost;
            return $text;
        }

    } // end class OrderItem

    $orderItem = (new OrderItem())->add($bar)->quantity(3);;
    #echo $orderItem;
?>