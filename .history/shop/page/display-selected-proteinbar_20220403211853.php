<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/proteinBar.php');
    require_once ('../model/orderItem.php');

    #$cart = new OrderItemBag ();
    #$orderItem = new OrderItem();
    $proteinBar = new ProteinBar();
    $proteinBarBag = new ProteinBarBag();

    echo print_r($_COOKIE);

    #$index = $_COOKIE[];
    
    #$proteinBarBag = unserialize($_SESSION['proteinBars']);
   
    /*
    $mysqli = db_connect();
    $result = $mysqli->query("SELECT id, name, description, grams, retailPrice FROM shop.products WHERE id = ;");

    while($row = $result->fetch_assoc()) {
        $bar = (new ProteinBar())->id($row['id'])->name($row['name'])->grams($row['grams']);
        $bar->description($row['description'])->retailPrice($row['retailPrice']); 

        $proteinBars->add($bar);
        #echo $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] . ', '.  $row['grams'] . ', ' .  $row['retailPrice'] . '<br>';
    }

    $result->free();
    $mysqli->close();
    */

    //print_r($_SESSION);


/*
    $_SESSION['shoe'] = NULL;
    $_SESSION['shoe'] = serialize($shoe);
    $title = $shoe->get_name() .  ' Sneakers at ' . $shoe->report_price();

    function make_html_selector($sizes) {
        $elem = '<label for="shoe-size-selector">Pick your shoe size</label>';
        $elem .= '<select id="size" name="size" form="shoe-order-form">';
        $elem .= '<option value="">Available Sizes</option>';

        foreach ($sizes as $size) {
            $elem .= '<option value="' . $size . '">' . $size . '</option>';
        }
        $elem .= '</select>';
        return $elem;
    }
*/    
?>
