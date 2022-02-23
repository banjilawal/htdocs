<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<script type="text/javascript" src="script.js"></script> --> 
        
        <title>Order Processor</title>
    </head>

<!--######## Begin Body ########-->
    <body>   
        <!--######## Start Header Section ########-->
        <header>

        </header>
        <!--######## End Header Section ########-->

        <!--######## Start Nav Section ########-->
        <nav>

        </nav>
        <!--######## End Nav Section ########-->

        <!--######## Start Main Section ########-->
        <main>

        </main>
        <!--######## End Main Section ########--> 
        <?php
            // constants 
            define("MIN_ORDER_QUANTITY", 1);
            define("MAX_RDER_QUANTITY", 10);

            define("SALES_TAX_RATE", 0.10);
            define("DEFAULT_SHOE_PRICE", 19.99);
            define("DEFAULT_DELIVERY_CHARGE", 6.59);
            define("FREE_DELIVERY_ORDER_THRSHOLD", 50.00);

            define("DELIVERY_OPTIONS", ['delivery', 'pickup']);

            // variables
            $orderQuantity = 0;

            $net = 0.00;
            $tax = 0.00;
            $gross = 0.00;
            $costPrice = 0.00;   // price after discounts
            $shippingFee = 0.00;
            $invoicetotal = 0.00; // costPrice + shippingFee + tax
            $discountRate = 0.00;
            $discountAmount = 0.00;

            $firstName = $lastName = $middleInitial = $title = "";
            $streetAddress = $city = $state = $zipCode = $fullAddress = "";

            $timeStamp = new DateTime('now');
            $arrivalDate = new DateTime('now');
            
            $arrivalDate->add(new DateInterval('P5D'));

            // Validate the input posted from the form
            if (
                isset($_POST['first-name'], 
                    $_POST['last-name'], 
                    $_POST['delivery-choice'], 
                    $_POST['street-address'], 
                    $_POST['city'], 
                    $_POST['state'], 
                    $_POST['zip-code'], 
                    $_POST['shoe-pair-quantity-selector']
                )) {
                    $firstName = strval($_POST['first-name']);
                    $lastName = strval($_POST['last-name']);
                    $middleInitial = strval($_POST['middle-initial']);
        
                    $city = strval($_POST['city']);
                    $state = strval($_POST['state']);
                    $zipCode = strval($_POST['zip-code']);
                    $streetAddress = strval($_POST['street-address']);

                    $deliveryChoice = strval($_POST['delivery-choice']);
                    $orderQuantity = intval($_POST['shoe-pair-quantity-selector']);
            }
            else {
                echo 'Missing a variable throwing an error';
                exit(300);
            }

            /*----- Start Function declarations -----*/
            function getDiscountRate ($quantity) {
                
                $rate = 0.00;

                if ($quantity <= 0) {
                    //echo '>>>>getDiscountRate function report>>>: ' . $quantity . ' is not a valid order quantity';
                    exit(44);
                }
                else if ($quantity >= 2 && $quantity <= 4) {
                    $rate = 0.10;
                   // echo '>>>>getDiscountRate function report>>>: ' . 'orders of ' . $quantity . ' get a ' . ($rate * 100) . '% discount<br>';  
                    //return 0.10;
                }
                else {
                    $rate = 0.25;
                   // echo '>>>>getDiscountRate function report>>>: ' . 'Since ' . $quantity . ' pairs of shoes were ordered you get a ' . ($rate * 100) . '% discount on your order <br>';  
                   // return 0.25;
                }

                return $rate;

            } // close getDiscountRate


            function getShipping ($deliveryChoice, $orderTotal) {
                $charge = DEFAULT_DELIVERY_CHARGE;

                switch ($deliveryChoice) {
                    case 'delivery':
                        if ($orderTotal >= 50.00) {
                            $charge = 0.00;
                           // echo '>>>FROM_deliveryChoiceHHandler->>> There is no charge for deliveries over ' . (FREE_DELIVERY_ORDER_THRSHOLD - 1.00) . '<br>';
                        } 
                        break;                    
                    case 'pickup':
                        $charge = 0.00;
                        //echo '>>>FROM_deliveryChoiceHHandler->>> There ' . $charge . ' charge on orders which the customer picks up <br>';
                        break;                
                }

                return $charge;

            } // close getShipping


            function priceReporter () {
                global $discountAmount, $tax, $shippingFee, $net, $gross, $costPrice, $invoiceTotal;

                $string = "";

                if ($discountAmount > 0.00) {
                    $string = 'You saved ' . asMoney($discountAmount) . ' on the regular price of ' . asMoney($net) . '<br>';
                }

                if ($shippingFee > 0.00) {
                    $string .= 'Shipping Fee: ' . asMoney($shippingFee) . '<br>';
                }

                $string .= 'Cost: ' . asMoney($costPrice) . '<br>';
                $string .= '10% Sales Tax: ' . asMoney($tax) . '<br>';
                $string .= 'Total: ' . asMoney($invoiceTotal);

                return $string;

            } // close reportSavings

            function addressInfo () {
                global $deliveryChoice, $streetAddress, $city, $state, $zipCode;

                $address = "{$streetAddress} {$city}, {$state} {$zipCode}";
                $string = 'A notification will be sent when your order is ready for pickup.  Please bring a form of ID with your billing address of: ';
                
                if ($deliveryChoice === 'delivery') {
                    $string = 'Your order will be delivered to: ';
                }

                return ($string . $address);

            } // close addressInfo

            function estimateDelivery () {
                $string = 'Order recieved at ' . $GLOBALS['timeStamp']->format('l, Y-m-d h:i:s.n a') . '<br>';
                $string .= 'Estimated arrival is ' . $GLOBALS['arrivalDate']->format('l, Y-m-d h:i:s.n a');

                return $string;

            } // close estimateDelivery

            function makeTitle () {
                global $orderQuantity, $firstName, $lastName, $middleInitial;
                $title = 'Thank your for your order of ' . $orderQuantity . ' pairs of shoes';

                if (isset($middleInitial) && strlen($middleInitial).trim(' ') == 1 ) {
                    $title .= " {$firstName} {$middleInitial}. {$lastName}";
                }
                else {
                    $title .= " {$firstName} {$lastName}";
                }

                return $title;

            } // close makeTitle


            function asMoney ($number) {
                return (number_format($number, 2, '.', ''));

            }

            $net = $orderQuantity * DEFAULT_SHOE_PRICE;
            $discountRate = getDiscountRate($orderQuantity);
            $discountAmount = $net * $discountRate;

            $costPrice = $net - $discountAmount;

            //echo 'passing deliverychoice - ' . $deliveryChoice . ' costPrice - ' . $costPrice . ' to deliveryChoiceHandler<br>'; 
            $shippingFee = getShipping($deliveryChoice, $costPrice);

            $gross = $costPrice + $shippingFee;
            $tax = $gross * SALES_TAX_RATE;
            $invoiceTotal = $gross + $tax;

            $fullAddress = "{$streetAddress} {$city}, {$state} {$zipCode}";
            //$title = makeTitle($orderQuantity, $firstName, $lastName, $middleInitial);

            echo '<h1>' . makeTitle() . '</h1>';
            echo '<p>' . addressInfo() . '</p>';
            echo '<p>' . estimateDelivery() . '</p>';
            echo '<p>' . priceReporter() . '</p>';

            $file = "shoeorders.txt";
            $handler = fopen($file, 'a') or die('Cannot open file:  '.$file);  
      

            $outString = "$firstName $lastName, $orderQuantity shoes,  $discountAmount discounted,";
            $outString .= "$shippingFee shippingFee, $deliveryChoice, $costPrice costPrice, $tax tax, $invoiceTotal invoiceTotal,";
            $outString .= 'order recieved ' . $timeStamp->format('Y-m-d h:i:s.n a');
            $outString .= ', estimated arrival ' . $arrivalDate->format('Y-m-d h:i:s.n a') . PHP_EOL;

            fwrite($handler, $outString);
            //write some data here
            fclose($handler);



        /*
            echo '<p>The ' . htmlspecialchars($orderQuantity) . ' shoes you ordered will be ' . htmlspecialchars($deliveryChoice) . '</p>';

            echo 'Order proccesd at ' .  $timeStamp->format('l, Y-m-d h:i:s.n a') . ' Estimated arrival is ' . $arrivalDate->format('l, Y-m-d h:i:s.n a') . ' <br>';

            echo '<p>The net total: ' . asMoney($net) . '</p>';
            echo '<p>The discount rate: ' . ($discountRate * 100.00) . '% discount amount: ' . number_format($discountAmount, 2, '.', '')  . '</p>';
            echo '<p>shipping charge of ' . $shippingFee . '</p>';
            echo '<p> gross total: ' . number_format($gross, 2, '.', '') . '</p>';
            echo '<p>The tax: ' . asMoney($tax) . '</p>';
            echo '<p>The invoice total: ' . number_format($invoiceTotal, 2, '.', '') . '</p>';
            
            //echo '<p>The tax: ' . $tax . 'total: ' . $total . ' discount Amount: ' . $discountAmount . ' with a shipping charge of ' . $shippingFee . '</p>';
        */
        ?>

        <!--######## Start Footer Section ########-->   
        <footer>

        </footer>
        <!--######## End Footer Section ########-->
    </body>
<!--######## Finish Body ########-->
<html>