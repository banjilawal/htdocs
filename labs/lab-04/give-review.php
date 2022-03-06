<?php
    session_start();

    require_once("generator.php");
    $title = 'We Appreciate You Taking the Time to Review the ';


    $shoe = unserialize($_SESSION['shoe']);
    $title .=  $shoe->get_name() . ' Shoes';
    //header($title);
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>e Appreciate You Taking the Time to Review the</title>
<!--    <title><?php echo $title  ?></title>
-->
</head>

<body>   
<header>
    <h1>We Appreciate You Taking the Time to Review the</h1> <!--<?php echo $title; ?></h1>-->
    <p>
        Please be aware the words: 'ghastly', 'repulsive', 'appalling', and horrendous will be replaced with another word.
    </p>
</header>

<main>
    <form id="rating" name="rating" method="get" action="process-rating.php">
        <table>
            <tr>
                <td>
                    <p>
                    <label for="stars">How Many Stars?</label><br>
                    <select id="stars" name="stars" required="true" form="rating">
                        <option value="">-- Pick Your Rating --</option>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                    </p>
                    <p>
                        <label for="comments">Comments</label><br>
                        <textarea id="comments" name="comments" rows="20" cols="80"></textarea>
                    </p>
                </td>
                <td>
                    <?php 
                        echo $shoe->get_name() . ' Price: ' . $shoe->report_price() . '<p></p>';
                        echo $shoe->load_image();
                    ?>
                </td>
            </tr>
        </table>
        <input type="submit" id="submit-rating" name="submit-rating" value="Submit Rating"></input>
    </form>

    <?php
        $_SESSION['shoe'] = NULL;
        $_SESSION['shoe'] = serialize($shoe);
    ?>
</main>
</body>
<html>