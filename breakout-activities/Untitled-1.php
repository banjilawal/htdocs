<html>
<body>

<form action="exercise.php" method="post">
First Integer: <input type="int" name="x"><br>
Second Integer: <input type="int" name="y"><br>
<input type="submit">
</form>

<?php
echo "Before Swap:";
?>
<br>
<?php
$x = $_POST['x'];
echo $x;
?>
<br>
<?php
$y = $_POST['y'];
echo $y;
?>
<br>
<br>
<?php
$temp = $x;
$x = $y;
$y = $temp;
echo "After Swap:";
?>
<br>
<?php
echo $x;
?>
<br>
<?php
echo $y;
?>

</body>
</html>
