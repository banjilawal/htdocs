<?php
    class ProteinBar {
        private $id;
        private $picture;
        private $name;
        private $description;
        private $grams;
        private $retailPrice;

        public function id ($id) { $this->id = $id; return $this;}
        public function picture ($picture) { $this->picture = $picture; return $this;}
        public function name ($name) { $this->name = $name; return $this;}
        public function description ($description) { $this->description = $description; return $this;}
        public function grams ($grams) { $this->grams = $grams; return $this;}
        public function retailPrice ($retailPrice) { $this->retailPrice = $retailPrice; return $this;}

        public function get_id ($id) { $this->id = $id; return $this;}
        public function get_picture ($picture) { $this->picture = $picture; return $this;}
        public function get_name ($name) { $this->name = $name; return $this;}
        public function get_description () { $this->description = $description; return $this;}
        public function get_grams () { $this->grams; }
        public function get_retailPrice () { return $this->retailPrice; }
    } // end class ProteinBar
?>