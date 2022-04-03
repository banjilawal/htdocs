<?php
    require_once ('../global-defs.php');

    define ('ZIP_CODE_PATTERN', '/^[0-9]{5}$/');

    define ('STREET_ADJECTIVES', array('ave', 'avenue', 'street', 'st', 'route', 'rt', 'plaza', 'pl',
        'lane', 'ln', 'road', 'rd', 'highway', 'hwy', 'po box', 'p.o. box'));
    define ('STATES', array('AL','AK','AZ','AR','CA','CO','CT','DE','FL','GA','HI','ID', 'IL','IN','IA',        
        'KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND',
        'OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY','AS','DC','FM',
        'GU','MH','MP','PW','PR','VI'));
        
    class PostalAddress {
        private $street;
        private $city;
        private $state;
        private $zip;   
        
        public function street ($street) {
            $this->street = $street;
            return $this;
        }
        
        public function city ($city) {
            $this->city = $city;
            return $this;
        }

        public function state ($state) {
            if (in_array($state, STATES, $strict = true) == false) {
                throw new Exception($state . " is not a valid state acronym");
            }
            $this->state = $state;
            return $this;
        }
        
        public function zip ($zip) {
            if (preg_match(ZIP_CODE_PATTERN, $zip) != 1) {
                throw ($zip . " is not a valid zip code");
            }
            $this->zip = $zip;
            return $this;
        }  
 
        public function get_street () { return $this->street; }
        public function get_city () { return $this->city; }
        public function get_state () { return $this->state; }
        public function get_zip () { return $this->zip; }
        public function get_card () { return $this->card; }

        public function string_toAddress ($string) {
            $array = e
        }

        public function __toString () {
            return ($this->street . ' ' . $this->city . ', ' . $this->state . ' ' . $this->zip); 
        }

        public function to_table () {

            $elem = '<table class="address-table">'
            . '<thead class="address-table-head>'
            . '<tr class="address-table-header-row">'
            .   '<th>Street</th>'
            .   '<th>City</th>'
            .   '<th>State</th>'
            .   '<th>Zip</th>'
            .   '</tr>'
            . '</thead>'
            . '<tbody>'
            . '<tr>'
            . '<td>' . $this->street . '</td>'
            . '<td>' . $this->city . '</td>'
            . '<td>' . $this->state . '</td>'
            . '<td>' . $this->zip . '</td>'
            . '</tr>'
            . '</tbody>'
            . '</table>';

            return $elem; 
        }

    } // end class StreetAddress
/*
    $address = new PostalAddress();
    $address->street('250 Turners Crossroad South')->city('Golden Valley')->state('MN')->zip('55416');
    echo $address; # . '<br>' .  gettype($address) . '<br>' . get_class($address);

    echo '<p>' . $address->to_table();
*/
?>