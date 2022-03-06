<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require("shoe-generator.php");

   // $shoes = array();
    
    $shoe = $_SESSION['shoe'];
    //print_r($shoes);

/*
    print_r($shoes);
    $shoes->get_list();

    foreach ($shoes->get_list() as $shoe) {
        echo $shoe . "<br>";
    }
    print_r($_SESSION);
*/

?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<script type="text/javascript" src="script.js"></script> --> 
    <!--<script type="text/php" src="script.php"></script> --> 
    
    <title>The Template Title</title>
</head>

<!--######## Begin Body ########-->
<body>   
    <!--######## Start Header Section ########-->
    <header>
        <?php
            echo '<h1>' . $shoe->get_brand() . ' ' . $shoe->get_model() . '</h1>';
        ?>
    </header>

    <!--######## Start Nav Section ########-->
    <nav>
    </nav>

    <!--######## Start Main Section ########-->
    <main>
        <?php
            echo '<img src="' . $shoe->get_imagePath() . '>';
        ?>
    </main>

    <!--######## Start Footer Section ########-->   
    <footer>
    </footer>
</body>
<html>