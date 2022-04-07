<?php
    class CustomerOrderItem {
        private $item;
        private $status;
        private $arrivalDate;

        public function __construct() {
            $status = null;
            $item = new OrderItem ();
            $arrivalDate = new DateTime ();
        }

        public function item ($orderItem) {
            if (is_null($orderItem) == true) {
                throw new Exception("Cannot add null objects to the bag");
            }
            if (get_class($orderItem) != 'OrderItem') {
                throw new Exception("invalid object for add_orderItem method");
            }
            $this->item = $orderItem;
            return;
        } // close add

        public function arrival_date ($date) { 
            if (get_class($date) != 'DateTime') {
                throw new Exception("not a valid DateTime");
            }
            $this->submissionTime = $date; 
            $this->estimatedDelivery = date_add($date, date_interval_create_from_date_string('5 days'));
            return $this;
        } // close submission_date
    }
?>