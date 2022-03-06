<?php
    namespace Model;
    require_once('Brand.php');

    use Exception;

    class Brands {
        private $list = array();

        public function __construct () {     
            foreach (BRAND_NAMES as $brand) {
                $this->list[] = new Brand($brand);
            }
        }

        public function members () {
            return $this->list;
        }

        public function random () {
            return $this->list[array_rand($this->list, 1)];
        }


        public function search ($name) {
            $index = 0;
            $result = NULL;

            while (is_null($result) || $index <= count($this->list)) {
                if ($this->list[$index]->get_name() == $name)
                    $result = $this->list[$index];
                $index++;
            }
        }

        public function add ($brand) {
            $name = $brand->get_name();

            if (is_null($this->search($name)) == true) {
                throw new Exception( $name . " already in the Brands collection", 1); 
                exit(5);   
            }
            $this->list[] = $brand;
        }

        public function get_discounted () {
            $list = array ();

            foreach ($this->list as $brand) {
                if ($brand->is_on_sale()) $list[] = $brand;
            }
            return $list;
        }

        public function __toString() {
            $string = '';

            foreach ($this->list as $brand) {
                $string .= $brand . '<br>' .PHP_EOL;
            }
            return $string;
        }

        public function to_table ($filter=NULL) {
            $list = array();

            if ($filter == 'discounted') {
                foreach ($this->list as $brand) {
                    if ($brand->is_on_sale() == true) {
                        $list[] = $brand;
                    }
                }
            }
            else {
                $list = $this->list;
            }

            $elem = '<table><tr>';

            foreach ($list as $item) {
                $elem .= '<td>' . $item->get_name() . '</td>';
            }
            $elem .= '</tr></table>';

            return $elem;
        }
    }
?>