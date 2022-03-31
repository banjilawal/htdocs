<?php
    define ('ROOT_PATH', realpath(__FILE__));
    define ('PROJECT_PATH', ROOT_PATH);

    define ('PUBLIC_PATH', ROOT_PATH . '\public');
    define ('STYLE_PATH', ROOT_PATH . '\style');
    define ('SOURCE_PATH', ROOT_PATH . '\src');
    define ('LIBRARY_PATH', SOURCE_PATH . '\lib');
    define ('CLASS_PATH', SOURCE_PATH . '\class');

    define ('ASSET_PATH', ROOT_PATH . '\assets');
    //define ('IMAGE_DIRECTORY', ASSET_PATH . '\sneakers');

    // constants
    define ('SHOE_CATALOG_SIZE', 10);
    define ('MIN_SHOE_SIZE', 7);
    define ('MAX_SHOE_SIZE', 13);
    define ('DEFAULT_SHOE_SIZE', 10);

    define ('LOWEST_PRICE', 19);
    define ('HIGHEST_PRICE', 199);

    define ('SALES_TAX_RATE', 0.10);
    define ('MAX_BRANDS_ON_SALE', 5);
    define ('SALE_BRANDS_DISCOUNT_RATE', 0.4);
    define ('MAX_REGULAR_DISCOUNT_RATE', 0.6);
    define ('MAX_COMBINED_DISCOUNT_RATE', 0.6);

    $title = "Sneakers and Heels";

    //define ('IMAGE_DIRECTORY', 'C:/xampp/htdocs/labs/lab-04/assets/sneakers/'); //'../assets/sneakers/');
    define ('IMAGE_DIRECTORY', 'assets/sneakers/');
    define ('LETTERS', array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z'));
    define ('BRAND_NAMES', array("Bata","Clarks","Nike","Vans","Boston","Salomon","Testoni","Berluti","Reebok","Skechers","Red Wing","Keen","Ecco","Heely","New Balance","Asics","Puma","Adidas"));

    define ('MODELS', array("Bakhchiev","Pavlocich","Belisario","Elysees","Greinacher","Pays","Busching","Threnos","Tomasche","Oyle","Eschenbach","Pilss","Granat","Hands",
        "Margueite","Fleisher","Didjeridu","Saraban","Espan","Guttler","Firkusny","Yorkshire","Nowell","Selles","Vroons","Schicksalslie","Teramo","Bernfeld","Naegele",
        "Aeria","Busching","Noferi","Dizzi","Bars","Bester","Glauser","Bogaerts","Veils","Manzoni","Amorosa","Urbini","Nono","Cire","Wiklund","Soloist","Ponkin","Larviksp",
        "Leuchten","Dino","Piccinini","Michala","Iwasaki","Hearted","Bihlmaier","Viaggio","Viljakainen","Meylan","Ives","Reverence","Freibert","Knut","Garvelmann","Evenhymn",
        "Bresden","Honours","Lentz","Kober","Sephardim","Pasino","Chambon","Rheinla","Instrumentalis","Gorne","Nyffenegger","Paladins","Dushchenko","Anaosov","Rochberg",
        "Iwaki","Conversione","Pellie","Reznikoff","Postilion","Lizst","Dubar","Foldes","Lluna","Cata","Bondi","Althann","Jaroslav","Ranzani","Presenting","Temps","Watching",
        "Konzerstuck","Veyron","Biarent","Higginson","Mercre","Turetschek","Harty","Pomerian","Zagorinsky","Grammy","Wilm","Soren","Volpi","Germa","Misterio","Rotterdam",
        "Tabakov","Siegf","Kabaiwanska","Resurrection","Palma","Grasso","Haselboeck","Duos","Asheknazy","Visions","Dreame","Omar","Krafft","Alta","Sommerfest","Symphonists",
        "Sensations","Leande","Redel","Leman","Kerner","Entertainment","Cavasanti","Misha","Witwe","Nikolaeva","Reyna","Markus","Wildhaber","Waggoner","Adeste"));

    // Helper functions that are used to randomly get values from various sets
   function random_brand () {
       return BRAND_NAMES[array_rand(BRAND_NAMES, 1)];
    } // close randomBrand
    //echo random_brand();

    function random_model () {
        return MODELS[array_rand(MODELS,1)];
    } 
    //echo '<p>' . random_model() . '</p>';

    function random_price () {
        return (rand(LOWEST_PRICE, HIGHEST_PRICE) + 0.99);
    } // close randomPrice

    function random_image_path () {
        $files = array_diff(scandir(IMAGE_DIRECTORY), array('.','..')); //array('.','..'));
        $file = $files[array_rand($files,1)];

        $path = trim((IMAGE_DIRECTORY  . $file), " ");
        return $path;
    } // close randomImagePath


    // Used to generate  hopefully random string of characters for each shoe's id.  T
    // Would he letters I, O, and L are excluded since they can be confused with numbers
    // Will probably change this for an id generator based on pattern matching and regexp
    function create_id () {
        $id = 'SH-';

        for ($index = 0; $index < 5; $index++) {
            $id .= LETTERS[array_rand(LETTERS, 1)];
        }
        $id .= '-';

        for ($index = 0; $index < 4; $index++) { 
            $id .= rand(0, 9);
        }
        $id .= '-';

        for ($index = 0; $index < 3; $index++) {
            $id .= LETTERS[array_rand(LETTERS, 1)];
        }
        $id .= '-' . rand(0, 9);

        return $id;
    }
    //Brands need their own class becuase it's easier to show if they are havinng a sale
    // or we can incorporate their logos in the site.
    class Brand {
        private $name;
        private $onSale;
        private $discountRate;

        public function __construct ($name) {
            $this->name = $name;

            if (rand(0, 99) > 75) {
                $this->onSale = true;
                $this->discountRate = SALE_BRANDS_DISCOUNT_RATE; 
            }
            else {
                $this->onSale = false;
                $this->discountRate = 0.00;
            }
        } // close constructor

        public function get_name () { return $this->name; }
        public function is_on_sale () { return $this->onSale; }
        public function get_discount_rate () { return $this->discountRate; }

        // The name mu
        public function set_name ($name) { $this->name = $name; }


        public function put_on_sale ($bool) { 
            if (!is_bool($bool)) {
                throw new Exception('invalid ' . gettype($bool) . ' parameter passed to method', 1);
                //var_dump(debug_backtrace());
                print_r(debug_backtrace());
                exit(22);          
            }
            $this->onSale = $bool; 

            if ($bool == true)
                $this->discountRate = SALE_BRANDS_DISCOUNT_RATE;
            else 
                $this->discountRate = 0.00;
        }

        public function set_discount_rate ($ratio) { 
            if ($this->onSale == false) {
                throw new Exception("The brand is not on sale.  It cannot be discounted", 1);
                var_dump(debug_backtrace());
                exit(1);
            }

            if ($ratio <  0.00 || $ratio > SALE_BRANDS_DISCOUNT_RATE) {
                throw new Exception("discount rate out of range", 1);
                
            }
            $this->discountRate = $ratio; 
        }

        public function __toString() {
           $string = '[ Brand Name: ' . $this->name;
           
           if ($this->onSale && $this->discountRate > 0.00)
               $string .= ', Percent Discount: ' . ($this->discountRate * 100.00);

           $string .= ' ]';
           return $string;
        }         
    } // end class Brand

    $brand = new Brand(random_brand());
    $brand->put_on_sale(true);


    class Brands {
        private $list = array();

        public function __construct () {     
            foreach (BRAND_NAMES as $brand) {
                $this->list[] = new Brand($brand);
            }
        }

        public function members () {
            return $this->list;
        }

        public function random () {
            return $this->list[array_rand($this->list, 1)];
        }


        public function search ($name) {
            $index = 0;
            $result = NULL;

            while (is_null($result) || $index <= count($this->list)) {
                if ($this->list[$index]->get_name() == $name)
                    $result = $this->list[$index];
                $index++;
            }
        }

        public function add ($brand) {
            $name = $brand->get_name();

            if (is_null($this->search($name)) == true) {
                throw new Exception( $name . " already in the Brands collection", 1); 
                exit(5);   
            }
            $this->list[] = $brand;
        }

        public function get_discounted () {
            $list = array ();

            foreach ($this->list as $brand) {
                if ($brand->is_on_sale()) $list[] = $brand;
            }
            return $list;
        }

        public function __toString() {
            $string = '';

            foreach ($this->list as $brand) {
                $string .= $brand . '<br>' .PHP_EOL;
            }
            return $string;
        }

        public function to_table ($filter=NULL) {
            $list = array();

            if ($filter == 'discounted') {
                foreach ($this->list as $brand) {
                    if ($brand->is_on_sale() == true) {
                        $list[] = $brand;
                    }
                }
            }
            else {
                $list = $this->list;
            }

            $elem = '<table><tr>';

            foreach ($list as $item) {
                $elem .= '<td>' . $item->get_name() . '</td>';
            }
            $elem .= '</tr></table>';

            return $elem;
        }
    }


    class ShoeSize {
        private $size;
       // private $in_wide;

        function __construct($size) {
            $this->size = $size;
        }

        public function get_size () { return $this->size; }
        public function set_size ($size) { $this->size = $size; }

        public function __toString() {
            return ($this->size);
        }    
    } // end class ShoeSize


    class ShoeSizes {
        private $list = array();

        public function __construct() {
      
            for ($index = MIN_SHOE_SIZE; $index < MAX_SHOE_SIZE; $index++) { 
                if ($this->size_available() == 'yes') {
                    $this->list[] = new ShoeSize($index);

                    $this->add_wide_size($index);
                    $this->add_half_Size($index);
                    $this->add_half_wide_size($index);
                }
            }
        } // close construct

        private function size_available () {
            $available = 'yes';

            if (rand(0,10) <= 2) $available = 'no';
            return $available;
        } //

        private function add_wide_size ($number) {
            if (rand(0,10) > 7) 
                $this->list[] = new ShoeSize($number . 'W');
        } //

        private function add_half_size ($number) {
            if (rand(0, 10) <= 2)
                $this->list[] = new ShoeSize($number + 0.5);
        }

        private function add_half_wide_size ($number) {
            $outcomeA = rand(0, 10);
            $outcomeB = rand(0, 10);

            if ($outcomeA > 7 && $outcomeB <= 2)
                $this->list[] = new ShoeSize(($number + 0.5) . 'W');
        }

        public function get_list () { return $this->list; }
        public function a_size () { return $this->list[0]; }

        public function random () { 
            return $this->list[array_rand($this->list, 1)];
        }

        public function html_list() {
            $elem = '<table>';
    
            foreach ($this->list as $item) {
                $elem .= '<tr><td>' . trim($item) . '</td></tr>';
            }
            $elem .= '</table>';
    
            return trim($elem);
        }

        public function __toString() {
            $string = "sizes (";
            foreach ($this->list as $item) {
                $string .= $item . ', ';
            }

            $string = trim($string, " ");
            $string = trim($string, ",");

            return ($string . ')');
        }

    } // end class ShoeSizes


    class Shoe {
        private $brand;
        private $model;
        private $imagePath;
        private $sizes;

        private $discountRate;
        private $regularPrice;
        private $currentPrice;

        function __construct() {
            $this->brand = (new  Brands())->random();
            $this->style = "sneakers";
            $this->model = random_model();
            $this->regularPrice = random_price();
            $this->imagePath = random_image_path();
            $this->sizes  = new ShoeSizes();

            $this->set_on_sale();

            $this->currentPrice = $this->regularPrice;
            $totalDiscountRate = $this->total_discount_rate();

            if ($this->total_discount_rate() > 0.00) {
                $discountAmount = $this->regularPrice * $totalDiscountRate;
                $this->currentPrice = $this->regularPrice - $discountAmount;
            }
        }

        public function get_brand () { return $this->brand; }
        public function get_model() { return $this->model; }

        public function get_imagePath () { return $this->imagePath; }
        public function get_sizes () { return $this->sizes; }
        public function get_name () { return ($this->brand->get_name() . ' ' . $this->model); }

        public function get_current_price () { return $this->currentPrice; }
        public function get_regular_pricce () {return $this->regularPrice; }
        
        public function get_discount_amount () { 
            return $this->regularPrice * $this->total_discount_rate();
        }

        public function total_discount_rate () {
            return $this->discountRate + $this->brand->get_discount_rate();
        }

        public function set_brand ($brand) { $this->brand = $brand; }
        public function set_model($model) { $this->model = $model; }
        public function set_regular_price ($price) { $this->regularPrice = $price; }
        public function set_imagePath($imagePath) { $this->imagePath = $imagePath; }

        public function load_image() {
            return ('<img src="' . $this->imagePath . '" width="300" height="400">');
        }

        public function price_table () {
            $priceRow =  '<tr><td>' . $this->regularPrice . '</td></tr>'; 
            $discountRow = '';
            
            if ($this->currentPrice < $this->regularPrice) {
                $discountRow = '<tr><td>' . $this->total_discount_rate() * 100 . '% price cut</td></tr>';
                $priceRow = '<tr><td>From ' . $this->regularPrice . '</td></tr>'
                    . '<tr><td>To ' . $this->currentPrice . '</td><tr>';
            }

            $elem = '<table>' . $discountRow . $priceRow . '</table>';
            return $elem;          
        }

        public function to_table () {

            $elem = '<table class="shoe-table">'
                . '<tr><td><h2>' . $this->get_name() . ' Price: ' . $this->currentPrice . '</h2></td><tr>'
                . '<tr>'
                . '<td><img src="' . $this->imagePath . '" width="300" height="400"></td>'
                . '<td>' . $this->brand->get_name() . '</td>'
                . '<td>' . $this->model . '</td>'
                . '<td>' . $this->sizes->html_list() . '</td>'
                . '<td>' . $this->price_table() . '</td>'
                . '</tr>'
                . '</table>';
    
                return $elem;
        }

        public function __toString() {
            $string = '[ Brand: ' . $this->brand->get_name() . ', model: ' . $this->model . ', '. $this->report_price();
            $string .= ', ' . $this->sizes  . ', image path: ' . $this->imagePath . ' ]'; 

            return $string;
        }

        public function report_price () {
            $string = "price: " . $this->regularPrice;

            if ($this->currentPrice < $this->regularPrice) {
                $string = 'price discounted ' . ($this->total_discount_rate() * 100) . '% from ' 
                    . $this->regularPrice . ' to ' . $this->currentPrice;
            }

            return $string;
        }

        private function set_on_sale () {
            if (rand(0,99) >= 70) {
                if ($this->brand->get_discount_rate() == 0.0)
                    $this->discountRate = rand(10,60)/100.00;
                else 
                    $this->discountRate = (rand(0,20)/100.00);
            }
        }
    } // end class Shoe

    class Shoes {
        public $list = array();

        public function __construct() {
            $this->list[] = new Shoe();

            for ($i=0; $i < 10; $i++) { 
                $this->add(new Shoe());
            }
        }

        public function get_list () {
            return $this->list;
        }

        public function search_model ($target) {
            $result = null;

            foreach ($this->list as $item) {
                if ($item->get_model() == $target) {
                    $result = $item;
                    break;
                }
            }
            return $result;
        } // close search_model

        public function search_image ($target) {
            $result = null;

            foreach ($this->list as $item) {
                $picture = pathinfo($item->get_imagePath(), PATHINFO_BASENAME);

                if ($picture == $target) {
                    $result = $item;
                    break;
                }
            }

            return $result;
        } // close search_image

        public function add ($shoe) {
            $model = $shoe->get_model();
            $jpeg = pathinfo($shoe->get_imagePath(), PATHINFO_BASENAME);

            while(is_null($this->search_model($model)) == false) {
                $shoe->set_model(random_model());
                $model = $shoe->get_model();
            }

            while(is_null($this->search_image($jpeg)) == false) {
                $shoe->set_imagePath(random_image_path());
                $jpeg = $shoe->get_imagePath();
            }
            $this->list[] = $shoe;
        } // close add

        public function count() {
            return count($this->list);     
        } // close count

        public function __toString() {
            $string = "";

            foreach ($this->list as $shoe) { $string  .= $shoe . '<br>' . PHP_EOL; }
            return $string;
        } // close toString

        public function to_table () {
            $counter = 0;
    
            $elem = '<table class="table" id="shoes-table" name="shoes-table">'
                . '<thead class="table-head" id="shoes-table-head" name="shoes-table-head">'
                . '<tr class="header-row" id="shoes-table-header-row" name=""shoes-table-header-row>'
                . '<th class="id-column" hidden="true">Row</th>'
                . '<th class="shoe-column">Shoe</th>'
                . '</tr>'
                . '</thead>'
                . '<tbody class="table-body" id="shoes-table-body" name="shoes-table-body">';
    
                foreach ($this->list as $shoe) {
                   $elem .= '<tr id="' . $counter . '" name="' . $counter . '" onclick="send(this)">'
                        . '<td hidden="true">' . $counter . '</td>'
                        . '<td id="' . $shoe->get_brand()->get_name() . '-' . $shoe->get_model() . '-data">' . $shoe->to_table() . '</td>'
                        . '</tr>';
                    $counter++;
                }
                
                $elem .= '<tbody></table>';
    
                return $elem;
        } // close ahoes_table
    } // end Shoes class

    //$shoes = new Shoes();
    //echo $shoes->to_table();
?>