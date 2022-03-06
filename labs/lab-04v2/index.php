<?php
    use Model\Shoe\Shoes;
    //use Model\Shoe\Brands;

    session_start();
    require('model/shoes.php');

    $brands = new Model\Shoe\Brands();
    $shoes = new Model\Shoe\Shoes();

    $_SESSION['shoe'] = NULL;
    $_SESSION['shoes'] = serialize($shoes);
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Welcome to Sneakers and Heels</title>
</head>

<body>   
<header>
    <h1 class="h1">Welcome to Sneakers and Heels</h1>
</header>

<nav>
    <ul>
        <li>About</li>
        <li>Your Previous Orders</li>
        <lil>
    </ul>
    <?php
        echo $brands->to_table('discounted');
    ?>
    <h2>Sorted Display</h2>
    <form id="sort-form" name="sort-form" method="get" action="sort-handler.php">
        <select id="sort-order" name="sort-order">
            <option value="">-- Choose the order of shoes --</option>
            <option value="descending">Highest to	Lowest</option>
            <option value="ascending">Lowest to	Highest</option>
        </select>
        <br>
        <input type="submit" id="sort-form-submit" name="sort-form-submit" value="Sort Shoes">
    </form>
    <p></p>
</nav>

<main>
<?php
    echo $shoes->to_table();
?>

<script>
    function send (row) {
        data = row.childNodes[0];
        cell = row.cells[0];
        cookie = document.cookie = "array-index=" + cell.innerHTML; // + "; max-age=5";

        location.href = "view/shoe.php";
    }
</script>
</main>

</body>
<html>