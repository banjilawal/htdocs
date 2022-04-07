<?php
    class CustomerOrderItem {
        private $item;
        private $status;
        private $arrivalDate;
        private $orderID;

        public function __construct() {
            $status = null;
            $orderId = null;
            $item = new OrderItem ();
            $arrivalDate = new DateTime ();
        }

        public function orderID ($id) { 
            if (preg_match(ORDER_ID_PATTERN, $id) != 1) {
                throw new Exception("orderid format exception");
            }
            $this->orderID = $id; 
            return $this; 
        } // close id

        public function item ($orderItem) {
            if (is_null($orderItem) == true) {
                throw new Exception("Cannot add null objects to the bag");
            }
            if (get_class($orderItem) != 'OrderItem') {
                throw new Exception("invalid object for add_orderItem method");
            }
            $this->item = $orderItem;
            return $this;
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
                        . '<td>' . $this->orderID . '</td>'      
                        . '<td><img src="' . $this->item->get_proteinBar()->get_imagePath() . '" width="300" height="400"></td>'
                        . '<td>' . $this->item->get_proteinBar()->get_name() . '</td>'  
                        . '<td>' . $this->item->get_proteinBar()->get_description() . '</td>'      
                        . '<td>' . $this->item->get_proteinBar()->get_grams() . '</td>'
                        . '<td>' . $this->item->get_proteinBar()->get_retailPrice() . '</td>'   
                        . '<td>' . $this->item->get_quantity() . '</td>'
                        . '<td>' . $this->item->get_cost() . '</td>'       
                        . '<td>' . $this->status . '</td>'
                        . '<td>' . $this->arrivalDate->format('Y-m-d hh:mm:s') . '</td>'
                    . '</tr>';            
            return $elem;       

        } // close to_row   

        public function to_table () {
            $elem = '<table>'
                . '<thead>'
                    . '<tr>'
                        . '<th>Order ID</th>'
                        . '<th>Picture</th>'
                        . '<th>Name</th>'
                        . '<th>Description</th>'
                        . '<th>Grams</th>'
                        . '<th>Retail Price</th>'
                        . '<th>Quantity</th>'
                        . '<th>Cost</th>'
                        . '<th>Status</th>'
                        . '<th>Arrival Date</th>'  
                    . '</tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr>' 
                        . '<td>' . $this->orderID . '</td>'     
                        . '<td><img src="' . $this->item->get_proteinBar()->get_imagePath() . '" width="300" height="400"></td>'
                        . '<td>' . $this->item->get_proteinBar()->get_name() . '</td>'  
                        . '<td>' . $this->item->get_proteinBar()->get_description() . '</td>'      
                        . '<td>' . $this->item->get_proteinBar()->get_grams() . '</td>'
                        . '<td>' . $this->item->get_proteinBar()->get_retailPrice() . '</td>'   
                        . '<td>' . $this->item->get_quantity() . '</td>'
                        . '<td>' . $this->item->get_cost() . '</td>'       
                        . '<td>' . $this->status . '</td>'
                        . '<td>' . $this->arrivalDate->format('Y-m-d hh:mm:s') . '</td>'
                        . '<td>
                            <p><button type="button" id="return-item-button" onclick="start-return-process()">I Want to Return</button></p></td>' . 
                    . '</tr>'
                . '</tbody>'
                . '</table>'; 
            return $elem;       
        } // close to_table

        public function get_proteinBar () { return $this->item->get_proteinBar(); }
        public function get_quantity () { return $this->item->get_quantity(); }
        public function get_cost () { return $this->item->get_cost(); }
        public function get_item () { return $this->item; }
        public function get_order_id () { return $this->orderID; }
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
            $index = 0;
            $elem = '<table class>'
                . '<thead>'
                    . '<tr><th>' . $this->customerID . '</th><tr>'
                    . '<tr>'
                        . '<th>row</th>'
                        . '<th>Order ID</th>'
                        . '<th>Picture</th>'
                        . '<th>Name</th>'
                        . '<th>Description</th>'
                        . '<th>Grams</th>'
                        . '<th>Retail Price</th>'
                        . '<th>Quantity</th>'
                        . '<th>Cost</th>'
                        . '<th>Status</th>'
                        . '<th>Arrival Date</th>'  
                    . '</tr>'  
                . '</thead>'
                . '<tbody>';
                    for ($index = 1; $index < sizeof($this->list); $index++) {   
                       $elem .=  '<tr onclick="send_customer_order_item(this)">'
                            . '<td>' . $index .'</td>'
                            . '<td>' . $this->list[$index]->get_order_id() . '</td>'     
                            . '<td><img src="' . $this->list[$index]->get_proteinBar()->get_imagePath() . '" width="200" height="100"></td>'
                            . '<td>' . $this->list[$index]->get_proteinBar()->get_name() . '</td>'  
                            . '<td>' . $this->list[$index]->get_proteinBar()->get_description() . '</td>'      
                            . '<td>' . $this->list[$index]->get_proteinBar()->get_grams() . '</td>'
                            . '<td>' . $this->list[$index]->get_proteinBar()->get_retailPrice() . '</td>'   
                            . '<td>' . $this->list[$index]->get_quantity() . '</td>'
                            . '<td>' . $this->list[$index]->get_cost() . '</td>'       
                            . '<td>' . $this->list[$index]->get_status() . '</td>'
                            . '<td>' . $this->list[$index]->get_arrival_date()->format('Y-m-d hh:mm:s') . '</td>'
                        . '</tr>';    
                    }  
            $elem .= '</tbody></table>';
    
            return $elem;
        }


        public function get_list () { return $this->list; }
        public function get_customerID () { return $this->customerID; }
        public function get_item ($index) { return $this->list[$index]; }

    } // end class OrderItems
?>