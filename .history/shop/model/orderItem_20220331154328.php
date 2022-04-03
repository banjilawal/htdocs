<?php
    require_once('proteinBar.php');
    require_once('customer.php');

    class OrderItem {
        private $id;
        private $customer;
        private $proteinBar;
        private $quantity;
        private $cost;

        public function __construct() {
            $this->id = null;
            $this->customer = new Customer();
            $this->proteinBar = new ProteinBar();
            $this->quantity = 0;
            $this->cost = 0.00;
        }


        public function get_id () { return $this->id; }
        public function get_customer_id () { return $this->customerID; }
        public function get_submission_date () { return $this->submissionDate; }
        public function get_estimated_delivery () { return $this->estimatedDeliveryDate; }
        public function get_actual_delivery () { return $this->actualDeliveryDate; }
        public function get_amount () { return $this->amount; }
        public function get_tax () { return $this->tax; }
        public function get_total () { return $this->total; }
        public function get_status () { return $this->status; }

        public function id ($id) { 
            $this->id = $id; 
            return $this; 
        }
 

        public function __toString() {
            $text = $this->id . ' ' . $this->customerID . ' ' . $this->status . ' ' . $this->total  . ' ' . $this->tax
                .= ' ' . $this->estimatedDeliveryDate . ' ' . $this->actualDeliveryDate;
            return $text;
        }

    } // end class OrderItem
?>