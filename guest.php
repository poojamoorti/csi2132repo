 <?php
  $connection = pg_connect("host=ec2-54-145-102-149.compute-1.amazonaws.com
    dbname=d9n9b0bg5b894t user=ygvmtvoyhmkdyz password= 17306cd10c418d80fe35f1c7a60d4f576cafd1d4b14b5c885ddc2cd26bed0b20");
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

<div>
  <p><a href="./index.html"> Home</a></p>
</div>

<h2 class='titlecenter'>Guest</h2>

  <div id ="form" class="form">
      <p class="messageemp">Enter your Guest ID to see the list of properties owned by you</p>
      <div class="ajax">
    <form action="" method="POST" id="login-form" class="login-form">
      <input id='id' name='id' type="text" placeholder="ID"/>
      <input id="submit" name="submit" onclick="guest()" type="submit" value="Submit">

<input type="button" value="Look-Up Available Properties" onclick="window.location.href='./guestlookup.php'" />
</form>      
       <form>
<input type="button" value="Leave a Review" onclick="window.location.href='./review.php'" />
</form>

    </form>
  </div>
</div>

<section> 
    <h2 class="headingcenter">Properties currently booked by you:</h2>
</section>

  <table align=center>
        <table cellspacing="60">
        <colgroup>
          <col span="5">

        </colgroup>
        <tr>
          >
          <th><p align=center></p></th>
          <th><p align=center></p></th>
          <th><p align=center></p></th>
          <th><p align=center></p></th>
          <th><p align=center></p></th>
          <th><p align=center>ID</p></th>
          <th><p align=center>NAME</p></th>
          <th><p align=center>PROPERTY ID</p></th>
          <th><p align=center>PRICE</p></th>
          <th><p align=center>TYPE</p></th>
          <th><p align=center>COUNTRY</p></th>
        </tr>

        <?php
          $connection = pg_connect("host=ec2-54-145-102-149.compute-1.amazonaws.com port=5432 dbname=d9n9b0bg5b894t user=ygvmtvoyhmkdyz password= 17306cd10c418d80fe35f1c7a60d4f576cafd1d4b14b5c885ddc2cd26bed0b20");

          echo (pg_query("SELECT * from hotel"));

        
          if($_POST['submit'])
          {
            $record = $_POST["id"];
            if($record!=null){
              $query = pg_query("SELECT * FROM guest WHERE id='$record'");
              if(pg_num_rows($query) == 1){
                  $result = pg_query($connection, "SELECT guest.id, guest.first_name, property.id, property.host_price, property.property_type, property.country FROM guest, property_agreement, property WHERE guest.id = '$record' and property_agreement.guest_id = '$record' and property_agreement.property_id = property.id ");
                  while ($row = pg_fetch_row($result)){
                          echo "<tr>";
                          echo "<td> </td>";
                          echo "<td> </td>";
                          echo "<td> </td>";
                          echo "<td> </td>";
                          echo "<td> </td>";
                          echo "<td> <p align=center>$row[0] </p></td>";
                          echo "<td> <p align=center>$row[1] </p></td>";
                          echo "<td> <p align=center>$row[2] </p></td>";
                          echo "<td> <p align=center>$row[3] </p></td>";
                          echo "<td> <p align=center>$row[4] </p></td>";
                          echo "<td> <p align=center>$row[5] </p></td>";
                          echo "</tr>";
                }
              }
            }
          }
      ?>
    </table>
  </body>




</html>
