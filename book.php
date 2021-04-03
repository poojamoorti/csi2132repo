<!DOCTYPE html>
    <html>

    <head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="./style.css" type="text/css" rel="stylesheet">
    <script src="script.js"></script>
    </head>
<!-- make H2 centered ! -->
    <h2 class='titlecenter'>Book a room</h2>
        <div class="form">
        <!-- Do we need to login? -->
            <form id ="form" name="form" class="login-form" method="post">
                <div class="ajax">
                    <input id="roomID" name="roomID" type="text" placeholder="Room ID"/>
                    <!-- Do we need to enter the guest id? not sure will check -->
                    <input id="customerID" name="customerID" type="text" placeholder="Enter your Customer ID">
                    <!-- Do we need hotelId if it can be obtained by roomId? -->
                    <input id="hotelID" name="hotelID" type="text" placeholder="Enter the hotel ID" />

                    <!-- Not sure about p???  -->
                    <p style="margin-top: 10px;" class="checkboxmessage">Check-In Date</p>
                    <input id='checkinDate' name='checkinDate' type="date" placeholder="Check-In Date"/>
                    <p style="margin-top: 10px;" class="checkboxmessage">Check-Out Date</p>
                    <input id='checkoutDate' name='checkoutDate' type="date" placeholder="Check-Out Date"/>

                <input id="submit" name="submit" type="submit" value="Submit">
                <!-- Add input buttons to with href to payment page or others -->

            </form>
        </div>
        </div>



<!-- PHP Logic -->
<?php
// https://www.php.net/manual/en/function.pg-connect.php
  $databaseConnection = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=group_a04_g35 user=user password=password");

    session_start();  

    if(isset($_POST['submit'])){
        echo 'trying';
        echo  (int) $_POST['roomID'];
        $roomID = (int) $_POST['roomID'];
        $customerID = (int) $_POST['customerID'];
        $hotelID = ceil($roomID/5);
        $checkinDate = $_POST['checkinDate'];
        $checkoutDate = $_POST['checkoutDate'];
        

        // https://www.php.net/manual/en/class.datetime.php
        $checkin = DateTime::createFromFormat('Y-m-d H:i:s', $_POST['checkinDate']);
        $checkout = DateTime::createFromFormat('Y-m-d H:i:s', $_POST['checkoutDate']);


        if($roomID != null && $customerID != null){
            // Grabs last booking Id, and 
            $BookingId = pg_query($databaseConnection, "SELECT max(booking_id) FROM Booking"); 
            $result = pg_fetch_array($BookingId);
            $query = pg_query($databaseConnection, "INSERT INTO Booking (booking_id, hotel_id, customer_id, room_id) VALUES 
            (($result[0] + 1), $hotelID, $customerID, $roomID)");
            $_SESSION['bookingid'] = ($result[0] + 1);
            $bookingHistory = pg_query($databaseConnection, "INSERT INTO Bookinghistory (room_id, booking_id, rating, checkin, checkout) VALUES ($roomID, ($result[0] + 1), NULL, $checkin, $checkout)");

        if(!$query){
            echo "<script type='text/javascript'>alert('failed to book room, try again');</script>";
            }
        if($query){
            echo "<script>window.location.href='payment.php';</script>";
            //echo "<script type='text/javascript'>alert('Room Successfully booked');</script>";
            
        }

        //echo "<script>window.location.href='payment.php';</script>";
        //exit();
        }
    }
?>
</html>