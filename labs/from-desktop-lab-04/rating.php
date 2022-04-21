<?php
    include("generator.php");
    $title = 'Rating Library';

    define ('MIN_RATING', 1);
    define ('MAX_RATING', 5);

    class Rating {
        private $shoe;
        private $rating;
        private $comment;

        public function __construct($shoe, $rating) {
            $this->shoe = $shoe;
            $this->rating = $rating;
            $this->comment = NULL;
        }

        public function set_rating ($number) { $this->rating = $number; }

        public function set_comment ($comment) { 
            $this->comment = $this->filter($comment); 
        }

        public function get_rating () { return $this->rating; }
        public function get_comment () { return $this->comment; }
        public function get_shoe () { return $this->shoe; }

        private function filter ($comment) {
            $search = array('ghastly', 'repulsive', 'appalling', 'horrendous');
            return (str_replace($search, 'bad', $comment));
        }

        public function to_table () {
            $elem = '<table><thead>'
                . '<tr><td>Shoe</td><td>Rating</td><td>Comment</td>'
                . '</tr></thead>'
                . '<tr>'
                . '<td>'
                    . $this->shoe->get_name() 
                    . ' Price: ' . $this->shoe->get_price() . '<p></p>'
                    . $this->shoe->load_image() 
                . '</td>'
                . '<td>' . $this->rating . '</td>'
                . '<td>' . $this->comment . '</td>'
                . '</tr>'
                . '</table>';

            return $elem;        
        }

        public function __toString() {
            $string = $this->shoe . ' Rating: ' . $this->rating
                . ' Comments: ( ' . $this->comment . ' )';

            return $string;
        }

    } // end Rating class
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $title ?></title>
</head>

<body>   
</body>
<html>