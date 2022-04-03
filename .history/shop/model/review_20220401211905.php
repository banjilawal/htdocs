<?php
    require_once('protenBar.php');
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

        public function bar ($bar) {
            if (get_class($bar) != get_class(new ProteinBar)) {
                throw new Exception("this is not a valid ProteinBar object");
            }
            $this->proteinBar = $bar;
            return $this;
        }

        public function stars ($number) {
            if (is_countable($number) == false) {
                throw new Exception("Not a countable value");
            }
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
            IF (get_class($timestamp) != get_class((new DateTime()))) {
                throw new Exception("not a valid DateTime");
            }
            $this->submissionTime = $timestamp; 
            return $this;
        } // close submission_date

        public function get_customer () { return $this->customer; }
        public function get_bar () { return $this->proteinBar; }
        public function get_comments () { return $this->comments; }
        public function get_submissionTime () { return $this->submissionTime; }


        public function to_table () {
            $elem = '<table><thead>'
                . '<tr><td>Protein Bar</td><td>Rating</td><td>Comment</td>'
                . '</tr></thead>'
                . '<tr>'
                . '<td>'
                    . $this->bar->get_name() 
                    . ' Price: ' . $this->bar->get_retailPrice() . '<p></p>'
                . '</td>'
                . '<td>' 
                    . $this->customer->get_firstname() . ' ' . substr($this->customer->get_lastname(), 1, 1)
                    . ' Reviewed on ' . $this->submissionTime->format('Y-m-d hh:mm:ss')
                . '<td>' . $this->rating . '</td>'
                . '<td>' . $this->comments . '</td>'
                . '</tr>'
                . '</table>';

            return $elem;        
        }

        public function __toString() {
            $string = $this->bar->get_name() . ' Rating: ' . $this->stars
                . ' Comments: ( ' . $this->comments . ' )';

            return $string;
        }


    } // end class Review
    $review = new Review()-'R-JWP-4742-HQD-R', 'PN-XGO-654-T', 'CN-82-GOV-Y5', '4', NULL, '3', '2020-12-05 12:45:13'


    class ReviewBag {

    } //  end class ReviewBag
?>