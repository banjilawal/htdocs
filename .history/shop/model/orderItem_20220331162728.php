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
            if (get_class($bar) != 'ProteinBar') {
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
            $this->cost = $this->quantity * $this->proteinBar->get_retailPrice();
;           return $this;
        }

        public function get_id () { return $this->id; }
        public function get_bar () { return $this->proteinBar; }
        public function get_quantity () { return $this->quantity; }

        public function get_cost () { 
            return ($this->item->get_retailPrice() * $this->quantity); 
        }

        public function __toString() {
            $text = $this->id . ' ' 
                . ' ' . $this->proteinBar->__toString()
                . ' ' . $this->quantity  
                . ' ' . $this->cost;
            return $text;
        }

    } // end class OrderItem

    $orderItem = (new OrderItem())->bar($bar)->quantity(3);;
    #echo $orderItem;

    class OrderItems {
        private $list = array();

        public function get_list () { return $this->list; }

        public function add ($item) {
            if (get_class($item) != get_class(new OrderItem())) {
                throw new Exception("Not a valid class member for OrderItem collector");
            }

            if ($this->search_name($item->get->item->get->name()))
            $this->list[] = $item;
        }


        public function search_name ($target) {
            $result = null;

            foreach ($this->list as $item) {
                if ($item->get_name() == $target) {
                    $result = $item;
                    break;
                }
            }
            return $result;
        } // close search_model

        public function search_id ($target) {
            $result = null;

            foreach ($this->list as $item) {
                if ($item->get_id() == $target) {
                    $result = $item;
                    break;
                }
            }
            return $result;
        } // close search_id

        public function __toString() {
            $string = "";

            foreach ($this->list as $bar) { $string  .= $bar . '<br>' . PHP_EOL; }
            return $string;
        } // close toString

        public function to_table () {
    
            $elem = '<table class="table" id="protein-bars-table" name="protein-bars-table">'
                . '<thead class="table-head" id="protein-bars-table-head" name="protein-bars-table-head">'
                . '<tr class="header-row" id="protein-bars-table-header-row" name=""protein-bars-table-header-row>'
                . '<th class="id-column" hidden="true">Row</th>'
                . '<th class="protein-bar-column">Protein Bars/th>'
                . '</tr>'
                . '</thead>'
                . '<tbody class="table-body" id="shoes-table-body" name="shoes-table-body">';
    
                foreach ($this->list as $bar) {
                   $elem .= '<tr id="' . $bar->get_id() . '" name="' . $bar->get_id() . '" onclick="send(this)">'
                        . '<td hidden="true">' . $bar->get_id() . '</td>'
                        . '<td>' . $bar->to_table() . '</td>'
                        . '</tr>';
                }
                
                $elem .= '<tbody></table>';
    
                return $elem;
            }

    } // end class ProteinBars
?>