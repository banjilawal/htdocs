<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<script type="text/javascript" src="script.js"></script> --> 
    
    <title>The Template Title</title>
</head>

<!--######## Begin Body ########-->
<body>   
    <!--######## Start Header Section ########-->
    <header>

    </header>

    <!--######## Start Nav Section ########-->
    <nav>

    </nav>

    <!--######## Start Main Section ########-->
    <main>

    </main>
    <!--######## End Main Section ########--> 
    <?php
        function comp ($a, $b) { 
            if ($a > $b) return 1;
            else if ($a < $b) return -1;
            else return 0;
        }
        $result = comp(2,3);
        
        echo 'result ' . $result;
    ?>

    <!--######## Start Footer Section ########-->   
    <footer>

    </footer>
</body>
<html>