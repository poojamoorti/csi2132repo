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
        <script src="script.js"></script>
    </head>

    <body>

    <h2 class='titlecenter'>Welcome</h2>
        <div class="form">
            <form id="form" name="form" class="login-form" method="POST">
                <input id="searchID" name="searchID" type="submit" Value="Search">
                <input id="bookID" name="bookID" type="submit" Value="Book a room">
                <input id="rentID" name="rentID" type="submit" Value="Change a room to rented">
                <input id="custID" name="custID" type="submit" Value="Add a new Customer">
        </div>


<?php

if(isset($_POST['bookID'])){echo "<script>window.location.href='book.php';</script>";}
if(isset($_POST['searchID'])){echo "<script>window.location.href='search.php';</script>";}
if(isset($_POST['rentID'])){echo "<script>window.location.href='rent.php';</script>";}
if(isset($_POST['custID'])){echo "<script>window.location.href='customer.php';</script>";}

?>

    </body>

</html>