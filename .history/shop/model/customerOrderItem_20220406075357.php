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

    class CustoOrderItemBag {
        private $list = array();
        private $orderID;

        public function orderID ($id) { 
            if (preg_match(ORDER_ID_PATTERN, $id) != 1) {
                throw new Exception("orderid format exception");
            }
            $this->orderID = $id; 
            return $this; 
        } // close id
        

        public function add ($orderItem) {
            if (get_class($orderItem) != 'OrderItem') {
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
            $string = 'Order ' . $this->orderID . ' Items<br>' . PHP_EOL;

            foreach ($this->list as $item) { $string  .= $item . '<br>' . PHP_EOL; }
            return $string;
        } 

        public function to_table () {
            $elem = '<table class>'
                . '<thead>'
                    . '<tr><td>' . $this->orderID . '</td><tr>'
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