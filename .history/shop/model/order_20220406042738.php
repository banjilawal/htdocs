<?php
    require_once('../bootstrap.php');
    require_once('proteinBar.php');
    require_once('customer.php');
    require_once('orderItem.php');

    DEFINE ('ORDER_ID_PATTERN', '/[A-Z]{5}-[0-9]{5}-[A-Z]{4}-[2-9]{3}/i');
    DEFINE ('ORDER_STATES', array('cancelled', 'returned', 'in transit', 'delivery verified', 'delivery not confirmed'));


    class Order {
        private $id;
        private $card;
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
            $this->card = new CreditCard ();
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

        public function card ($card) { 
            if (get_class($card) != 'CreditCard') {
                throw new Exception("not a creditCard");
            }

            if ($this->customer->get_cards()->exists($card) == false) {
                throw new Exception("not the customer's card");
            }

            $this->card = $card; 
            return $this; 
        } // close customer

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
           # if (in_array($this->status, ORDER_STATES, $strict = true) == false) {
          #      throw new Exception($status . " is not a valid state acronym");
        #    }
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


        public function add ($item) {
            if (is_null($item) == true) {
                throw new Exception("Cannot add null objects to the bag");
            }     
            if (get_class($item) == 'OrderItem') {
                $this->add_orderItem($item);
            }
            else if (get_class($item) == 'ProteinBar') {
                $this->add_proteinBar($item, 1);
            }
            else {
                new Exception ("This object is not valid for an Order object's item container");
            }

        }

        public function add_orderItem ($orderItem) {
            if (is_null($orderItem) == true) {
                throw new Exception("Cannot add null objects to the bag");
            }
            if (get_class($orderItem) != 'OrderItem') {
                throw new Exception("invalid object for add_orderItem method");
            }
            $this->items->add($orderItem);
        } // close add

        public function add_proteinBar($proteinBar, $quantity) {
            if (is_null($proteinBar) == true) {
                throw new Exception("Cannot add null objects to the order");
            }
            if ($quantity <= 0) {
                throw new Exception ("The quantity must be greater than zero");
            }
            if (get_class($proteinBar) != 'ProteinBar') {
                throw new Exception("invalid object for add_orderProteinBar method");
            }

            $oi = (new OrderItem ())->proteinBar($proteinBar)->quantity($quantity);
            $this->items->add_orderItem($oi);

        } // close add

        public function __toString() {
            $text = 'order ID: ' . $this->id . '<br>'
                . ' status: ' . $this->status 
                . ' card: ' . $this->card->pr 
                . ' amount: ' . $this->amount
                . ' tax: ' . $this->tax
                . ' post tax: ' . $this->total  . '<br>'
                . 'submitted: ' . $this->submissionTime->format('Y-m-d hh:mm:s')
                . ' estimated delivery: ' . $this->estimatedDelivery->format('Y-m-d hh:mm:s')
                . ' actual delivery: ' . $this->actualDelivery->format('Y-m-d hh:mm:s') . '<p></p>' . '<br>'
                . 'customer ' . $this->customer . '<br>'
                . 'Order Items:<br>' . $this->items;

            return $text;
        } // close toString

        public function to_row () {
            $elem = '<tr id="' . $this->id . '" name="' . $this->id . '" onclick="send_order(this)">'
                        . '<td>' . $this->id . '</td>'
                        . '<td>' . $this->status . '</td>'
                        . '<td>' . $this->customer->get_id() . '</td>'  
                        . '<td>' . $this->card->print_number() . '</td>'
                        . '<td>' . $this->items->total_cost() . '</>'
                        . '<td>' . $this->tax . '</td>'
                        . '<td>' . $this->total . '</td>'
                        . '<td>' . $this->submissionTime->format('Y-m-d hh:mm:s') . '</td>'
                        . '<td>' . $this->estimatedDelivery->format('Y-m-d hh:mm:s') . '</td>'
                        . '<td>' . $this->actualDelivery->format('Y-m-d hh:mm:s') . '</td>'
                    . '</tr>';            
            return $elem;       

        } // close to_table        

        public function to_table () {
            $elem = '<table>'
                . '<thead>'
                    . '<tr>'
                        . '<td>OrderID</td>'
                        . '<th>Status</th>'
                        . '<th>CustomerID</th>'
                        . '<th>Pretax Amount</th>'
                        . '<th>Tax</th>'
                        . '<th>Total</th>'
                        . '<th>Submit Time</th>' 
                        . '<thEstimated Delivery/td>'  
                        . '<th>Actual Delivery</th>'  
                    . '</tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr>' 
                        . '<td>' . $this->id . '</td>'
                        . '<td>' . $this->status . '</td>'
                        . '<td>' . $this->customer->get_id() . '</td>'  
                        . '<td>' . $this->items->total_cost() . '</td>'
                        . '<td>' . $this->tax . '</td>'
                        . '<td>' . $this->total . '</td>'
                         . '<td>' . $this->submissionTime->format('Y-m-d hh:mm:s') . '</td>'
                        . '<td>' . $this->actualDelivery->format('Y-m-d hh:mm:s') . '</td>'
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

    public function add ($order) {
        if (get_class($order) != 'Order') {
            throw new Exception("Invalid class parameter for OrderBag->add()");
        }
        $orderID = $order->get_id();

        if (array_key_exists($orderID, $this->list) == true) {
            throw new Exception("the order is already listed");
        }  
        $this->list[$orderID] = $order;     
    }

    public function __toString() {
        $string = 'Orders<br>' . PHP_EOL;

        foreach ($this->list as $item) { 
            $string  .=  'orderID:' . $item->get_id() . ' customerID:' . $item->get_customer()->get_id() 
                . ' status:' . $item->get_status()
                . ' total:' . $item->get_total()
                . ' tax:' . $item->get_tax()
                . ' submitted:' . $item->get_submission_time()->format('Y-m-d hh:mm:s')
                . ' delivered:' . $item-> get_actual_delivery()->format('Y-m-d hh:mm:s') . '<br>' .PHP_EOL;
        }
        return $string;
    } 

    public function search ($orderID) {

       if (array_key_exists($orderID, $this->list) == true) {
           return $this->list[$orderID];
       }  
       else {
           return null;
       }       
    }

    public function add_orderItem ($orderID, $orderItem) {
        if (get_class($orderItem) != 'orderItem') {
            throw new Exception("not orderItem exception thrown");
        }
        if (array_key_exists($orderID, $this->list) == false) {
            throw new Exception("the order does not exist.  Adding orderItem to orderBag failed");
        }  
        $this->list[$orderID]->add_orderItem($orderItem);
    }

    public function add_proteinBar ($orderID, $quantity, $proteinBar) {
        if (get_class($proteinBar) != 'ProteinBar') {
            throw new Exception("not ProteninBar exception thrown");
        }
        if (array_key_exists($orderID, $this->list) == false) {
            throw new Exception("the order does not exist.  Adding orderItem to orderBag failed");
        }  

        $orderItem = (new orderItem ())->proteinBar($proteinBar)->quantity($quantity);
        $this->add_orderItem($orderID, $orderItem);
    }

    public function to_table () {
        $elem = '<table class>'
            . '<thead>'
                . '<tr>'
                    . '<td>OrderID</td>'
                    . '<th>Status</th>'
                    . '<th>CustomerID</th>'
                    . '<th>Pretax Amount</th>'
                    . '<th>Tax</th>'
                    . '<th>Total</th>'
                    . '<th>Submit Time</th>' 
                    . '<thEstimated Delivery/td>'  
                . '<th>Actual Delivery</th>'  
                . '</tr>'  
            . '</thead>'
            . '<tbody>';
                foreach ($this->list as $id => $order) { $elem .= $this->list[$id]->to_row(); }  
            $elem .= '</tbody></table>';

        return $elem;
    }

    public function get_list () { return $this->list; }

} // end class OrderItems
?>