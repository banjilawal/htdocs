<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

        echo<title>' . $title . '</title>
</head>

<body>
    <form name="item-order-form" id="item-order-form" action="add-to-cart.php" method="post">
        <?php
            make_html_selector($bars);
        ?>
          <input type="number">
    </form>
</body>
<html>