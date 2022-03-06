<?php
    include_once('../bootstrap.php');

    $title = "Sneakers and Heels";

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
        //print_r(scandir('../assets/sneakers'));
        $directory = 'assets/sneakers';
        print_r(scandir($directory));
        $files = array_diff(scandir($directory), array('.','..'));
        $file = $files[array_rand(($files))];
        $r = $directory . $file;
        echo $r;
       // echo ROOT_PATH . '<br>';
        //echo PROJECT_PATH . '<Br>';
       // $files = array_diff(scandir(IMAGE_DIRECTORY), array('.','..')); //array('.','..'));
       // $file = $files[array_rand($files,1)];
        //print_r($files);
       // $r = IMAGE_DIRECTORY .  $file;
        //$path = trim((IMAGE_DIRECTORY  . ), " ");
        //echo '<br>' . IMAGE_DIRECTORY . $path . '<br>';

        return $r; //$path;
    } // close randomImagePath;

    echo random_image_path();
    echo '<img src="' . random_image_path() . '" width="300" height="400">';
   // echo '<img src="C:\xampp\htdocs\labs\lab-04\assets\sneakersxyfhaziwb3z01.jpg">';
    


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
?>