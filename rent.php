<?php
  $connection = pg_connect("host=ec2-54-145-102-149.compute-1.amazonaws.com
    dbname=d9n9b0bg5b894t user=ygvmtvoyhmkdyz password=17306cd10c418d80fe35f1c7a60d4f576cafd1d4b14b5c885ddc2cd26bed0b20");
  $stat = pg_connection_status($connection);
?>

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
    $databaseConnection = pg_connect("host=ec2-54-145-102-149.compute-1.amazonaws.com
    dbname=d9n9b0bg5b894t port=5432 user=ygvmtvoyhmkdyz password=17306cd10c418d80fe35f1c7a60d4f576cafd1d4b14b5c885ddc2cd26bed0b20");

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