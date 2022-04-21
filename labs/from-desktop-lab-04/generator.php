<?php
    $title = "Generator";

    define ('IMAGE_DIRECTORY', "assets/sneakers/");
    define ('LETTERS', array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z'));
    define ('BRANDS', array("Bata","Clarks","Nike","Vans","Boston","Salomon","Testoni","Berluti","Reebok","Skechers","Red Wing","Keen","Ecco","Heely","New Balance","Asics","Puma","Adidas"));

    define ('MODELS', array("Bakhchiev","Pavlocich","Belisario","Elysees","Greinacher","Pays","Busching","Threnos","Tomasche","Oyle","Eschenbach","Pilss","Granat","Hands",
        "Margueite","Fleisher","Didjeridu","Saraban","Espan","Guttler","Firkusny","Yorkshire","Nowell","Selles","Vroons","Schicksalslie","Teramo","Bernfeld","Naegele",
        "Aeria","Busching","Noferi","Dizzi","Bars","Bester","Glauser","Bogaerts","Veils","Manzoni","Amorosa","Urbini","Nono","Cire","Wiklund","Soloist","Ponkin","Larviksp",
        "Leuchten","Dino","Piccinini","Michala","Iwasaki","Hearted","Bihlmaier","Viaggio","Viljakainen","Meylan","Ives","Reverence","Freibert","Knut","Garvelmann","Evenhymn",
        "Bresden","Honours","Lentz","Kober","Sephardim","Pasino","Chambon","Rheinla","Instrumentalis","Gorne","Nyffenegger","Paladins","Dushchenko","Anaosov","Rochberg",
        "Iwaki","Conversione","Pellie","Reznikoff","Postilion","Lizst","Dubar","Foldes","Lluna","Cata","Bondi","Althann","Jaroslav","Ranzani","Presenting","Temps","Watching",
        "Konzerstuck","Veyron","Biarent","Higginson","Mercre","Turetschek","Harty","Pomerian","Zagorinsky","Grammy","Wilm","Soren","Volpi","Germa","Misterio","Rotterdam",
        "Tabakov","Siegf","Kabaiwanska","Resurrection","Palma","Grasso","Haselboeck","Duos","Asheknazy","Visions","Dreame","Omar","Krafft","Alta","Sommerfest","Symphonists",
        "Sensations","Leande","Redel","Leman","Kerner","Entertainment","Cavasanti","Misha","Witwe","Nikolaeva","Reyna","Markus","Wildhaber","Waggoner","Adeste"));

   function random_brand () {
       return BRANDS[array_rand(BRANDS, 1)];
    } // close randomBrand

    function random_model () {
        return MODELS[array_rand(MODELS,1)];
    } 

    function random_price () {
        return (rand(39, 199) + 0.99);
    } // close randomPrice

    //echo "<p>" .  print_r(scandir(IMAGE_DIRECTORY)) . "</p>";

    function random_image_path () {
        $files = array_diff(scandir(IMAGE_DIRECTORY), array('.','..'));
        $path = trim((IMAGE_DIRECTORY . $files[array_rand($files,1)]), " ");

        return $path;
    } // close randomImagePath;

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

    class ShoeSize {
        private $size;
        private $in_wide;

        function __construct($size, $in_wide) {
            $this->size = $size;
            $this->in_wide =  $in_wide;
        }

        public function getSize () { return $this->size; }
        public function inWide () { return $this->in_wide; }
        public function setSize ($size) { $this->size = $size; }

        public function setInWide ($in_wide) {
            $this->in_wide = $in_wide;
        }

        public function __toString() {
            $string = $this->size;

            if ($this->in_wide == true) 
                $string .= "/" . $this->size . "W";
            
            return $string;
        }    
    } // end class ShoeSize


    class ShoeSizes {
        private $list = array();

        public function __construct() {
            $min = 7;
            $max = 13;
            $in_wide = false;
        
            for ($index = $min; $index < $max; $index++) { 
                if ($this->size_available() == true) {
                    $size = new ShoeSize($index, $this->available_wide());
                    //echo $size . "<br>";
                    $this->list[] = $size;
    
                    if (rand(0, 10) > 8) {
                        $size = new ShoeSize(($index + 0.5), $this->half_size_available());
                       // echo $size . "<br>";
                        $this->list[] = $size;
                    }
                }
            }
        } // close construct

        private function size_available () {
            if (rand(0,10) <= 2) return false;
            else
                return true;
        } //

        private function available_wide () {
            if (rand(0,10) > 7) {
                return true;
            }
            else {
                return false;
            }
        } //
    
        private function half_size_available () {
            if (rand(0,10) <= 2) return false;
            else
                return true;
        } //

        public function get_list () { return $this->list; }
        public function a_size () { return $this->list[0]; }

        public function html_list() {
            $elem = '<table>';
    
            foreach ($this->list as $item) {
                $elem .= '<tr><td>' . trim($item) . '</td></tr>';
            }
            $elem .= '</table>';
    
            return trim($elem);
        }

        public function __toString() {
            $string = "sizes(";
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
        private $price;

        function __construct() {
            $this->brand = random_brand();
            $this->style = "sneakers";
            $this->model = random_model();
            $this->price = random_price();
            $this->imagePath = random_image_path();
            $this->sizes  = new ShoeSizes();
        }

        public function get_brand () { return $this->brand; }
        public function get_model() { return $this->model; }
        public function get_price () { return $this->price; }
        public function get_imagePath () { return $this->imagePath; }
        public function get_sizes () { return $this->sizes; }
        public function get_name () { return ($this->brand . ' ' . $this->model); }

        public function set_brand ($brand) { $this->brand = $brand; }
        public function set_model($model) { $this->model = $model; }
        public function set_price ($price) { $this->price = $price; }
        public function set_imagePath($imagePath) { $this->imagePath = $imagePath; }

        public function load_image() {
            return ('<img src="' . $this->imagePath . '" width="300" height="400">');
        }

        public function to_table () {
            $elem = '<table class="shoe-table">'
                . '<tr><td><h2>' . $this->get_name() . ' Price: ' . $this->price . '</h2></td><tr>'
                . '<tr>'
                . '<td><img src="' . $this->imagePath . '" width="300" height="400"></td>'
                . '<td>' . $this->brand . '</td>'
                . '<td>' . $this->model . '</td>'
                . '<td>' . $this->sizes->html_list() . '</td>'
                . '<td>' . $this->price . '</td>'
                . '</tr>'
                . '</table>';
    
                return $elem;
        }

        public function __toString() {
            $string = "[ brand: " . $this->brand . ", model: " . $this->model . ", price: " . $this->price;
            $string .= ", " . $this->sizes  . ", image path: " . $this->imagePath . " ]"; 

            return $string;
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
                        . '<td id="' . $shoe->get_brand() . '-' . $shoe->get_model() . '-data">' . $shoe->to_table() . '</td>'
                        . '</tr>';
                    $counter++;
                }
                
                $elem .= '<tbody></table>';
    
                return $elem;
        } // close ahoes_table

    } // end Shoes class
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $title ?></title>

</head>

<body>  
</body>
<html>