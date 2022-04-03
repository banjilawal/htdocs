<?php
    require_once ('../global-defs.php');
    define ('BAR_ID_PATTERN', '/^PN-[A-Z][A-Z][A-Z]-[2-9][2-9][2-9]-[P-Z]$/i');

    class ProteinBar {
        private $id;
        private $imagePath;
        private $name;
        private $description;
        private $grams;
        private $retailPrice;

        public function __construct() {
            $this->id = null;
            $this->path = null;
            $this->name = null;
            $this->description = null;
            $this->grams = 0;
            $this->retailPrice = 0.00;            
        }

        public function id ($id) { 
            if (is_string($id) == false || preg_match(BAR_ID_PATTERN, $id) != 1) {
                throw new Exception($id . " is not a valid bar id");
            }
            $this->id = $id; 
            return $this; 
        }
        public function image_path ($path) { 
            $this->imagePath = $path; 
            return $this; 
        }

        public function name ($name) { 
            if (is_string($name) == false || preg_match(NAME_PATTERN, $name) != 1) {
                throw new Exception($name . " is not a valid protein ba name");
            }
            $this->name = $name; 
            return $this; 
        }

        public function description ($description) { 
            $this->description = $description; 
            return $this; 
        }

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

        public function to_table () {
            $elem = '<table class=>'
            /*
            . '<thead>'
                    . '<tr>'
                        . '<th>ID</th>'
                        . '<th>Picture</th>'
                        . '<th>Name</th>'
                        . '<th>Description</th>'
                        . '<th>Grams</th>'
                        . '<th>Retail Price</th>'
                    . '</tr>'
                . '</thead>'
            */   
                . '<tbody>'
                    . '<tr>'
                        . '<td><img src="' . $this->imagePath . '" width="300" height="400"></td>'
                        . '<td>' . $this->id . '</td>'
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
            $text = ' id: ' . $this->id . ' ' 
                . 'name: ' . $this->name . ' ' 
                . 'image path: ' . $this->imagePath . ' ' 
                . 'description: ' . $this->description . ' ' 
                . 'grams: ' . $this->grams . ' grams ' 
                . $this->retailPrice;
            return $text;
        }

        public function get_id () { $this->id; }
        public function get_name () { return $this->name; }
        public function get_grams () { return $this->grams; }
        public function get_image_path () { return $this->imagePath; }
        public function get_description () { return $this->description; }
        public function get_retailPrice () { return $this->retailPrice; }

    } // end class ProteinBar



    #echo $proteinBar;
    #echo $bar->to_table() . '<p>' .$bar . '</p>';
    #echo $bar->to_table();

    class ProteinBarBag {
        private $list = array();

        public function get_list () { return $this->list; }

        public function add ($item) {
            if (get_class($item) != get_class(new ProteinBar())) {
                throw new Exception("Not a valid class member for ProteinBar collector");
            }

            if ($this->name_search($item) != null) {
                throw new Exception ($item->get_name() . " is already listed");
            }

            if ($this->id_search($item) != null) {
                throw new Exception ($item->get_id() . " is already listed");
            }

            $this->list[] = $item;
        }

        public function name_search ($target) {
            if (get_class($target) != get_class(new ProteinBar())) {
                throw new Exception("Not a valid class member for ProteinBar collector");
            }
            $result = null;
            $name = $target->get_name();

            foreach ($this->list as $proteinBar) {
                if ($proteinBar->get_name() == $name) {
                    $result = $proteinBar;
                    break;
                }
            }
            return $result;
        } // close search_model

        public function id_search ($target) {
            if (get_class($target) != get_class(new ProteinBar())) {
                throw new Exception("Not a valid class member for ProteinBar collector");
            }          
            $result = null;
            $id = $target->get_id();
            echo 'search target : ' . $id . '<br>';

            foreach ($this->list as $proteinBar) {
                if ($proteinBar->get_id() == $id) {
                    $result = $proteinBar;
                    echo 'found ' . $target . '<br>';
                    break;
                }
            }
            return $result;
        } // close search_id

        public function __toString() {
            $string = "";

            foreach ($this->list as $proteinBar) { $string  .= $proteinBar . '<br>' . PHP_EOL; }
            return $string;
        } // close toString

        public function to_table () {
    
            $elem = '<table class="table" id="protein-bars-table" name="protein-bars-table">'
            . '<thead>'
                    . '<tr>'
                        . '<th>Picture</th>'
                        . '<th>ID</th>'
                        . '<th>Name</th>'
                        . '<th>Description</th>'
                        . '<th>Grams</th>'
                        . '<th>Retail Price</th>'
                    . '</tr>'
                . '</thead>'
                . '<tbody class="table-body">';
    
                foreach ($this->list as $proteinBar) {
                   $elem .= '<tr id="' . $proteinBar->get_id() . '" name="' . $proteinBar->get_id() . '" onclick="send(this)">'
                        . '<td>' . $proteinBar->to_table() . '</td>'
                        . '</tr>';
                }
                
                $elem .= '<tbody></table>';
    
                return $elem;
            }
/*
            function equals ($obj) {
                $result = false;

                if (get_class($obj) != 'ProteinBar') {
                    return false;
                }

                $bar = new ProteinBar();
                $bar = $obj;

                if ($this->id == $bar->get_id)

                return $result;
            }
*/
    } // end class ProteinBars

    $bag = new ProteinBarBag();

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-XOP-226-P')->name('Bresden')->grams(84)->retailPrice(2.99);
    $proteinBar->description('blade rst,chuck,ln and fat,1/8 inchfat,beef,sel,raw, hot cocoa,choc bev,homemade,milk');
    $bag->add($proteinBar);

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-XPF-327-P')->name('Rochberg')->grams(95)->retailPrice(1.99);
    $proteinBar->description('thigh,broilers or fryers,meat and skn,ckd,chicken,stwd, crackers (made with whl grain),cheez-it,suns');
    $bag->add($proteinBar);

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-OBV-267-W')->name('Fleisher')->grams(48)->retailPrice(2.99);
    $proteinBar->description('oat bran,bagels, sauce,canned,w/onions,tomato products, unpr,frz,kashi three cheese ravioli with med');
    $bag->add($proteinBar);

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-SBO-248-P')->name('Saraban')->grams(95)->retailPrice(1.99);
    $proteinBar->description('m and ms crispy choc c and ies,mars snackfood us,c and ies, apl),grp,ocean spry,w/vit c,ruby red grp',);
    $bag->add($proteinBar);

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-WLD-657-W')->name('Symphonists')->grams(48)->retailPrice(2.99);
    $proteinBar->description('minis multigrain crackers,club,keebler, frozen,lasagna with meat and sauce, loin,frsh,country-style');
    $bag->add($proteinBar);

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-JIK-382-X')->name('Nyffenegger')->grams(94)->retailPrice(1.99);
    $bar->description('mature seeds,navy,ckd,bld,beans,w/salt, unckd,dehyd (low-moisture),prunes, creme filling,choc sndwch');
    $bag->add($proteinBar);
    
    #echo $bag->to_table();

?>