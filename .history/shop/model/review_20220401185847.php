<?php
    DEFINE ('MIN_STARS', 1);
    DEFINE ('MAX_STARS', 5);

    DEFINE ('REVIEW_ID_PATTERN', '/R-[A-Z]{3}-[0-9]{4}-[A-Z]{3}-R$/i' );
    class Review {
        private $id;
        private $proteinBar;
        private $customer;
        private $stars;
        private $comments;
        private $submissionTime; 

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
            if (get_class($customer) != get_class((new Customer()))) {
                throw new Exception("not a customer object");
            }
            $this->customer = $customer; 
            return $this; 
        } // close customer

        public function bar ($bar) {
            if (get_class($bar) != get_class(new ProteinBar)) {
                throw new Exception("this is not a valid ProteinBar object");
            }
            $this->proteinBar = $bar;
            return $this;
        }

        public function stars ($number) {
            if (is_countable($number) == fal)
            if ($number < 1 || $number > 5) {
                throw new Exception("number is outside the star range");
            }
            $this
        }


    } // end class Review

    class ReviewBag {

    } //  end class ReviewBag
?>