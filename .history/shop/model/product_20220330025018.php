<?php
    require_once ('../global-defs.php');
    define ('BAR_ID_PATTERN', '/^PN-[A-Z][A-Z][A-Z]-[2-9][2-9][2-9]-[P-Z]$/i');

    class ProteinBar {
        private $id;
        private $picture;
        private $name;
        private $description;
        private $grams;
        private $retailPrice;

        public function id ($id) { 
            if (is_string($id) == false || preg_match(BAR_ID_PATTERN, $id) != 1) {
                throw new Exception($id . " is not a valid bar id");
            }
            $this->id = $id; 
            return $this; 
        }
        public function picture ($picture) { $this->picture = $picture; return $this; }

        public function name ($name) { 
            if (is_string($name) == false || preg_match(NAME_PATTERN, $name) != 1) {
                throw new Exception($name . " is not a valid protein ba name");
            }
            $this->name = $name; 
            return $this; 
        }

        public function description ($description) { $this->description = $description; return $this; }

        public function grams ($grams) { 
            if ($grams < MIN_GRAMS || $grams > MAX_GRAMS) {
                throw new Exception($grams ." is outside the protein bar mass range");
            }
            $this->grams = $grams; 
            return $this; 
        }

        public function retailPrice ($price) { 
            if ($price < LOWEST_PRICE || $price > HIGHEST_PRICE) {
                throw new Exception($price . "is outside the acceptable retailprice range");
            }
            $this->retailPrice = $price; 
            return $this; 
        }

        public function get_id () { $this->id; }
        public function get_picture () { return $this->picture; }
        public function get_name () { return $this->name; }
        public function get_description () { return $this->description; }
        public function get_grams () { return $this->grams; }
        public function get_retailPrice () { return $this->retailPrice; }

        public function to_table () {

            $elem = '<table class="product-table" id="' . $this->id . '" name="' . $this->id . '">'
                . '<thead id="product-table-header" name="table-header">'
                    . '<tr class="product-table-header-row">>
                        <td><h2>' . $this->name . ' Price: ' . $this->retailPrice . '</h2></td>'
                    . '<tr>'
                    . '<tr class="product-table-header-row">'
                        . '<th hidden>id</th>'
                        . '<th>Picture</th>'
                        . '<th>Name</th>'
                        . '<th>Description</th>'
                        . '<th>Mass</th>'
                        . '<th>Retail Price</th>'
                    . '</tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr>'
                        . '<td hidden>' . $this->id . '</td>'
                        . '<td><img src="' . $this->picture . '" width="300" height="400"></td>'
                        . '<td>' . $this->name . '</td>'
                        . '<td>' . $this->description . '</td>'
                        . '<td>' . $this->grams . '</td>'
                        . '<td>' . $this->retailPrice . '</td>'                
                    . '</tr>'
                . '</tbody>'      
            . '</table>';
    
            return $elem;
        }

        public function __toString() {
            $text = $this->id . ' ' 
                . $this->name . ' ' 
                . $this->picture . ' ' 
                . $this->description . ' ' 
                . $this->grams . ' ' 
                . $this->retailPrice;
            return $text;
        }
    } // end class ProteinBar

    $bar = new ProteinBar();
    $bar->id('PN-XOP-226-P')->name('Bresden')->grams(84)->retailPrice(2.99);
    echo $bar->to_table() . '<p>' .$bar . '</p>';

    class ProteinBars {
        private $list = array();

        public function get_list () { return $this->list; }

        public function add ($item) {
            if (get_class($item) != get_class(new ProteinBar())) {
                throw new Exception("Not a valid class member for ProteinBar collector");
            }
            array_push($this->list, $item);
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
/*
    $bars = new ProteinBars();
    $bars->add($bar);

    $bar = new ProteinBar();
    $bar->id('PN-XTP-653-P')->name('Rochberg')->grams(95)->retailPrice(1.99);
    $bars->add($bar);

    $bar = new ProteinBar();
    $bar->id('PN-KRV-363-T')->name('Fleisher')->grams(48)->retailPrice(2.99);
    $bars->add($bar);

    echo $bars->to_table();
*/
?>