<?php
    require_once('../bootstrap.php');
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
        private $items;

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
            if (get_class($customer) != 'Customer') {
                throw new Exception("not a customer object");
            }
            $this->customer = $customer; 
            return $this; 
        } // close customer

        public function submission_date ($date) { 
            IF (get_class($date) != get_class((new DateTime()))) {
                throw new Exception("not a valid DateTime");
            }
            $this->submissionTime = $date; 
            $this->estimatedDelivery = date_add($date, date_interval_create_from_date_string('5 days'));
            return $this;
        } // close submission_date


        public function actual_delivery ($date) { 
            IF (get_class($date) != get_class((new DateTime()))) {
                throw new Exception("not a valid DateTime");
            }

            if ($date < $this->submissionTime) {
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
            if (get_class($orderItemBag) != 'OrderItemBag') {
                throw new Exception("Invalid class assignment on Order items field");
            }
            $this->items = $orderItemBag;
            $this->calculate_bill();
            return $this;
        } // close items

        public function add_orderItem ($item) {
            if ($item == null) {
                throw new Exception("Cannot add null objects to the bag");
            }
            if (get_class($item) != 'OrderItem') {
                throw new Exception("invalid object for add_orderItem method");
            }
            $this->items->add($item);
        } // close add

        public function add_proteinBar($item, $quantity) {
            if ($item == null) {
                throw new Exception("Cannot add null objects to the order");
            }
            if ($quantity <= 0) {
                throw new Exception ("The quantity must be greater than zero");
            }
            if (get_class($item) != 'ProteinBar') {
                throw new Exception("invalid object for add_orderProteinBar method");
            }

            $oi = (new OrderItem ())->proteinBar($item)->quantity($quantity);
            echo get_class($oi);
            $this->items->add_orderItem($oi);

        } // close add

        public function __toString() {
            $text = 'order ID: ' . $this->id . '<br>'
                . ' ' . $this->customer  . '<br>'
                . ' status: ' . $this->status . '<br>'
                . ' ' . $this->total  . '<br>'
                . ' ' . $this->tax . '<br>'
                . ' submitted: ' . $this->submissionTime->format('Y-m-d hh:mm:s') . '<br>'
                . ' estimated delivery: ' . $this->estimatedDelivery->format('Y-m-d hh:mm:s') . '<br>'
                . ' ' . $this->actualDelivery->format('Y-m-d hh:mm:s') . '<p></p>' . '<br>'
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
                        . '<td class="data-cell">' . $this->id . '</td>'
                        . '<td class="field-name-cell">Order Status</td>'
                        . '<td class="data-cell">' . $this->status . '</td>'
                        . '<td class="field-name-cell">Order Submitted</td>'  
                        . '<td class="data-cell">' . $this->submissionTime->format('Y-m-d hh:mm:s') . '</td>'
                        . '<td class="field-name-cell">Estimated Delivery/td>'  
                        . '<td class="data-cell">' . $this->estimatedDelivery->format('Y-m-d hh:mm:s') . '</td>'
                        . '<td class="field-name-cell">Actual Delivery</td>'  
                        . '<td class="data-cell">' . $this->actualDelivery->format('Y-m-d hh:mm:s') . '</td>'
                    . '</tr>'
                    . '<tr> Order Items </tr>'
                    . '<tr>'
                        . '<td>' . $this->items->to_table() . '</td>'
                    . '</tr>'
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
/*
    $order = (new Order())->id('IWTRB-78108-CHXG-757');
    $order->customer($customer)->submission_date((new DateTime('2022-04-01')));
    $order->items($oiBag);
    echo '<p>' . $order . '</p>';
    echo '<p>' . $order->to_table() . '</p>';
*/

class OrderBag {
    private $list = array();

    public function add ($item) {
        if (get_class($item) != 'Order) {
            throw new Exception("Invalid class parameter for OrderItemBag->add()");
        }
        $this->increase($orderItem, 0);
    }

    public function add_proteinBar ($proteinBar, $quantity) {
        if (get_class($proteinBar) != 'ProteinBar') {
            throw new Exception("not ProteinBar exception thrown");
        }

        if ($quantity <= 0 ) {
            throw new Exception("protein bar quantity must be above zero");
        }
        $orderItem = (new OrderItem ())->proteinBar($proteinBar)->quantity($quantity);
        $this->add($orderItem);
    }

    public function increase ($orderItem, $amount) {
        if (get_class($orderItem) != 'OrderItem') {
            throw new Exception("Invalid class parameter for OrderItemBag->add()");
        }

        if (is_numeric($amount) == false)  {
            throw new Exception("The amount must be a number");
        }
        if ($amount < 0) {
            throw new Exception ("The amount cannot be less than zero");
        } 
        
        $proteinBarID = $orderItem->get_proteinBar()->get_id();

        if (array_key_exists($proteinBarID, $this->list) == true) {
            $quantity = $orderItem->get_quantity();
            $this->list[$proteinBarID]->increase_quantity($quantity);
        }  
        else {
            $orderItem->increase_quantity($amount);
            $this->list[$proteinBarID] = $orderItem;   
        }        

    }

    public function decrease ($orderItem, $amount) {
        if (get_class($orderItem) != 'OrderItem') {
            throw new Exception("Invalid class parameter for OrderItemBag->add()");
        }
        if (is_numeric($amount) == false)  {
            throw new Exception("The amount must be a number");
        }
        if ($amount < 0) {
            throw new Exception ("cannot remove less than one item");
        }   
        $proteinBarID = $orderItem->get_proteinBar()->get_id();

        if (array_key_exists($proteinBarID, $this->list) == false) {
            throw new Exception("The nonexistent item cannot be removed from the order where it is not listed");
        }  
        $this->list[$proteinBarID]->decrease_quantity($amount);     
    }

    public function total_cost () {
        $total = 0.00;

        foreach ($this->list as $item) {
            $total += $item->calculate_cost();
        }
        return $total;
    }

    public function __toString() {
        $string = 'OrderItems<br>' . PHP_EOL;

        foreach ($this->list as $item) { $string  .= $item . '<br>' . PHP_EOL; }
        return $string;
    } 

    public function to_table () {
        $elem = '<table class>'
            . '<thead>'
                . '<tr>'
                    . '<th>Picture</th>'
                    . '<th>Name</th>'
                    . '<th>Description</th>'
                    . '<th>Grams</th>'
                    . '<th>Retail Price</th>'
                    . '<th>Quantity</th>'
                    . '<th>Cost</th>'
                . '</tr>'  
            . '</thead>'
            . '<tbody>';
                foreach ($this->list as $item) { $elem .= $item->to_row(); }  
                 $elem .= '<tr>'
                            . '<td> Total Cost </td>'
                            . '<td>' . $this->total_cost() . '</td>'
                        . '</tr></tbody></table>';

        return $elem;
    }

    public function get_list () { return $this->list; }

} // end class OrderItems
?>