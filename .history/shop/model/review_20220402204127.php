<?php
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

        public function proteinBar ($item) {
            if (is_null($item) == true) {
                throw new Exception("cannot review a null item");
            }
            if (get_class($item) != 'ProteinBar') { #get_class(new ProteinBar ())) {
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
            }
        }

        public function submission_time ($timestamp) { 
            IF (get_class($timestamp) != 'DateTime') {
                throw new Exception("not a valid DateTime");
            }
            $this->submissionTime = $timestamp; 
            return $this;
        } // close submission_date

        public function get_customer () { return $this->customer; }
        public function get_proteinBar () { return $this->proteinBar; }
        public function get_comments () { return $this->comments; }
        public function get_submissionTime () { return $this->submissionTime; }

        public function to_row () {
            $elem = '<tr id=">' .$this->id . '" onclick="send(this)">'
                    . '<td>' . $this->stars . '</td>'
                    . '<td>' . $this->proteinBar->get_name() . '</td>'
                    . '<td>' . $this->bar->get_retailPrice() . '</td>'
                    . '<td>' . $this->customer->get_firstname() . ' ' . $this->customer->get_lastname() . '</td>'
                    . '<td>' . $this->submissionTime->format('Y-m-d hh:mm:ss') . '</td>'
                . '</tr>';

            return $elem;        
        }

        public function to_table () {
            $elem = '<table>'
                . '<thead>'
                    . '<tr>'
                        . '<th>Stars</th>' 
                        . '<th>Protein Bar</th>'
                        . '<th>Price</th>'
                        . '<th>Reviewer</th>'
                        . '<th>Review Date</th>'
                        . '<th>Comment</th>'
                    . '</tr>'
                . '</thead>'
                . '<tbody>'
                . '<tr>'
                . '<td>' . $this->stars . '</td>'
                . '<td>' . $this->proteinBar->get_name() . '</t'
                    . ' Price: ' . $this->proteinBar->get_retailPrice() . '<p></p>'
                . '</td>'
                . '<td>' 
                    . $this->customer->get_firstname() . ' ' . substr($this->customer->get_lastname(), 1, 1)
                    . ' Reviewed on ' . $this->submissionTime->format('Y-m-d hh:mm:ss')

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


    } // end class Review
    $review = (new Review())->id('R-JWP-4742-HQD-R');
    $review->proteinBar($proteinBar)->customer($customer);
    $review->stars(4)->submission_time(new DateTime('2020-12-05 12:45:13')); #, 'PN-XGO-654-T', 'CN-82-GOV-Y5', '4', NULL, '3', 


    echo $review . '<p></p>' . $review->to_table();

    class ReviewBag {

    } //  end class ReviewBag
?>