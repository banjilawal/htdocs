<?php
    class Customer {
        private $firstname;
        private $lastname;
        private $birthdate;
        private $phone;
        private $email;
        private $street;
        private $city;
        private $state;
        private $zip;
        private $id;

        public function __construct($firstname, $lastName, $birthdate, $phone, $email, $street, $city, $state, $zip) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->birthdate = $birthdate;
            $this->phone = $phone;
            $this->email = $email;
            $this->street = $street;
            $this->city = $city;
            $this->state = $state;
            $this

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
           $string .= 'unit price: ' . $this->shoe->get_current_price() . '<br>' . PHP_EOL;
           $string .= 'quantity: ' . $this->quantity . '<br>' . PHP_EOL;
           $string .= 'amount: ' . $this->amount . '<br>' . PHP_EOL;
           $string .= 'tax: ' . $this->tax . '<br>' . PHP_EOL;
           $string .= 'total: ' . $this->total . '<br>' . PHP_EOL;

           return $string;     
        }

        public function to_table () {
            $elem = '<table><thead><tr>'
                . '<th>Shoe</th><th>Size</th><th>Quantity</th><th>Price</th>'
                . '<tbody><tr>'
                . '<td>' . $this->shoe->get_name() . '</td>'
                . '<td>' . $this->size . '</td>'
                . '<td>' . $this->quantity . '</td>'
                . '<td>' . $this->shoe->get_current_price() . '</td>'
                . '<td>' . $this->quantity . '</td>'
                . '<td>' . $this->amount . '</td>'
                . '<td>' . $this->tax . '<td>'
                . '<td>' . $this->total . '</td>'
                . '</tr></tbody></table>';

            return $elem;
        }
    } // end class Order

    $shoe = new Shoe();
    $quantity = rand(1, 9);
    $size = $shoe->get_sizes()->random();

    $order = new Order($shoe, $size, $quantity);
    $title = $order->get_shoe()->get_name() . ' Sneakers Retailing for ' . $shoe->get_current_price();
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