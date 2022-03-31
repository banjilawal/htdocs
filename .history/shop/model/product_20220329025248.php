<?php
    DE$wordPattern = '/^[A-Z]{5,}$/i';
    $namePattern = '/^[A-Z]{5,}$|^[A-Z]{5,}\s[A-Z]{5,}$/i';

    class ProteinBar {
        private $id;
        private $picture;
        private $name;
        private $description;
        private $grams;
        private $retailPrice;

        public function id ($id) { 
            $this->id = $id; return $this; 
        }
        public function picture ($picture) { $this->picture = $picture; return $this; }

        public function name ($name) { 
            if (is_string($name) == false || preg_match($namePattern, $name) != 1)
            $this->name = $name; return $this; 
        }
        public function description ($description) { $this->description = $description; return $this; }
        public function grams ($grams) { $this->grams = $grams; return $this; }
        public function retailPrice ($retailPrice) { $this->retailPrice = $retailPrice; return $this; }

        public function get_id () { $this->id; }
        public function get_picture () { return $this->picture; }
        public function get_name () { return $this->name; }
        public function get_description () { return $this->description; }
        public function get_grams () { return $this->grams; }
        public function get_retailPrice () { return $this->retailPrice; }

        public function to_table () {

            $elem = '<table class="product-table" id="' . $this->id . '" name="' . $this->id . '">'
                . '<tr><td><h2>' . $this->name . ' Price: ' . $this->retailPrice . '</h2></td><tr>'
                . '<tr>'
                . '<td><img src="' . $this->picture . '" width="300" height="400"></td>'
                . '<td>' . $this->description . '</td>'
                . '<td>' . $this->grams . ' grams</td>'
                . '<td>' . $this->retailPrice . '</td>'
                . '</tr>'
                . '</table>';
    
            return $elem;
        }

        public function __toString() {
            $text = $this->id . ' ' . $this->name . ' ' . $this->picture . ' ' . $this->description . ' ' . $this->grams . ' ' . $this->retailPrice;
            return $text;
        }
    } // end class ProteinBar

    $bar = new ProteinBar();
    $bar->id('PN-XOP-226-P')->name('Bresden')->grams(84)->retailPrice(2.99);
    echo $bar->to_table() . '<p?>' .$bar . '</p>';
?>