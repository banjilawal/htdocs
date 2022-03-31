<?php
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

        public 
    } // end CreditCard class

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