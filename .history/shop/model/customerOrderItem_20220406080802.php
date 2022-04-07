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
                        . '<td>Item Description</td>'
                        . '<th>Status</th>'
                        . '<th>Arrival Date</th>'  
                    . '</tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr>' 
                        . '<td>' . $this->item . '</td>'
                        . '<td>' . $this->status . '</td>'
                        . '<td>' . $this->arrivalDate->format('Y-m-d hh:mm:s') . '</td>'
                    . '</tr>'
                . '</tbody>'
                . '</table>'; 
            return $elem;       
        } // close to_table

        public function get_item () { return $this->item; }
        public function get_status () { return $this->status; }
        public function get_arrival_date () { return $this->arrivalDate; }
    }

    class CustomerOrderItemBag {
        private $list = array();
        private $customerID;

        public function customerID ($id) { 
            if (preg_match(CUSTOMER_ID_PATTERN, $id) != 1) {
                throw new Exception("customerid format exception");
            }
            $this->customerID = $id; 
            return $this; 
        } // close id

        public function add ($item) {
            if (get_class($item) != 'CustomerOrderItem') {
                throw new Exception("Invalid class parameter for OrderItemBag->add()");
            }
            $this->list[] = $item;     
        }

        public function to_table () {
            $elem = '<table class>'
                . '<thead>'
                    . '<tr><td>' . $this->customerID . '</td><tr>'
                    . '<tr>'
                        . '<td>Item Description</td>'
                        . '<th>Status</th>'
                        . '<th>Arrival Date</th>'  
                    . '</tr>'  
                . '</thead>'
                . '<tbody>';
                    foreach ($this->list as $item) { $elem .= $item->to_row(); }  
            $elem .= '</tbody></table>';
    
            return $elem;
        }

        public function get_list () { return $this->list; }

    } // end class OrderItems
?>