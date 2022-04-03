<?php
    DEFINE ('MIN_STARS', 1);
    DEFINE ()
    DEFINE ('REVIEW_ID_PATTERN', '/^R-[A-Z][A-Z][A-Z]-[0-9][0-9][0-9][0-9]-[A-Z][A-Z][A-Z]-R$/i' );
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
            $this->submissionTime = new DateTime('0000-01-01');   
        }

        public function customer ($customer) {

        }



    } // end class Review

    class ReviewBag {

    } //  end class ReviewBag
?>