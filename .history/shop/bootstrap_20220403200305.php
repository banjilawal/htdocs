<?php
    // directory paths
    define ('ROOT_PATH', dirname(__FILE__));
    define ('PROJECT_PATH', ROOT_PATH );

 #   define ('IMAGE_PATH', 'assets/images/');

    define ('MODEL_PATH', PROJECT_PATH . '/model');
    define ('CONTROL_PATH', PROJECT_PATH . '/control' );

    // Constants
    define ('MIN_GRAMS', 10);
    define ('MAX_GRAMS', 100);
    define ('LOWEST_PRICE', 1.05);
    define ('HIGHEST_PRICE', 10.99);
    define ('SALES_TAX_RATE', 0.10);

    define ('WORD_PATTERN', '/^[A-Z]{3,}$/i');
    define ('NAME_PATTERN', '/^[A-Z]{3,}$|^[A-Z]{3,}\s[A-Z]{3,}$/i');
    
    define ('LETTERS', array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z'));

    define ('DB_SERVER', 'localhost');
    define ('DB_USER', 'root');
    define ('DB_PASS', '');
    define ('DB_NAME', 'shop');


    function db_connect () {
        $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        return $mysqli;
    }

    function db_disconnect ($connection) {
        if (isset($connection)) {
            mysqli_close($connection);
        }
    }

    function random_image () {
        $files = array_diff(scandir(IMAGE_), array('.','..'));
        $path = trim((IMAGE . $files[array_rand($files,1)]), " ");

        return $path;
    } // close randomImagePath;
    #echo random_image_path();
   # echo  '<img src="' . random_image_path() . '" width="300" height="400">';

?>