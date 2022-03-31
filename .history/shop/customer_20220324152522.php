<?php
    //require_once('creditcard.php');  

use CreditCard as GlobalCreditCard;

    class CreditCard {
        private $number;
        private $expiration;
        private $securityCode; 
        
        public function __construct($number, $date, $code) {
            $this->number = $number;
            $this->expiration = $date;
            $this->securityCode = $code;
        }

        public function get_number () { return $this->number; }
        public function get_expiration () { return $this->expiration; }
        public function get_security_code () { return $this->securityCode; }

        public function set_number ($number) { $this->number = $number; }
        public function set_expiration ($date) { $this->expiration = $date; }
        public function set_security_code ($numericStr) { $this->securityCode = $$numericStr; }

        public function __toString() {
            return 'number: ' . $this->number . ', expiration: ' . $this->expiration . ', security code: ' . $this->securityCode;
        }
    } // end CreditCard class

    $card = new CreditCard('1234-5040-8553', getdate(), '909');
    echo $card;
    
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
        private $card;

        public function __construct($firstname, $lastName, $birthdate, $phone, $email, $street, $city, $state, $zip) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->birthdate = $birthdate;
            $this->phone = $phone;
            $this->email = $email;
            $this->street = $street;
            $this->city = $city;
            $this->state = $state;
            $this->zip = $zip;
        }

        public function get_firstname () { return $this->firstname; }
        public function get_lastname () { return $this->lastname; }
        public function get_birthdate () { return $this->birthdate; }
        public function get_phone () { return $this->phone; }
        public function get_email () { return $this->email; }
        public function get_street () { return $this->street; }
        public function get_city () { return $this->city; }
        public function get_state () { return $this->state; }
        public function get_zip () { return $this->zip; }
        public function get_card () { return $this->card; }
        
        public function set_firstname ($name) { $this->firstname = $name; }
        public function set_lastname ($name) { $this->lastname = $name; }
        public function set_birthdate ($date) { $this->birthdate = $date; }
        public function set_phone ($phone) { $this->phone = $phone; }
        public function set_email ($email) {  $this->email = $email; }
        public function set_street ($street) { $this->street = $street; }
        public function set_city ($city) { $this->city = $city; }
        public function set_state ($state) { $this->state = $state; }
        public function set_zip ($zip) { $this->zip = $zip; }
        public function set_card ($card) { $this->card = $card; }

        public functi

        public function __toString() {
           $string = 'firstname: ' . $this->firstname . '<br>' . PHP_EOL;
           $string .= 'lastname: ' . $this->lastname . '<br>' . PHP_EOL;
           $string .= 'birthdate: ' . $this->birthdate . '<br>' . PHP_EOL;
           $string .= 'phone: ' . $this->phone . '<br>' . PHP_EOL;
           $string .= 'email: ' . $this->email . '<br>' . PHP_EOL;
           $string .= 'street: ' . $this->tax . '<br>' . PHP_EOL;
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
    } // end class CUstomer

?>

</head>

<body>

</body>
<html>