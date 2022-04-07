<?php
    class CustomerOrderItem {
        private $item;
        private $status;
        private $arrivalDate;

        public function __construct() {

            $status = null;
            $arrivalDate = new DateTime ();
        }
    }
?>