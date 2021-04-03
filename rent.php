<!DOCTYPE html>
<html>
    <body>
    
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <link href="./style.css" type="text/css" rel="stylesheet">
        <script src="script.js"></script>
    </head> 

    <h2 class='titlecenter'>Rent room</h2>


    <div class="form">
        <form id="form" name="form" class="login-form" method="POST">
            <div class="ajax">
                <input id='bookingID' name='bookingID', type="text" placeholder="Enter the room id"/>   
                <input id='submit' name='submit' type='submit' value='Rent'/>
            </div>
        </form>
    </div>


<?php
    $databaseConnection = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=group_a04_g35 user=user password=password");

    if(isset($_POST['submit'])){
        $bookingID = (int) $_POST['bookingID'];

        if($bookingID != null){
            $BookingInfo = pg_query($databaseConnection, "SELECT room_id, customer_id FROM booking WHERE booking_id = $bookingID");
            $BookingResults = pg_fetch_array($BookingInfo);
            $roomID = $BookingResults[0];
            $custID = $BookingResults[1];
            $roomInfo = pg_query($databaseConnection, "SELECT * FROM Room WHERE Room.room_id = $roomID");
            $result = pg_fetch_array($roomInfo);  
            $hotelID = $result[1];
            $capacity = $result[5];
            $price = $result[4];
            $view = $result[6];

            $query = pg_query($databaseConnection, "INSERT INTO Rent (room_id, hotel_id, customer_id, capacity, room_price, check_in, room_view) VALUES
            ($roomID, $hotelID, $custID, $capacity , $price, now(), '$view')");

            if($query){
                echo "<script type=text/javascript>alert('Room is now being rented.');</script>";
            }
            else{
                echo "<script type=text/javascript>alert('An error has occured, please try again.');</script>";
            }

        }else{
            echo "<script type=text/javascript>alert('Please enter the roomID.');</script>";
        }
    }


?>


    </body>




</html>