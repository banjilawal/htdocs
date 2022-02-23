<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="script.js"></script>  
        
        <title>ICS 325-01 Lecture 2: Breakout Activity</title>
    </head>

<!--######## Begin Body ########-->
    <body>   
        <!--######## Start Header Section ########-->
        <header>

        </header>
        <!--######## End Header Section ########-->

        <!--######## Start Nav Section ########-->
        <nav>

        </nav>
        <!--######## End Nav Section ########-->

        <!--######## Start Main Section ########-->
        <main>

        </main>
        <!--######## End Main Section ########--> 
        div>
<form action="" method="post">
    <h3>Enter two numbers for the calculator along with the operation to perform</h3>
    <table style="border: 0px;">
        <tr style="background: #cccccc;">
            <td>X <input type="int" name="x"/></td>         
        </tr>
        <tr style="background: #cccccc;">
            <td>Y <input type="int" name="y"/></td>
        </tr>
        <tr style="background: #cccccc;">
            <td>operator <input type="string" name="operator"/></td>
        </tr>
    </table>
    <input type="submit">
</form>
</div>

<?php
    echo "<p>";
    echo "<div>";

    $x = $_POST['x'];
    $y = $_POST['y'];
    $operator = $_POST['operator'];



    switch ($operator) {
        case "+":
            $result = $x + $y;
    }

    echo "<h3>Pre-Swap Variable States:</h3>";
    echo '<table style="border: 0px;">';
    echo '<tr style="background: #cccccc;"><td>X</td><td>Y</td></tr>';
    echo "<tr><td>" . $x . "</td>";
    echo "<td>" . $y . "</td></tr>";
    echo "</table>";

    $temp = $x;
    $x = $y;1   
    $y = $temp;
   echo "</div>";
   echo "</p>";
?>
        
        <!--######## Start Footer Section ########-->   
        <footer>

        </footer>
        <!--######## End Footer Section ########-->
    </body>
<!--######## Finish Body ########-->
<html>