<?php
    require_once('../bootstrap.php');
    require_once('proteinBar.php');
    require_once('customer.php');

    DEFINE ('MIN_STARS', 1);
    DEFINE ('MAX_STARS', 5);

    DEFINE ('REVIEW_ID_PATTERN', '/R-[A-Z]{3}-[0-9]{4}-[A-Z]{3}-R$/i' );
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
            $this->submissionTime = new DateTime('0000-01-01 00:00:00.00');   
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
            if (is_string($text) == false) {
                throw new Exception("comment text can only be letters and spaces");

                $this->comments = $text;
                return $this;
            }
        }

        public function timepstamp ($timestamp) { 
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
    $review = (new Review())->id('R-JWP-4742-HQD-R');
    $review->proteinBar($proteinBar)->customer($customer);
    $review->stars(4)->timestamp(new DateTime('2020-12-05 12:45:13')); #, 'PN-XGO-654-T', 'CN-82-GOV-Y5', '4', NULL, '3', 


    echo $review . '<p></p>' . $review->to_table();

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
                                . '<td>' . $this->list[$id]->get_protein_bar_name() . '</td>'
                                . '<td>' . $this->list[$id]->get_timestamp()->format('Y-m-d hh:mm:ss') . '</td>'
                                . '<td>' . $this->list[$id]->get_comments() . '</td>'
                            . '</tr>';             
                        }
                    }
            . '</tr></tbody></table>';
    
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