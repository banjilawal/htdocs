<?php
    require("generator.php");

    define("SALES_TAX_RATE", 0.10);

    class Order {
        private $shoe;
        private $size;
        private $quantity;
        private $tax;
        private $total;

        public function __construct($shoe, $size, $quantity) {
            $this->shoe = $shoe;
            $this->size = $size;
            $this->quantity = $quantity;
            $this->amount = $quantity * $shoe->get_price();
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
           $string = 'shoe: ' . $this->shoe->get_name() . '<br>' . PHP_EOL;
           $string .= 'size: ' . $this->size . '<br>' . PHP_EOL;
           $string .= 'unit price: ' . $this->shoe->get_price() . '<br>' . PHP_EOL;
           $string .= 'quantity: ' . $this->quantity . '<br>' . PHP_EOL;
           $string .= 'amount: ' . $this->amount . '<br>' . PHP_EOL;
           $string .= 'tax: ' . $this->tax . '<br>' . PHP_EOL;
           $string .= 'total: ' . $this->total . '<br>' . PHP_EOL;

           return $string;     
        }
    } // end class Order

    $shoe = new Shoe();
    $size = $shoe->get_sizes()->a_size();
    $order = new Order($shoe, $size, 2);
    $title = $order->get_shoe()->get_name() . ' Sneakers Retailing for ' . $shoe->get_price();
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <?php
        echo '<title>' . $title . '</title>';
    ?>
</head>

<body>

</body>
<html>