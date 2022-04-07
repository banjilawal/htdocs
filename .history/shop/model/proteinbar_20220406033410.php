<?php
    require_once ('../bootstrap.php');

    define ('IMAGE', '../assets/images/');
    define ('BAR_ID_PATTERN', '/PN-[A-Z][A-Z][A-Z]-[2-9][2-9][2-9]-[P-Z]/i');

    function random_image_path () {
        $files = array_diff(scandir(IMAGE), array('.','..'));
        $path = trim((IMAGE . $files[array_rand($files,1)]), " ");

        return $path;
    } // close randomImagePath;
   # echo random_image_path();
   # echo  '<img src="' . random_image_path() . '" width="300" height="400">';

    class ProteinBar {
        private $id;
        private $name;
        private $stars;
        private $imagePath;
        private $description;
        private $grams;
        private $retailPrice;


        public function __construct() {
            $this->id = null;
            $this->name = null;
            $this->imagePath = random_image_path();
            $this->description = null;
            $this->grams = 0;
            $this->stars = 0; 
            $this->retailPrice = 0.00;      
        }

        public function id ($id) { 
            if (is_string($id) == false || preg_match(BAR_ID_PATTERN, $id) != 1) {
                throw new Exception($id . " is not a valid bar id");
            }
            $this->id = $id; 
            return $this; 
        }
        public function imagePath ($path) { 
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

        public function stars ($average) { 
            if ($average <td 0 || $average > 5) {
                throw new Exception($average . "is outside the range of possible star values");
            }
            $this->averageStars = $average; 
            return $this; 
        }

        function same ($obj) {
            if (get_class($obj) != 'ProteinBar') {
                return false;
            }

            $result = false;
            $bar = new ProteinBar();
            $bar = $obj;

            if ($this->id == $bar->get_id() || $this->name == $bar->get_name())
                $result = true;
            return $result;
        }

        public function load_image() {
            return ('<img src="' . $this->imagePath . '" width="300" height="400">');
        }

        public function to_row () {
            $elem = '<tr id="' . $this->id . '" name="' . $this->id . '" onclick="send_protein_bar(this)">'
                . '<td hidden>' . $this->id . '</td>'
                . '<td><img src="' . $this->imagePath . '" width="300" height="400"></td>'
                . '<td>' . $this->name . '</td>'        
                . '<td>' . $this->description . '</td>'
                . '<td>' . $this->grams . '</td>'
                . '<td>' . $this->retailPrice . '</td>'
                . '<td>' . $this->stars . '</td>'
                . '</tr>';
            return $elem;    
        }

        public function to_table () {
            $elem = '<table class=>'
            . '<thead>'
                    . '<tr>'
                        . '<th>ID</th>'
                        . '<th>Picture</th>'
                        . '<th>Name</th>'
                        . '<th>Stars</th>'
                        . '<th>Description</th>'
                        . '<th>Grams</th>'
                        . '<th>Retail Price</th>'
                    . '</tr>'
                . '</thead>'  
                . '<tbody>'
                    . '<tr>'
                        . '<td><img src="' . $this->imagePath . '" width="300" height="400"></td>'
                        . '<td>' . $this->id . '</td>'
                        . '<td>' . $this->name . '</td>'      
                        . '<td>' . $this->stars . '</td>' 
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
                . 'star rating: ' . $this->stars . ' '
                . 'image path: ' . $this->imagePath . ' ' 
                . 'description: ' . $this->description . ' ' 
                . 'grams: ' . $this->grams . ' ' 
                . 'retail price: ' . $this->retailPrice;

            return $text;
        }

        public function get_id () { return $this->id; }
        public function get_name () { return $this->name; }
        public function get_grams () { return $this->grams; }
        public function get_imagePath () { return $this->imagePath; }
        public function get_description () { return $this->description; }
        public function get_retailPrice () { return $this->retailPrice; }
        public function get_stars () { return $this->stars; }

    } // end class ProteinBar



    #echo $proteinBar;
    #echo $bar->to_table() . '<p>' .$bar . '</p>';
    #echo $bar->to_table();

    class ProteinBarBag {
        private $list = array();

        public function get_list () { return $this->list; }

        public function add ($item) {
            if (get_class($item) != 'ProteinBar') {
                throw new Exception("Not a valid class member for ProteinBar collector");
            }
            if (array_key_exists($item->get_id(), $this->list) == true) {
                throw new Exception ($item->get_id() . " is already listed");
            } 

            $id = $item->get_id();     
            $this->list[$id] = $item;
        }


        public function __toString() {
            $string = 'ProteinBarBag Contents' . '<br>' . PHP_EOL;

            foreach ($this->list as $id => $proteinBar) { $string  .= $this->list[$id] proteinBar . '<br>' . PHP_EOL; }
            return $string;
        } // close toString

        public function to_table () {
    
            $elem = '<table class="table" id="protein-bars-table" name="protein-bars-table">'
            . '<thead>'
                    . '<tr>'
                        . '<th>ID</th>'
                        . '<th>Picture</th>'
                        . '<th>Name</th>'
                        . '<th>Stars</th>'
                        . '<th>Description</th>'
                        . '<th>Grams</th>'
                        . '<th>Retail Price</th>'
                    . '</tr>'
                . '</thead>'
                . '<tbody class="table-body">';
    
                foreach ($this->list as $proteinBar) {
                   $elem .= $proteinBar->to_row();
                } 

                $elem .= '<tbody></table>';
                return $elem;
            }

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
    $proteinBar->description('mature seeds,navy,ckd,bld,beans,w/salt, unckd,dehyd (low-moisture),prunes, creme filling,choc sndwch');
    $bag->add($proteinBar);

    #echo $bag .  '<p></p>';
    #echo $bag->to_table() . '<p></p>';

?>