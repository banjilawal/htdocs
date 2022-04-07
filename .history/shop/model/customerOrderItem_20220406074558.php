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

        public function arrivalDate ($date) { 
            if (get_class($date) != 'DateTime') {
                throw new Exception("not a valid DateTime");
            }
            $this->arrivalDate = $date; 
            return $this;
        } // close submission_date

        public function status ($status) {
            # if (in_array($this->status, ORDER_STATES, $strict = true) == false) {
           #      throw new Exception($status . " is not a valid state acronym");
         #    }
             $this->status = $status;
             return $this;
         } // close status

         public function __toString() {
             return $this->item . ' ' . $this->status . ' ' . $this->arrivalDate->format('Y-m-d hh:mm:s');
         }

         public function to_row () {
            $elem = '<tr onclick="send_customer_order_item(this)">'
                        . '<td>' . $this->item . '</td>'
                        . '<td>' . $this->status . '</td>'
                        . '<td>' . $this->arrivalDate->format('Y-m-d hh:mm:s') . '</td>'
                    . '</tr>';            
            return $elem;       

        } // close to_row   

        public function to_table () {
            $elem = '<table>'
                . '<thead>'
                    . '<tr>'
                        . '<td>I</td>'
                        . '<th>Status</th>'
                        . '<th>CustomerID</th>'
                        . '<th>Credit Card</th>'
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
                        . '<td>' . $this->card->print_number() . '</td>'
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
    }
?>