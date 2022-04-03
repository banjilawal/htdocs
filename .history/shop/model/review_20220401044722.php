<?php
    DEFINE ('REVIEW_ID_PATTERN', '/^R-[A-Z][A-Z][A-Z]-[0-9][0-9][0-9][0-9]-[A-Z][A-Z][A-Z]-R$/i' );
    class Review {
        private $id;
        private $item;
        private $customerID CHAR(12) NOT NULL,
            stars INT NOT NULL,
            comments VARCHAR(500),
            surrogateID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            submissionDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            
            # unique constraints
            CONSTRAINT review_id_uq UNIQUE (id),
            CONSTRAINT duplicate_review_ck UNIQUE (productID, customerID),
            
            # check constraints
            CONSTRAINT review_stars_ck CHECK (stars BETWEEN 1 AND 5),
            CONSTRAINT review_id_ck CHECK (id REGEXP ''),
            
            # foreign keys constraints
            CONSTRAINT review_fk_product FOREIGN KEY (productID) REFERENCES shop.products(id),
            CONSTRAINT review_fk_customer FOREIGN KEY (customerID) REFERENCES shop.customers(id)

    } // end class Review

    class ReviewBag {

    } //  end class ReviewBag
?>