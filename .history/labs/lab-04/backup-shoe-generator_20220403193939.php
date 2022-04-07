<?php
    session_start();

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
    ra

/*
    echo '<br>' . random_brand() . '<br>';
    echo '<br>' . random_model() . '<br>';
    echo '<br>' . random_price() . '<br>';
    echo "<br>" . random_image_path() . "<br>";
*/

    class ShoeSize {
        private $size;
        private $in_wide;

        function __construct($size, $in_wide) {
            $this->size = $size;
            $this->in_wide =  $in_wide;
        }

        public function getSize () {
            return $this->size;
        }

        public function inWide () {
            return $this->in_wide;
        }

        public function setSize ($size) {
            $this->size = $size;
        }

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

    function available_wide () {
        if (rand(0,10) > 7) {
            return true;
        }
        else {
            return false;
        }
    } //

    function size_available () {
        if (rand(0,10) <= 2) return false;
        else
            return true;
    } //

    function random_sizes () {
        $min = 7;
        $max = 13;
        $in_wide = false;

        $sizes = array();

        for ($index = $min; $index < $max; $index++) { 
            if (size_available() == true) {
                $size = new ShoeSize($index, available_wide());
                //echo $size . "<br>";
                $sizes[] = $size;

                if (rand(0, 10) > 8) {
                    $size = new ShoeSize(($index + 0.5), available_wide());
                   // echo $size . "<br>";
                    $sizes[] = $size;
                }
            }
        }
        return $sizes;
    } // close randomSizes

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

    //echo create_id();

/*
    echo random_sizes ();

    $sizes = random_sizes ();
    print_r($sizes);

    foreach ($sizes as $size) {
       echo "size:" . $size . "<br>";
    }
*/

    class Shoe {
        private $brand;
        private $model;
        private $imagePath;
        private $sizes;
        private $price;
        private $rating;

        function __construct() {
            $this->brand = random_brand();
            $this->style = "sneakers";
            $this->model = random_model();
            $this->price = random_price();
            $this->imagePath = random_image_path();
            $this->sizes  = random_sizes();
            $this->rating = NULL;
        }
        
        public function set_brand ($brand) {
            $this->brand = $brand;
        }

        public function set_model($model) {
            $this->model = $model;
        }

        public function set_price ($price) {
            $this->price = $price;
        }

        public function set_rating ($rating) {
            $this->rating = $rating;
        }

        public function set_imagePath($imagePath) {
            $this->imagePath = $imagePath;
        }

        public function get_brand () {
            return $this->brand;
        }

        public function get_model() {
            return $this->model;
        }

        public function get_price () {
            return $this->price;
        }

        public function get_imagePath () {
            return $this->imagePath;
        }

        public function get_sizes () {
            return $this->sizes;
        }

        public function get_rating () {
            return $this->rating;
        }

        public function list_sizes () {
            $string = "";

            foreach ($this->sizes as $size) {
                $string .= $size . ', ';
            }

            $string = trim($string, " ");
            $string = trim($string, ",");

            return $string; //(trim($string, ","));
        } // close list_sizes

        public function __toString() {
            $string = "[ brand: " . $this->brand . ", model: " . $this->model . ", price: " . $this->price;
            $string .= ", rating: " . $this->rating;
            $string .= ", sizes: (" . $this->list_sizes() . "), image path: " . $this->imagePath . " ]";

            return $string;
        }
    } // end class Shoe

    $shoe = new Shoe();
    //echo "<p>" . $shoe . "</p>";

    //$name = pathinfo($shoe->get_imagePath(), PATHINFO_BASENAME);
    //echo $name;

    //print_r(pathinfo($path), );

    class Shoes {
        private $list = array();

        public function __construct() {
            $id = create_id();
            $this->list[$id] = (new Shoe());

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
            $id = create_id();

            while(is_null($this->search_model($model)) == false) {
                $shoe->set_model(random_model());
                $model = $shoe->get_model();
            }

            while(is_null($this->search_image($jpeg)) == false) {
                $shoe->set_imagePath(random_image_path());
                $jpeg = $shoe->get_imagePath();
            }
            $this->list[$id] = $shoe;
        } // close add

        public function count() {
            return count($this->list);     
        } // close count

        public function __toString() {
            $string = "";

            foreach ($this->list as $id => $shoe) {
                $string .= $id . '=>'. $shoe . '<br>' . PHP_EOL;
            }
            return $string;
        } // close toString

    } // end Shoes class
//       echo "<p></p>";

    $shoes = new Shoes();
    $shoes->add(new Shoe());
    $shoes->add(new Shoe());
//echo '<p><h1>Shoes</h1></p>' . $shoes . '<p></p>';

/*
    foreach ($shoes->get_list() as $s) {
        echo $s . '<br>';
    }
*/
    //echo '<p> there are ' . $shoes->count() . ' shoes in the collection</p>"';

    //var_dump($_SESSION['shoe_collection']);
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<script type="text/javascript" src="script.js"></script> !--> 
    <!--<title>Shoe Collection Generator</title> !-->
</head>

<body>  
    <?php
    /*
        echo "<h1>Created " . $shoes->count() . " Unique Shoes</h1>";
        echo "<p>".$shoes . "</p>";

        $session_['shoe'] = NULL;
        $_SESSION['shoe'] = $shoe;
     */   
        $session_['shoe_collection'] = NULL;
        $_SESSION['shoe_collection'] = $shoes;
    ?> 
</body>
<html>