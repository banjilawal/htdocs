<?php
    session_start();
    $title ="Process Rating";
    require("rating.php");
    $title ="Process Rating";
    header($title);


    $shoe = unserialize($_SESSION['shoe']);
    //echo $shoe . '<p></p>';

    $rating = $_GET['stars'];
    $comments = $_GET['comments'];

    //print_r($_GET);
    $rating = new Rating($shoe, $rating);
    $rating->set_comment($comments);

    $title = 'Thank You For Rating the ' . $rating->get_shoe()->get_name() . ' Shoes';
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $title; ?></title>
</head>

<body> 
<header>
    <h1><?php echo $title; ?></h1>
    <p>
        Your feedback helps us maintain a high level of service.
    </p>
</header>  

<main>
    <p></p>
    <?php echo $rating->to_table(); ?>
</main>
</body>
<html>