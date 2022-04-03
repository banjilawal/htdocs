<?php
    require_once('proteinBar.php');
    require_once('customer.php');
    require_once('orderItem.php');

    class Order {
        private $id;
        private $customer;
        private $submissionTime;
        private $estimatedDelivery;
        private $actualDelivery;
        private $amount;
        private $tax;
        private $total;
        private $status;
        private $items = array();

        public function __construct() {
            $this->id = null;
            $this->customer = new Customer();
            $this->items = new OrderItemBag ();
            $this->submissionTime = new DateTime('0000-01-01');
            $this->estimatedDelivery = new DateTime('0000-01-01');
            $this->actualDelivery = new DateTime('0000-01-01');
            $this->amount = 0.00;
            $this->total = 0.00;
            $this->status = null;            
        }



        public function id ($id) { 
            $this->id = $id; 
            return $this; 
        }

        public function customer ($customer) { 
            $this->customerID = $customer; 
            return $this; 
        }

        public function submission_date ($date) { 
            $this->submissionDate = $date; 
            $this->estimatedDelivery = date_add($date, date_interval_create_from_date_string('5 days'));
            return $this; 
        }


        public function actual_delivery ($actualDeliveryDate) { 
            $this->actualDeliveryDate = $actualDeliveryDate; 
            return $this; 
        }

        public function calc ($amount) { 
            return $this->items->total_cost();
        }


        public function tax ($tax) { 
            $this->tax = $tax; 
            return $this; 
        }

        public function total ($total) { 
            $this->total = $total;
            return $this; 
        }

        public function status ($status) { 
            $this->status = $status; 
            return $this; 
        }

        public function items ($items) {
            $this->items = array();
            $this->item = $items;
            return $this;
        }

        public function __toString() {
            $text = $this->id . ' ' . $this->customerID . ' ' . $this->status . ' ' . $this->total  . ' ' . $this->tax
                .= ' ' . $this->estimatedDeliveryDate . ' ' . $this->actualDeliveryDate;
            return $text;
        }

        public function get_id () { return $this->id; }
        public function get_customer_id () { return $this->customerID; }
        public function get_submission_time () { return $this->submissionTime; }
        public function get_estimated_delivery () { return $this->estimatedDelivery; }
        public function get_actual_delivery () { return $this->actualDelivery; }
        public function get_amount () { return $this->amount; }
        public function get_tax () { return $this->tax; }
        public function get_total () { return $this->total; }
        public function get_status () { return $this->status; }
        public function get_items () { return $this->items; }

    } // end class Order
?>