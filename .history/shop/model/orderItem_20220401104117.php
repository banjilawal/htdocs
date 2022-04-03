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
        
        
        public function bar ($bar) {
            if (get_class($bar) != get_class(new ProteinBar)) {
                throw new Exception("this is not a valid ProteinBar object");
            }
            $this->proteinBar = $bar;
            return $this;
        }

        public function quantity ($number) {
            if ($number <= 0) {
                throw new Exception ("The quantity must be greater than zero");
            }
            $this->quantity = $number;
            $this->cost = $this->calculate_cost();
            return $this;
        }

        public function increment () { 
            $this->quantity++; 
            $this->cost = $this->calculate_cost();
        }

        public function decrement () {
            if ($this->quantity <= 0) {
                throw new Exception("Cannot decrement the quantity below zero");
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
                        . '<th hidden>ID</th>'
                        . '<th>Protein Bar</th>'
                        . '<th>Quantity</th>'
                        . '<th>Cost</th>'
                    . '</tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr>'
                        . '<td hidden>' . $this->id . '</td>'
                        . '<td>' . $this->proteinBar . '</td>'
                        . '<td>' . $this->quantity . '</td>'
                        . '<td>' . $this->cost . '</td>'                
                    . '</tr>'
                . '</tbody>'      
            . '</table>';
    
            return $elem;
        }

        public function __toString() {
            $text = $this->id . ' ' 
                . ' ' . $this->proteinBar->__toString()
                . ' ' . $this->quantity  
                . ' ' . $this->cost;
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
                $total += $item->get_cost();
            }
            return $total;
        }


        public function add ($item) {
            if (get_class($item) != get_class(new OrderItem())) {
                throw new Exception("Not a valid class member for OrderItem collector");
            }
            
            $result = $this->search($item);

            if ($result != null) 
                $result->increment();
            else 
                $this->list[] = $item;
        }

        public function delete($item)


        public function search ($target) {
            if (get_class($target) != get_class((new ProteinBar ()))) {
                throw new Exception("object of type " . get_class($target) . " is not valid for oderItemBag search");
            }
            $result = null;
            $name = $target->get_name();

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

    $bar = new ProteinBar();
    $bar->id('PN-XTP-653-P')->name('Rochberg')->grams(95)->retailPrice(1.99);
    $a = (new OrderItem())->bar($bar)->quantity(4);

    $bar = new ProteinBar();
    $bar->id('PN-KRV-363-T')->name('Fleisher')->grams(48)->retailPrice(2.99);
    $b = (new OrderItem)->bar($bar)->quantity(8);

    $items = new OrderItemBag();

    $items->add($oi);
    $items->add($a);
    $items->add($b);
    echo '<p>' . $items->to_table() . '</p>';

?>