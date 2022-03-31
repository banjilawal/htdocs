<?php
    class ProteinBar {
        private $picture;
        private $name;
        description VARCHAR(100),
        grams INT NOT NULL DEFAULT 45,
        retailPrice DECIMAL (4,2) NOT NULL DEFAULT 2.59,
        surrogateID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

    } // end class ProteinBar
?>