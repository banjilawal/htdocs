<?php
    require_once('product.php');
    require_once('cu')

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

    } // end class Order
?>