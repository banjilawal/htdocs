<?php
    class CustomerOrderItem {
        private $item;
        private $status;
        private $arrivalDate;

        public function __construct() {
            $item = new OrderItem ();
            $status = null;
            $arrivalDate = new DateTime()
        }
    }
?>