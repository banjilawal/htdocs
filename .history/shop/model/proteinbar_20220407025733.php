<?php
    require_once ('../bootstrap.php');
    require_once ('customer.php');
    #require_once ('review.php');

    define ('IMAGE', '../assets/images/');
    define ('BAR_ID_PATTERN', '/PN-[A-Z][A-Z][A-Z]-[2-9][2-9][2-9]-[P-Z]/i');

    function random_image_path () {
        $files = array_diff(scandir(IMAGE), array('.','..'));
        $path = trim((IMAGE . $files[array_rand($files,1)]), " ");

        return $path;
    } // close randomImagePath;
   # echo random_image_path();
   # echo  '<img src="' . random_image_path() . '" width="300" height="400">';

    class ProteinBar {
        private $id;
        private $name;
        private $stars;
        private $reviews;
        private $imagePath;
        private $description;
        private $grams;
        private $retailPrice;


        public function __construct() {
            $this->id = null;
            $this->name = null;
            $this->imagePath = random_image_path();
            $this->description = null;
            $this->grams = 0;
            $this->stars = 0; 
            $this->retailPrice = 0.00;
            $this->reviews = new ReviewBag();      
        }

        public function id ($id) { 
            if (is_string($id) == false || preg_match(BAR_ID_PATTERN, $id) != 1) {
                throw new Exception($id . " is not a valid bar id");
            }
            $this->id = $id; 
            return $this; 
        }
        public function imagePath ($path) { 
            $this->imagePath = $path; 
            return $this; 
        }

        public function name ($name) { 
            if (is_string($name) == false || preg_match(NAME_PATTERN, $name) != 1) {
                throw new Exception($name . " is not a valid protein ba name");
            }
            $this->name = $name; 
            return $this; 
        }

        public function description ($description) { 
            $this->description = $description; 
            return $this; 
        }

        public function grams ($grams) { 
            if ($grams < MIN_GRAMS || $grams > MAX_GRAMS) {
                throw new Exception($grams ." is outside the protein bar mass range");
            }
            $this->grams = $grams; 
            return $this; 
        }

        public function retailPrice ($price) { 
            if ($price < LOWEST_PRICE || $price > HIGHEST_PRICE) {
                throw new Exception($price . "is outside the acceptable retailprice range");
            }
            $this->retailPrice = $price; 
            return $this; 
        }

        public function stars ($average) { 
            if ($average < 0 || $average > 5) {
                throw new Exception($average . "is outside the range of possible star values");
            }
            $this->averageStars = $average; 
            return $this; 
        }

        function same ($obj) {
            if (get_class($obj) != 'ProteinBar') {
                return false;
            }

            $result = false;
            $bar = new ProteinBar();
            $bar = $obj;

            if ($this->id == $bar->get_id() || $this->name == $bar->get_name())
                $result = true;
            return $result;
        }

        public function add ($review) {
            if (get_class($review) != 'Review') {
                throw new Exception("Invalid class parameter for ReviewBag->add()");
            }
            $this->reviews->add($review);
            return $this;
        }

        public function load_image() {
            return ('<img src="' . $this->imagePath . '" width="300" height="400">');
        }

        public function to_row () {
            $elem = '<tr id="' . $this->id . '" name="' . $this->id . '" onclick="send_protein_bar(this)">'
                . '<td hidden>' . $this->id . '</td>'
                . '<td><img src="' . $this->imagePath . '" width="300" height="400"></td>'
                . '<td>' . $this->name . '</td>'  
                . '<td>' . $this->stars . '</td>'      
                . '<td>' . $this->description . '</td>'
                . '<td>' . $this->grams . '</td>'
                . '<td>' . $this->retailPrice . '</td>'
                . '</tr>';
            return $elem;    
        }

        public function to_table () {
            $elem = '<table class=>'
            . '<thead>'
                    . '<tr>'
                        . '<th>Picture</th>'
                        . '<th>Name</th>'
                        . '<th>Stars</th>'
                        . '<th>Description</th>'
                        . '<th>Grams</th>'
                        . '<th>Retail Price</th>'
                    . '</tr>'
                . '</thead>'  
                . '<tbody>'
                    . '<tr>'
                        . '<td><img src="' . $this->imagePath . '" width="300" height="400"></td>'
                        . '<td>' . $this->name . '</td>'      
                        . '<td>' . $this->stars . '</td>' 
                        . '<td>' . $this->description . '</td>'
                        . '<td>' . $this->grams . '</td>'
                        . '<td>' . $this->retailPrice . '</td>'
                    . '</tr>'     
                    . '</tr>'
                . '</tbody>'      
            . '</table><br>product id:' . $this->id;

            return $elem;
        }

        public function __toString() {
            $text = ' id: ' . $this->id . ' ' 
                . 'name: ' . $this->name . ' ' 
                . 'star rating: ' . $this->stars . ' '
                . 'image path: ' . $this->imagePath . ' ' 
                . 'description: ' . $this->description . ' ' 
                . 'grams: ' . $this->grams . ' ' 
                . 'retail price: ' . $this->retailPrice;

            return $text;
        }

        public function get_id () { return $this->id; }
        public function get_name () { return $this->name; }
        public function get_grams () { return $this->grams; }
        public function get_reviews 
        public function get_imagePath () { return $this->imagePath; }
        public function get_description () { return $this->description; }
        public function get_retailPrice () { return $this->retailPrice; }
        public function get_stars () { return $this->stars; }

    } // end class ProteinBar



    #echo $proteinBar;
    #echo $bar->to_table() . '<p>' .$bar . '</p>';
    #echo $bar->to_table();

    class ProteinBarBag {
        private $list = array();

        public function get_list () { return $this->list; }

        public function add ($item) {
            if (get_class($item) != 'ProteinBar') {
                throw new Exception("Not a valid class member for ProteinBar collector");
            }
            if (array_key_exists($item->get_id(), $this->list) == true) {
                throw new Exception ($item->get_id() . " is already listed");
            } 

            $id = $item->get_id();     
            $this->list[$id] = $item;
        }


        public function __toString() {
            $string = 'ProteinBarBag Contents' . '<br>' . PHP_EOL;

            foreach ($this->list as $id => $proteinBar) { $string  .= $this->list[$id] . '<br>' . PHP_EOL; }
            return $string;
        } // close toString

        public function to_table () {
    
            $elem = '<table class="table" id="protein-bars-table" name="protein-bars-table">'
            . '<thead>'
                    . '<tr>'
                        . '<th hidden>ID</th>'
                        . '<th>Picture</th>'
                        . '<th>Name</th>'
                        . '<th>Stars</th>'
                        . '<th>Description</th>'
                        . '<th>Grams</th>'
                        . '<th>Retail Price</th>'
                    . '</tr>'
                . '</thead>'
                . '<tbody class="table-body">';
    
                foreach ($this->list as $id => $proteinBar) {
                   $elem .= $this->list[$id]->to_row();
                } 

                $elem .= '<tbody></table>';
                return $elem;
            }

    } // end class ProteinBars
/*
    $bag = new ProteinBarBag();

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-XOP-226-P')->name('Bresden')->grams(84)->retailPrice(2.99);
    $proteinBar->description('blade rst,chuck,ln and fat,1/8 inchfat,beef,sel,raw, hot cocoa,choc bev,homemade,milk');
    $bag->add($proteinBar);

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-XPF-327-P')->name('Rochberg')->grams(95)->retailPrice(1.99);
    $proteinBar->description('thigh,broilers or fryers,meat and skn,ckd,chicken,stwd, crackers (made with whl grain),cheez-it,suns');
    $bag->add($proteinBar);

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-OBV-267-W')->name('Fleisher')->grams(48)->retailPrice(2.99);
    $proteinBar->description('oat bran,bagels, sauce,canned,w/onions,tomato products, unpr,frz,kashi three cheese ravioli with med');
    $bag->add($proteinBar);

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-SBO-248-P')->name('Saraban')->grams(95)->retailPrice(1.99);
    $proteinBar->description('m and ms crispy choc c and ies,mars snackfood us,c and ies, apl),grp,ocean spry,w/vit c,ruby red grp',);
    $bag->add($proteinBar);

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-WLD-657-W')->name('Symphonists')->grams(48)->retailPrice(2.99);
    $proteinBar->description('minis multigrain crackers,club,keebler, frozen,lasagna with meat and sauce, loin,frsh,country-style');
    $bag->add($proteinBar);

    $proteinBar = new ProteinBar();
    $proteinBar->id('PN-JIK-382-X')->name('Nyffenegger')->grams(94)->retailPrice(1.99);
    $proteinBar->description('mature seeds,navy,ckd,bld,beans,w/salt, unckd,dehyd (low-moisture),prunes, creme filling,choc sndwch');
    $bag->add($proteinBar);
*/
    #echo $bag .  '<p></p>';
    #echo $bag->to_table() . '<p></p>';

    DEFINE ('MIN_STARS', 1);
    DEFINE ('MAX_STARS', 5);

    DEFINE ('REVIEW_ID_PATTERN', '/R-[A-Z]{3}-[0-9]{4}-[A-Z]{3}-R/i' );
    class Review {
        private $id;
        private $proteinBar;
        private $customer;
        private $stars;
        private $comments;
        private $timestamp; 

        public function __construct() {
            $this->stars = 0;
            $this->comments = null;
            $this->customer = new Customer();
            $this->proteinBar = new ProteinBar();
            $this->timestamp = new DateTime('0000-01-01 00:00:00.00');   
        }

        public function id ($id) { 
            if (preg_match(REVIEW_ID_PATTERN, $id) != 1) {
                throw new Exception("reviewID format exception");
            }
            $this->id = $id; 
            return $this; 
        } // close id

        public function customer ($customer) { 
            if (get_class($customer) != 'Customer') {
                throw new Exception("not a customer object");
            }
            $this->customer = $customer; 
            return $this; 
        } // close customer

        public function proteinBar ($item) {
            if (is_null($item) == true) {
                throw new Exception("cannot review a null item");
            }
            if (get_class($item) != 'ProteinBar') { 
                throw new Exception("this is not a valid ProteinBar object");
            }
            $this->proteinBar = $item;
            return $this;
        }

        public function stars ($number) {
            if ($number < 1 || $number > 5) {
                throw new Exception("number is outside the star range");
            }
            $this->stars = $number;
            return $this;
        }

        public function comments ($text) {   
            if (is_null($text) == true) {
                return $this;
            }

            if (is_null($text) == false && is_string($text) == false) {
                throw new Exception("comment text can only be letters and spaces");
            }
                $this->comments = $text;
                return $this;

        }

        public function timestamp ($timestamp) { 
            IF (get_class($timestamp) != 'DateTime') {
                throw new Exception("not a valid DateTime");
            }
            $this->timestamp = $timestamp; 
            return $this;
        } // close submission_date

        public function to_row () {
            $elem = '<tr id=">' .$this->id . '" onclick="send_review(this)">'
                    . '<td>' . $this->stars . '</td>'
                    . '<td><img src="' . $this->proteinBar->get_imagePath() . '" width="300" height="400"></td>'
                    . '<td>' . $this->proteinBar->get_name() . '</td>'
                    . '<td>' . $this->proteinBar->get_description() . '</td>'
                    . '<td>' . $this->proteinBar->get_grams() . '</td>'
                    . '<td>' . $this->proteinBar->get_retailPrice() . '</td>'
                    . '<td>' . $this->customer->get_firstname() . ' ' . substr($this->customer->get_lastname(), 1, 1) . '</td>'
                    . '<td>' . $this->timestamp->format('Y-m-d hh:mm:ss') . '</td>'
                . '</tr>';

            return $elem;        
        }

        public function to_table () {
            $elem = '<table>'
                    . '<thead>'
                        . '<tr>'
                            . '<th>Stars</th>' 
                            . '<th>Picture</th>'
                            . '<th>ProteinBar Name</th>'
                            . '<th>Description</th>'
                            . '<th>Grams</th>'
                            . '<th>Retail Price</th>'
                            . '<th>Reviewer</th>'
                            . '<th>Date of Review</th>'
                            . '<th>Comments</th>'
                        . '</tr>'
                    . '</thead>'
                    . '<tbody>'
                        . '<tr>'
                            . '<td>' . $this->stars . '</td>'
                            . '<td><img src="' . $this->proteinBar->get_imagePath() . '" width="300" height="400"></td>'
                            . '<td>' . $this->proteinBar->get_name() . '</td>'
                            . '<td>' . $this->proteinBar->get_description() . '</td>'
                            . '<td>' . $this->proteinBar->get_grams() . '</td>'
                            . '<td>' . $this->proteinBar->get_retailPrice() . '</td>'
                            . '<td>' . $this->customer->get_firstname() . ' ' . substr($this->customer->get_lastname(), 1, 1) . '</td>'
                            . '<td>' . $this->timestamp->format('Y-m-d hh:mm:ss') . '</td>'
                            . '<td>' . $this->comments . '</td>'
                        . '</tr>'
                    . '<tbody>'
                . '</table>';

            return $elem;        
        }

        public function __toString() {
            $string = $this->proteinBar->get_name() . ' Rating: ' . $this->stars 
                . ' Comments: ( ' . $this->comments . ' )';

            return $string;
        }

        public function get_customer () { return $this->customer; }
        public function get_proteinBar () { return $this->proteinBar; }
        public function get_comments () { return $this->comments; }
        public function get_timestamp () { return $this->timestamp; }

        public function get_protein_bar_name () { return $this->proteinBar->get_name(); }
        public function get_image_path () { return $this->proteinBar->get_imagePath(); }

        public function get_customer_name () { 
            return ($this->customer->get_firstname() . ' ' . $this->customer->get_lastname()); 
        }
  
    } // end class Review
    /*
    $review = (new Review())->id('R-JWP-4742-HQD-R');
    $review->proteinBar($proteinBar)->customer($customer);
    $review->stars(4)->timestamp(new DateTime('2020-12-05 12:45:13')); #, 'PN-XGO-654-T', 'CN-82-GOV-Y5', '4', NULL, '3', 


    echo $review . '<p></p>' . $review->to_table();
*/
    class ReviewBag {
        private $list = array();
        private $customerID;
        private $proteinBarID;
        

        public function proteinBarID ($id) { 
            if (is_string($id) == false || preg_match(BAR_ID_PATTERN, $id) != 1) {
                throw new Exception($id . " is not a valid bar id");
            }

            if (is_null($this->customerID) == false) {
                throw new Exception("The ReviewBag is designated to a customer");
            }

            $this->proteinBarID = $id; 
            return $this; 
        }

        public function customerID ($id) { 
            if (preg_match(CUSTOMER_ID_PATTERN, $id) != 1) {
                throw new Exception("Not valid customer ID");
            }

            if (is_null($this->proteinBarID) == false) {
                throw new Exception("The ReviewBag is designated to a proteinBar");
            }

            $this->customerID = $id;
            return $this; 
        } 
        

        public function add ($review) {
            if (get_class($review) != 'Review') {
                throw new Exception("Invalid class parameter for ReviewBag->add()");
            }

            $reviewCustomerID = $review->get_customer()->get_id();
            $reviewProductID = $review->get_proteinBar()->get_id(); 
            $reviewID = $review->get_id();

            if (is_null($this->customerID) && strcmp($this->proteinBarID, $reviewProductID) != 0) {
                throw new Exception("Incorrect prodcut for collection by proteinBar");
            }

            if (is_null($this->proteinBarID) && strcmp($this->customerID, $reviewCustomerID) != 0) {
                throw new Exception("Incorrect prodcut for collection by proteinBar");
            }

            if (array_key_exists($reviewID, $this->list) == true) {
                throw new Exception("The review is already in the bag");
            }

            $this->list[$reviewID] = $review;
        }

         public function __toString() {
            $string = 'Reviews<br>';

            foreach ($this->list as $id => $review) { $string  .= $review . '<br>' . PHP_EOL; }
            return $string;
        } 

        public function to_table () {
            if (is_null($this->proteinBarID) == false) {
                $heading = '<th>Customer</th>';
            }
            else if (is_null($this->customerID) == false) {
                $heading = '<th>ProteinBar</th>';
            }
            else {
                throw new Exception("ReviewBag categorization outside allowed range");
            }


            $elem = '<table class>'
                . '<thead>'
                    . '<tr>'
                        . '<th>Picture</th>'
                        . '<th>Name</th>'
                        . '<th>Description</th>'
                        . '<th>Grams</th>'
                        . '<th>Retail Price</th>'
                        . '<th>Quantity</th>'
                        . '<th>Cost</th>'
                    . '</tr>'  
                . '</thead>'
                . '<tbody>';

                    if (is_null($this->customerID) == false) {
                        foreach ($this->list as $id => $review) {
                            $elem = '<tr id=">' .$id . '" onclick="send_review(this)">'
                                . '<td>' . $this->stars . '</td>'
                                . '<td><img src="' . $this->list[$id]->get_image_path() . '" width="150" height="250"></td>'
                                . '<td>' . $this->list[$id]->get_protein_bar_name() . '</td>'
                                . '<td>' . $this->list[$id]->get_timestamp()->format('Y-m-d hh:mm:ss') . '</td>'
                                . '<td>' . $this->list[$id]->get_comments() . '</td>'
                            . '</tr>';             
                        }
                    }


                    if (is_null($this->proteinBarID) == false) {
                        foreach ($this->list as $id => $review) {
                            $elem = '<tr id=">' .$id . '" onclick="send_review(this)">'
                                . '<td>' . $this->stars . '</td>'
                                . '<td>' . $this->list[$id]->get_customer_name() . '</td>'
                                . '<td>' . $this->list[$id]->get_timestamp()->format('Y-m-d hh:mm:ss') . '</td>'
                                . '<td>' . $this->list[$id]->get_comments() . '</td>'
                            . '</tr>';             
                        }
                    }
            $elem .= '</tbody></table>';
    
            return $elem;
        }

        public function get_review ($reviewID) {
            if (array_key_exists($reviewID, $this->list) == true) {
                return $this->list[$reviewID];
            }   
            else {
                return null;
            }       
        } 

        public function get_list () { return $this->list; }
        public function get_customerID () { return $this->customerID; }
        public function get_proteinBarID () { return $this->proteinBarID; } 
  
    } //  end class ReviewBag

?>