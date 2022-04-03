<?php
    require_once('proteinBar.php');

    class OrderItem {
        private $id;
        private $proteinBar;
        private $quantity;
        private $cost;

        public function __construct() {
            $this->id = null;
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

        public function increase ($number) { 
            if (is_numeric($number) == false)  {
                throw new Exception("The quantity must be a number");
            }
            if ($number < 0) {
                throw new Exception ("The increase must be greater than zero");
            }           
            $this->quantity +=$number; 
            $this->cost = $this->calculate_cost();
        }

        public function decrease ($number) {
            if (is_numeric($number) == false)  {
                throw new Exception("The quantity must be a number");
            }
            elseif ($this->quantity <= 0) {
                throw new Exception("Cannot decrement the quantity below zero");
            }
            if ($this->quantity < $number) {
                $this->number = 0;
            }
            $this->quantity--;
            $this->cost = $this->calculate_cost();
        }


        public function get_id () { return $this->id; }
        public function get_bar () { return $this->proteinBar; }
        public function get_quantity () { return $this->quantity; }

        public function calculate_cost () { 
            return ($this->proteinBar->get_retailPrice() * $this->quantity); 
        }

        public function to_table () {

            $elem = '<table>'
                . '<thead>'
                    . '<tr>'
                        . '<th>ID</th>'
                        . '<th>Protein Bar</th>'
                        . '<th>Quantity</th>'
                        . '<th>Cost</th>'
                    . '</tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr>'
                        . '<td>' . $this->id . '</td>'
                        . '<td>' . $this->proteinBar . '</td>'
                        . '<td>' . $this->quantity . '</td>'
                        . '<td>' . $this->calculate_cost() . '</td>'                
                    . '</tr>'
                . '</tbody>'      
            . '</table>';
    
            return $elem;
        }

        public function __toString() {
            $text = $this->id . ' '  . '<br>' .PHP_EOL
                . ' ' . $this->proteinBar->__toString()  . '<br>' .PHP_EOL
                . ' ' . $this->quantity   . '<br>' .PHP_EOL
                . ' ' . $this->calculate_cost() . '<br>' .PHP_EOL;
            return $text;
        }

    } // end class OrderItem

    $oi = (new OrderItem())->bar($bar)->quantity(3);;
    #echo $orderItem;
    #echo '<p>' .$oi->to_table() .;

    class OrderItemBag {
        private $list = array();

        public function get_list () { return $this->list; }

        public function total_cost () {
            $total = 0.00;

            foreach ($this->list as $item) {
                $total += $item->calculate_cost();
            }
            return $total;
        }


        public function add ($item) {
           # if (get_class($item) != get_class(new OrderItem())) {
           #     throw new Exception("Not a valid class member for OrderItem collector");
           # }
            
            $result = $this->search($item);

            if ($result != null) 
                $result->increment();
            else 
                $this->list[] = $item;
        }

        public function remove ($item) {
            if (get_class($item) != get_class(new OrderItem())) {
                throw new Exception("Not a valid class member for OrderItem collector");
            }
            
            $result = $this->search($item);

            if ($result == null) 
                throw new Exception ("There are no items in that category to remove");
            else {
                if ($result->quantity > 1) 
                    $result->decrement();
                else
                    $this->delete($result);
            }    
        }

        public function delete ($item) {
            $index = 0;
            $location = 0;
            $length = sizeof($this->list);

            $target = $item->bar->get_name();
            $result = null;


            while ($result == null || $index < $length) {
                if ($this->list[$index]->bar->get_name() == $target) {
                    $result = $this->list[$index];
                    $location = $index;
                }
            }

            for ($index = $location; $index < $length; $index++) {
                $this->list[$index] = $this->list[$index + 1];
            }

        }


        public function search ($target) {
          #  if (get_class($target) != get_class((new ProteinBar ()))) {
          #      throw new Exception("object of type " . get_class($target) . " is not valid for oderItemBag search");
          #  }
            $result = null;
            $name = $target->get_bar()->get_name();

            foreach ($this->list as $item) {
                if ($item->get_bar()->get_name() == $name) {
                    $result = $item;
                    break;
                }
            }
            return $result;
        }


        public function __toString() {
            $string = "";

            foreach ($this->list as $item) { $string  .= $item . '<br>' . PHP_EOL; }
            return $string;
        } 

        public function to_table () {

            $elem = '<table class>'
                . '<thead>'
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

    } // end class OrderItems



    echo '<p>' . $items->to_table() . '</p>';

?>