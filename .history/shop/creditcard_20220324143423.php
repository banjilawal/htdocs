<?php
    class CreditCard {
        private $number;
        private $expirationDate;
        private $securityCode; 
        
        public function __construct($number, $date, $code) {
            $this->number = $number;
            $this->expirationDate = $date;
            $this->securityCode = $code;
        }

        public function get_number () { return $this->number; }
        public function get_expiration_date () { return $this->expirationDate; }
        public function get_security_code () { return $this->securityCode; }

        public function set
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