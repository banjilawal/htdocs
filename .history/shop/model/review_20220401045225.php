<?php
    DEFINE ('REVIEW_ID_PATTERN', '/^R-[A-Z][A-Z][A-Z]-[0-9][0-9][0-9][0-9]-[A-Z][A-Z][A-Z]-R$/i' );
    class Review {
        private $id;
        private $proteinBar;
        private $customer;
        private $stars;
        private $comments;
        private $submissionTime; 

        public function __construct() {
            $this->customer = new Customer();
            $this->proteinBar = new ProteinBar();
            $this->

            
        }

    } // end class Review

    class ReviewBag {

    } //  end class ReviewBag
?>