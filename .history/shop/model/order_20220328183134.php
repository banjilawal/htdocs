<?php
    require_once('product.php');
    require_once('customer.php');

    class Order {
        private $id;
        private $customerID;
        private $submissionDate;
        private $estimatedDeliveryDate;
        private $actualDeliveryDate;
        private $amount;
        private $tax;
        private $total;
        private $status;

        public function id ($id) { 
            $this->id = $id; 
            return $this; 
        }

        public function customerID ($customerID) { 
            $this->customerID = $customerID; 
            return $this; 
        }

        public function submission_date ($submissionDate) { 
            $this->submissionDate = $submissionDate; 
            return $this; 
        }

        public function estimated_delivery () { 
            $this->estimatedDeliveryDate = $submissionDate; 
            return $this; 
        }
        
        public function actualDeliveryDate{ $this-> ; return $this; }
        public function amount{ $this-> ; return $this; }
        public function tax{ $this-> ; return $this; }
        public function total{ $this-> ; return $this; }
        public function status{ $this-> ; return $this; }

    } // end class Order
?>