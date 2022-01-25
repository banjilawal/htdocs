<html>
<head>
    <title>ICS 325-01 Lecture 2: Breakout Activity</title>
</head>
<body>
<h1>Number Swapping Form</h1>

<div>
<form action="breakout-01.php" method="post">
    <h3>Enter Values For X and Y</h3>
    <table style="border: 0px;">
        <tr style="background: #cccccc;">
            <td>X <input type="int" name="x"/></td>         
        </tr>
        <tr>
            <td>Y <input type="int" name="y"/></td>
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

    echo "<h3>Pre-Swap Variable States:</h3>";
    echo "<table>";
    echo "<tr><td>X</td><td>Y</td></tr>";
    echo "<tr><td>" . $x . "</td>";
    echo "<td>" . $y . "</td></tr>";
    echo "</table>";

    $temp = $x;
    $x = $y;
    $y = $temp;
   echo "</div>";
   echo "</p>";
?>

<?php
    echo "<p>";
    echo "<div>";
    echo "<h3>Post-Swap Variable States:<h3>";
    
    echo "<table>";
    echo "<tr><td>X</td><td>Y</td></tr>";
    echo "<tr><td>" . $x . "</td>";
    echo "<td>" . $y . "</td></tr>";
    echo "</table>";

    echo "</div>";
    echo "</p>";
?>

</body>
</html> 