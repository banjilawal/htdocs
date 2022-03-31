<?php
    require_once('product.php');

    class Order {
        private $id;
        private $customerID;
        private $submissionDate;
        private $estimatedDeliveryDate;
        private $actualDeliveryDate;
        private $amount;
        private $tax;
        private $total;
        private $status;


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
?>