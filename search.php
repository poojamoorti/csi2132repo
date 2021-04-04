<?php
  $connection = pg_connect("host=ec2-54-145-102-149.compute-1.amazonaws.com
    dbname=d9n9b0bg5b894t user=ygvmtvoyhmkdyz password=17306cd10c418d80fe35f1c7a60d4f576cafd1d4b14b5c885ddc2cd26bed0b20");
  $stat = pg_connection_status($connection);
?>

<!DOCTYPE html>
    <html>
    
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <link href="./style.css" type="text/css" rel="stylesheet">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="script.js"></script>
    </head>
    
    <body>

        <h2 class='titlecenter'>   Search for a room</h2>
            <div class="login-page">
            <div style = "margin-top: -50px; width: 500px" class="form">
                <form id="form" name="form" class="login-form" method="POST">
                    <div class="ajax">
                        <input id="roomID" name="roomID" type="text" placeholder="Enter room ID"/>
                        <p style="margin-top: 10px;" class="checkboxmessage">OR</p>
                        <input id='cityID' name="cityID" type="text" placeholder="Enter City"/>
                        <!-- Put amenities here -->
                        <p style="margin-top: 10px;" class="checkboxmessage">Amenities</p>
                        <label class="checkbox-inline">
                            <input type="radio" id="tv" name="tv" value="Tv">
                            TV
                        </label>
                        <label class="checkbox-inline"> <input type="radio" id="ac" name="ac" value="Air conditioning"> AC </label>
                        <div style="margin-top: 10px;">
                        <p style="margin-top: 10px" class="checkboxmessage">View_type</p>
                        <label class="checkbox-inline">  <input type='radio' id='ocean' name='view' value='ocean'> Ocean </label>
                        <label class="checkbox-inline"> <input type='radio' id='sea' name='view' value='sea'> Sea </label>
                        </div>

                        <input id='capacity' name='capacity' type='number' placeholder="Enter capacity"/>
                    
                        <div class="container">
                        <div class="col-sm"><input id="search" name="search" type="submit" value="search"></div>
                        <div class="col-sm"><input id="book" name="book" type="submit" value="book"></div>
                        </div>
                    </div>
                </form>
            </div>
            </div>

<?php 

if(isset($_POST['book'])){echo "<script>window.location.href='book.php';</script>";}

if(isset($_POST['search'])){ // User is searching for hotels matching the above criteria
    $databaseConnection = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=group_a04_g35 user=gstpi022 password=Coolman440");

    $roomID = $_POST['roomID']; 
    if($roomID != null){ // User is searching usign roomID
        $query = pg_query("SELECT room.room_id, room.price, room.capacity, room.view_type, amenities.tv, amenities.air_conditioner, amenities.fridge 
        FROM room INNER JOIN hotel ON (room.hotel_id = hotel.hotel_id)
        INNER JOIN amenities
        ON (room.amenities_id = amenities.amenities_id)
        INNER JOIN address
        ON (hotel.address_id = address.address_id) WHERE room.room_id = $roomID");
        while($row = pg_fetch_row($query)) {
            echo "Room ID: $row[0], Room price: $row[1], Capacity: $row[2], View: $row[3], Tv: $row[4], AC: $row[5], Fridge: $row[6]";
        }

    }
    else{
        $city = $_POST['cityID'];
        $capacity = (int) $_POST['capacity'];

        if(isset($_POST['tv'])){
            $Tv = 'True';
        } else{
            $Tv = 'False';
        }
        if(isset($_POST['ac'])){
            $Ac = 'True';
        } else{
            $Ac = 'False';
        }
        if(isset($_POST['fridge'])){
            $Fridge = 'True';
        } else{
            $Fridge = 'False';
        }

        if(isset($_POST['ocean'])){
            $View = 'Ocean';
        } else{
            $View = 'Sea';
        }

        $query = pg_query("SELECT room.room_id, room.price, room.capacity, room.view_type, amenities.tv, amenities.air_conditioner, amenities.fridge FROM room
        INNER JOIN hotel
        ON room.hotel_id = hotel.hotel_id
        INNER JOIN amenities
        ON room.amenities_id = amenities.amenities_id
        INNER JOIN address
        ON hotel.address_id = address.address_id
        
        WHERE city = '$city' AND tv = $Tv AND air_conditioner = $Ac AND fridge = $Fridge AND capacity = $capacity AND view_type = '$View'");

        while($row = pg_fetch_row($query)) {
        echo "Room ID: $row[0], Room price: $row[1], Capacity: $row[2], View: $row[3], Tv: $row[4], AC: $row[5], Fridge: $row[6]";}
    }

}


?>

    </body>
</html>