<?php
    //namespace Model;
    require_once('../functions.php');

    use Exception;

    //Brands need their own class becuase it's easier to show if they are havinng a sale
    // or we can incorporate their logos in the site.
    class Brand {
        private $name;
        private $onSale;
        private $discountRate;

        public function __construct ($name) {
            $this->name = $name;

            if (rand(0, 99) > 75) {
                $this->onSale = true;
                $this->discountRate = SALE_BRANDS_DISCOUNT_RATE; 
            }
            else {
                $this->onSale = false;
                $this->discountRate = 0.00;
            }
        } // close constructor

        public function get_name () { return $this->name; }
        public function is_on_sale () { return $this->onSale; }
        public function get_discount_rate () { return $this->discountRate; }

        // The name mu
        public function set_name ($name) { $this->name = $name; }


        public function put_on_sale ($bool) { 
            if (!is_bool($bool)) {
                throw new Exception('invalid ' . gettype($bool) . ' parameter passed to method', 1);
                //var_dump(debug_backtrace());
                print_r(debug_backtrace());
                exit(22);          
            }
            $this->onSale = $bool; 

            if ($bool == true)
                $this->discountRate = SALE_BRANDS_DISCOUNT_RATE;
            else 
                $this->discountRate = 0.00;
        }

        public function set_discount_rate ($ratio) { 
            if ($this->onSale == false) {
                throw new Exception("The brand is not on sale.  It cannot be discounted", 1);
                var_dump(debug_backtrace());
                exit(1);
            }

            if ($ratio <  0.00 || $ratio > SALE_BRANDS_DISCOUNT_RATE) {
                throw new Exception("discount rate out of range", 1);
                
            }
            $this->discountRate = $ratio; 
        }

        public function __toString() {
           $string = '[ Brand Name: ' . $this->name;
           
           if ($this->onSale && $this->discountRate > 0.00)
               $string .= ', Percent Discount: ' . round(($this->discountRate * 100.00), 2);

           $string .= ' ]';
           return $string;
        }         
    } // end class Brand

    $brand = new Brand(random_brand());
    $brand->put_on_sale(true);
    ?>