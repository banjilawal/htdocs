<?php
    require_once('proteinBar.php');

    class OrderItem {
        private $proteinBar;
        private $quantity;
        private $cost;

        public function __construct() {
            $this->proteinBar = new ProteinBar();
            $this->quantity = 0;
            $this->cost = 0.00;
        }
        
        public function proteinBar ($bar) {
            if (get_class($bar) != get_class(new ProteinBar)) {
                throw new Exception("this is not a valid ProteinBar object");
            }
            $this->proteinBar = $bar;
            return $this;
        }

        public function quantity ($number) {
            if (is_numeric($number) == false)  {
                throw new Exception("The quantity must be a number");
            }
            if ($number <= 0) {
                throw new Exception ("The quantity must be greater than zero");
            }
            $this->quantity = $number;
            $this->cost = $this->calculate_cost();
            return $this;
        }

        public function increase_quantity ($number) { 
            if (is_numeric($number) == false)  {
                throw new Exception("The quantity must be a number");
            }
            else if ($number < 0) {
                throw new Exception ("The increase must be greater than zero");
            }  
            else {
                $this->quantity +=$number; 
                $this->cost = $this->calculate_cost();
            }         
        }

        public function decrease_quantity ($number) {
            if (is_numeric($number) == false)  {
                throw new Exception("The quantity must be a number");
            }
            else if ($this->quantity <= 0) {
                throw new Exception("Cannot decrement the quantity below zero");
            }
            else if ($this->quantity < $number) {
                $this->quantity = 0;
            }
            else {
                $this->quantity -= $number;
            }

            $this->cost = $this->calculate_cost();
        }

        public function calculate_cost () { 
            return ($this->proteinBar->get_retailPrice() * $this->quantity); 
        }

        public function to_row () {
            $elem = . '<tr>'
                        . '<td>' . $this->proteinBar . '</td>'
                        . '<td>' . $this->quantity . '</td>'
                        . '<td>' . $this->cost . '</td>'                
                    . '</tr>'
                . '</tbody>'      
            . '</table>';
    
            return $elem;
        }

        public function to_table () {
            $elem = '<table>'
                . '<thead>'
                    . '<tr>'
                        . '<th>Protein Bar Details</th>'
                        . '<th>Quantity</th>'
                        . '<th>Cost</th>'
                    . '</tr>'  
                . '</thead>'
                . '<tbody>'
                    . '<tr>'
                        . '<td>' . $this->proteinBar . '</td>'
                        . '<td>' . $this->quantity . '</td>'
                        . '<td>' . $this->cost . '</td>'                
                    . '</tr>'
                . '</tbody>'      
            . '</table>';
    
            return $elem;
        }

        public function __toString() {
            $text = $this->proteinBar . '<br>' .PHP_EOL
                . 'quantity: ' . $this->quantity   . '<br>' .PHP_EOL
                . 'cost: ' . $this->cost. '<br>' .PHP_EOL;
            return $text;
        }

        public function get_proteinBar () { return $this->proteinBar; }
        public function get_quantity () { return $this->quantity; }

    } // end class OrderItem


    class OrderItemBag {
        private $list = array();

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
            $string = 'OrderItems<br>' . PHP_EOL;

            foreach ($this->list as $item) { $string  .= $item . '<br>' . PHP_EOL; }
            return $string;
        } 

        public function to_table () {
            $elem = '<table class>'
                . '<thead>'
                    . '<tr>'
                        . '<th>Protein Bar Details</th>'
                        . '<th>Quantity</th>'
                        . '<th>Cost</th>'
                    . '</tr>'  
                . '</thead>'
                . '<tbody>';

                    foreach ($this->list as $item) {
                        $elem .= '<tr onclick="send(this)">'
                             . '<td>' . $item->to_table() . '</td>'
                             . '</tr>';
                     }  
                     $elem .= '<tr>'
                                . '<td> Total Cost </td>'
                                . '<td>' . $this->total_cost() . '</td>'
                            . '</tr></tbody></table>';
    
            return $elem;
        }

        public function get_list () { return $this->list; }

    } // end class OrderItems

    $oi = (new OrderItem())->proteinBar($proteinBar)->quantity(3);
    #echo $orderItem;
    $oi->increase_quantity(5);
   # echo '<p>' . $orderItem->to_table() . '</p>';

    $oiBag = new OrderItemBag();
    $oiBag->add($oi);

    #echo $orderItemBag;

    foreach ($bag->get_list() as $b) {
        $n = rand(1, 12);
        $oi = (new OrderItem ())->proteinBar($b)->quantity($n);
        $oiBag->add($oi);
    }

   # echo $oiBag;
    #echo $oiBag->to_table();
    $oiBag->decrease($oi, 4);


    #echo $oiBag->to_table();

?>