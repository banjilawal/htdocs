<?php
    require_once('proteinBar.php');
    require_once('customer.php');
    require_once('orderItem.php');

    DEFINE ('ORDER_ID_PATTERN', '/[A-Z]{5}-[0-9]{5}-[A-Z]{4}-[2-9]{3}/i');
    DEFINE ('ORDER_STATES', array('cancelled', 'returned', 'in transit', 'delivery verified', 'delivery not confirmed'));


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
            $this->status = null;   
            $this->amount = 0.00;
            $this->total = 0.00;   
            $this->customer = new Customer();
            $this->items = new OrderItemBag ();
            $this->submissionTime = new DateTime('0000-01-01');
            $this->estimatedDelivery = new DateTime('0000-01-01');
            $this->actualDelivery = new DateTime('0000-01-01');
        }

        public function id ($id) { 
            if (preg_match(ORDER_ID_PATTERN, $id) != 1) {
                throw new Exception("orderid format exception");
            }
            $this->id = $id; 
            return $this; 
        } // close id

        public function customer ($customer) { 
            if (get_class($customer) != get_class((new Customer()))) {
                throw new Exception("not a customer object");
            }
            $this->customerID = $customer; 
            return $this; 
        } // close customer

        public function submission_date ($date) { 
            IF (get_class($date) != get_class((new DateTime()))) {
                throw new Exception("not a valid DateTime");
            }
            $this->submissionDate = $date; 
            $this->estimatedDelivery = date_add($date, date_interval_create_from_date_string('5 days'));
            return $this; 
        } // close submission_date


        public function actual_delivery ($date) { 
            IF (get_class($date) != get_class((new DateTime()))) {
                throw new Exception("not a valid DateTime");
            }

            if ($date <tr $this->submissionTime) {
                throw new Exception("delivery cannot be earlier than order submission");
            }
            $this->actualDelivery = $date; 
            return $this; 
        } // close actual_delivery

        public function calculate_bill () { 
            $this->amount = $this->items->total_cost();
            $this->tax = $this->items->total_cost() * SALES_TAX_RATE;
            $this->total = $this->amount + $this->tax;
        } // close calculate_bill

        public function status ($status) {
            if (in_array($this->status, ORDER_STATES, $strict = true) == false) {
                throw new Exception($status . " is not a valid state acronym");
            }
            $this->status = $status;
            return $this;
        } // close status

        /*
        * Assigns an existing orderItemBag to the order
        */
        public function items ($orderItemBag) {
            if (get_class($orderItemBag) != get_class((new OrderItemBag()))) {
                throw new Exception("Invalid class assignment on Order items field");
            }
            $this->items = $orderItemBag;
            return $this;
        } // close items

        public function add($item) {
            if ($item == null) {
                throw new Exception("Cannot add null objects to the bag");
            }
            else if (get_class($item) != get_class((new OrderItem ()))) {
                $this->items->add($item);
            }
            else if (get_class($item) == get_class((new ProteinBar ()))) {
                $oi = (new OrderItem ())->bar($item)->quantity(1);
                $this->items->add($oi);
            }
            else {
                throw new Exception("You can only add protein bars or oirderItems to the order bag");
            }
        } // close add

        public function __toString() {
            $text = $this->id 
                . ' ' . $this->customerID 
                . ' ' . $this->status 
                . ' ' . $this->total  
                . ' ' . $this->tax
                . ' ' . $this->submissionTime
                . ' ' . $this->estimatedDeliveryDate 
                . ' ' . $this->actualDeliveryDate
                . ' ' . $this->items;

            return $text;
        } // close toString

        public function to_table () {
            $elem = '<table>'
                . '<thead>'
                . '<tr>'
                . '</tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr><td>' . $this->customer->to_table() . '</td></tr>'
                    . '<tr>' 
                        . '<td class="field-name-cell">Order ID</td>'
                        . '<td>' . $this->id . '</td'  
                    . '<tr>'
                . '</tbody>'
                . '</table>';
                
            return $elem;       

        } // close to_table

        public function get_id () { return $this->id; }
        public function get_customer () { return $this->customer; }
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