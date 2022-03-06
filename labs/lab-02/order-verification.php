<?php
    session_start();
    //print_r($_SESSION);
    require("shoe-generator.php");

    $data = $_SESSION['shoe'];
    $shoe = unserialize($data);

    $shoe = new Shoe();

    function make_title($shoe) {
        return  ($shoe->get_brand() . ' ' . $shoe->get_model() . ' Sneakers for ' . $shoe->get_price());
    }

    define("SALES_TAX_RATE", 0.10);
    //print_r($_POST);

    class Order {
        private $shoe;
        private $size;
        private $quantity;
        private $tax;
        private $total;

        public function __construct($shoe) {
            #$data = $_SESSION['shoe'];

           #$this->shoe = unserialize($data);
            $this->shoe = $shoe;
            $this->size = $_POST['size'];
            $this->quantity = $_POST['quantity'];
            $this->amount = $_POST['quantity'] * $this->shoe->get_price();
            $this->tax = $this->amount * SALES_TAX_RATE;
            $this->total = $this->amount + $this->tax;
        }

        public function get_shoe () { return $this->shoe; }
        public function get_size () { return $this->size; }
        public function get_quantity () { return $this->quantity; }
        public function get_amount () { return $this->amount; }
        public function get_tax () { return $this->tax; }
        public function get_total () { return $this->total; }

        public function __toString() {
           $string = $this->shoe->get_brand() . ' ' . $this->shoe->get_model() . ' ' . $this->size . '<br>' . PHP_EOL;
           $string .= 'quantity: ' . $this->quantity . '<br>' . PHP_EOL;
           $string .= 'amount: ' . $this->amount . '<br>' . PHP_EOL;
           $string .= 'tax: ' . $this->tax . '<br>' . PHP_EOL;
           $string .= 'total: ' . $this->total . '<br>' . PHP_EOL;

           return $string;     
        }
    } // end class Order

    $order = new Order($shoe);
    echo $order . '<br>';

    $_SESSION['order'] = NULL;

    $data = serialize($order);
    $_SESSION['order'] = $data;
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <?php
        echo '<title>Sneakers and Heels Shoe - ' . make_title($shoe) . '</title>';
    ?>
</head>

<body>   >
<header>
    <?php
        echo '<h1>Please Confirm Your Order of ' . make_title($shoe) . '</h1>';
    ?>
</header>

<main>
    <form id="order-verification-form" name="order-verification-form" method="post" action="submit-order.php">
        <?php
            echo '<p>' . $order . '</p>';
        ?>
        <input id="verify-order-button" name="verify-order-button" type="submit" value="Confirm and Submit">
    </form>
</main>
</body>
<html>