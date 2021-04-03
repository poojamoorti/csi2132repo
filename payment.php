<!DOCTYPE html>
<html>
    <body>
    
    
    </body>

    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <link href="./style.css" type="text/css" rel="stylesheet">
        <script src="script.js"></script>
    </head> 


    <h2 class='titlecenter'>Payment</h2>

    <div class="form">
    <!-- Class=login-form is not what I'm looking for here i don't think -->
        <form id="form" name="form" class="login-form" method="POST">
            <div class="ajax">
                <input id="paymentType" name="paymentType" type="text" placeholder="Payment Type (Debit, Credit)"/>
                <input id="cardNumber" name="cardNumber" type="text" placeholder="Card Number" />

                <input id="submit" type="submit" name="submit" value="Pay Now"/> 
    
            </div>
        </form>
    
    </div>


<?php

// https://stackoverflow.com/questions/16778425/pass-variables-between-two-php-pages-without-using-a-form-or-the-url-of-page PAssing using Sessions?

    session_start();  
    // https://www.php.net/manual/en/reserved.variables.session.php


   // echo $_SESSION['bookingid'];


    if(isset($_POST['submit'])){
        $databaseConnection = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=group_a04_g35 user=user password=password");

        $paymentType = $_POST['paymentType'];
        $cardNumber = $_POST['cardNumber'];
        $bookingId = $_SESSION['bookingid']; // Send via what is show above hopefully !
        echo $bookingId;

        if($paymentType != null && $cardNumber != null){
            
            // what happens in the even this is the first payment?
            $paymentID = pg_query($databaseConnection, "SELECT max(payment_id) FROM Payment"); 
            $result = pg_fetch_array($paymentID);

            // Booking should be in form [booking_id, hotel_id, customer_id, room_id, price]
            $booking = pg_query($databaseConnection, "SELECT B.*, R.price FROM Booking B, Room R WHERE B.booking_id = $bookingId AND B.room_id = R.room_id");
            $bookingResult = pg_fetch_array($booking);
            $hotelId = $bookingResult[1];
            $customerId = $bookingResult[2];
            $roomId = $bookingResult[3];
            $price = $bookingResult[4];


            // Seems like a lot of the table is redundant? 
            $query = pg_query($databaseConnection, "INSERT INTO Payment (payment_id, booking_id, hotel_id, customer_id, room_id, amount, payment_type) VALUES (($result[0] + 1), $bookingId, $hotelId, $customerId, $roomId, $price, '$paymentType')");

            // Check and make sure this actually worked with an if?
        }

    }
?>
</html>