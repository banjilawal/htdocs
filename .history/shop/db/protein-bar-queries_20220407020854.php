<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');
    #require_once (MODEL_PATH . '/review.php');
    require_once (MODEL_PATH . '/proteinBar.php');

    function proteinBar_query ($proteinBarID) {
        $mysqli = db_connect();
        $proteinBar = new ProteinBar();

        $query = 'SELECT id productID, name, description, grams, '
        . 'retailPrice, imagePath FROM shop.products WHERE id = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $proteinBarID);
        $stmt->execute();

        $stmt->bind_result($productID, $name, $description, $grams, $retailPrice, $imagePath);

        while ($stmt->fetch()) {
            $proteinBar = new ProteinBar();
            $proteinBar->id($proteinBarID);
            $proteinBar->name($name)->grams($grams);
            $proteinBar->description($description)->retailPrice($retailPrice); 
        }
        $mysqli->close();

        $bag = protein_bar_review_query($proteinBar);
        return $proteinBar;
    }

    function protein_bar_review_query ($proteinBar) {
        $mysqli = db_connect();
        $proteinBarID = $proteinBar->get_id();

        $bag = new ReviewBag();
        $bag->proteinBarID($proteinBarID);

        $query = 'SELECT c.id customerID, firstname, lastname, birthdate, email, phone, street, city, '
            . 'state, zip, r.id reviewID, r.stars, r.comments, r.timestamp, p.id productID, name, description, grams, '
            . 'retailPrice FROM shop.products p INNER JOIN shop.product_reviews r INNER JOIN shop.customers c '
             .'ON r.customerID = c.id ON p.id = r.productID WHERE p.id = ?';

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $proteinBarID);
        $stmt->execute();

        $stmt->bind_result(
            $customerID, $firstname, $lastname, $birthdate, $email, $mobile, $street, 
            $city, $state, $zip, $reviewID, $stars, $comments, $timestamp
        );

        while ($stmt->fetch()) {
            $phone = new Phone ();
            $phone->string_to_phone($mobile);
    
            $address = new PostalAddress();
            $address->zip($zip)->state($state)->city($city)->street($street);

            $customer = new Customer();
            $customer->id($customerID);
            $customer->address($address)->phone($phone);
            $customer->birthdate((new DateTime($birthdate)));
            $customer->firstname($firstname)->lastname($lastname)->email($email);

            $review = new Review();
            $review->customer($customer);
            $review->id($reviewID)->stars($stars);
            $review->comments($comments)->timestamp($timestamp);

            $proteinBar->get_reviews()->add($review);
            $bag->add($review);
        }
        $mysqli->close();
        return $bag;
    }
?>