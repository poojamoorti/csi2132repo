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

    <h2 class='titlecenter'>Create a new Customer Account</h2>


    <div class="form">
        <form id="form" name="form" class="login-form" method="post">
            <div class="ajax">
                <input id="sin" name="sin" type="text" placeholder="Enter Social Insurance/Security Number"/>
                <input id="fnameID" name="fnameID" type="text" placeholder="Enter first name"/>
                <input id="ini" name="ini" type="text" placeholder="Enter middle initial"/>
                <input id="lname" name="lname" type="text" placeholder="Enter last name"/>
                <input id="postal" name="postal" type="text" placeholder="Enter postal code"/>
                <input id="streetnum" name="streetnum" type="text" placeholder="Enter street number"/>
                <input id="streetname" name="streetname" type="text" placeholder="Enter street name"/>
                <input id="city" name="city" type="text" placeholder="Enter city"/>
                <input id="province" name="province" type="text" placeholder="Enter province/state"/>
                <input id="country" name="country" type="text" placeholder="Enter country"/>
                <input id="appnum" name="appnum" type="text" placeholder="appartment number (leave empty for none)"/>

                <input id="submit" name="submit" type="submit" value="Create customer" />
            </div>
        </form>
    </div>


<?php
    $databaseConnection = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=group_a04_g35 user=user password=password");

    if(isset($_POST['submit'])){
        $Social = $_POST['sin'];
        $firstName = $_POST['fnameID'];
        $middleInitial = $_POST['ini'];
        $lastName = $_POST['lname'];
        $postal = $_POST['postal'];
        $streetNumber = $_POST['streetnum'];
        $streetName = $_POST['streetname'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $country = $_POST['country'];
        $appnum = $_POST['appnum'];

        if($streetName != null && $streetNumber != null && $postal != null && $city != null && $province != null && $country != null){
            // Address exists !
            // No points adding address if the customer does not exist !

            if($Social != null && $firstName != null && $middleInitial != null && $lastName != null){

            $addressID = pg_query($databaseConnection, "SELECT max(address_id) FROM Address");
            $result = pg_fetch_array($addressID);
            if($appnum == null){    
                $query = pg_query($databaseConnection, "INSERT INTO Address (address_id, postal_code, street_number, street_name, city, province, country, apt_number) 
                VALUES (($result[0] + 1), '$postal', '$streetNumber', '$streetName', '$city', '$province', '$country', NULL)");
            }else{
            $query = pg_query($databaseConnection, "INSERT INTO Address (address_id, postal_code, street_number, street_name, city, province, country, apt_number) 
            VALUES (($result[0] + 1), '$postal', '$streetNumber', '$streetName', '$city', '$province', '$country', $appnum)");
            }


            $customerID = pg_query($databaseConnection, "SELECT max(customer_id) FROM Customer");
            $custResult = pg_fetch_array($customerID);
            $query = pg_query($databaseConnection, "INSERT INTO Customer (sin, first_name, middle_initial, last_name, address_id, customer_id, registration_date, booking_id) VALUES ($Social, '$firstName', '$middleInitial', '$lastName', ($result[0] + 1), ($custResult[0] + 1), now() ,NULL)");
            }
            
            $newCustId = $custResult[0] + 1;
            if($query){
                echo "Created new Customer with Id: $newCustId";
            }else{
                echo '<script type="text/javascript>alert("Error creating customer, try again);</script>';

            }
        }
        else{
            echo '<script type=text/javascript>alert("Please enter all required information");</script>';
        }


    }


?>

    </body>



</html>