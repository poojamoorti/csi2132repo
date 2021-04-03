<?php include_once("index.html"); 

 
          $connection = pg_connect("host=ec2-54-145-102-149.compute-1.amazonaws.com port=5432 dbname=d9n9b0bg5b894t user=ygvmtvoyhmkdyz password= 17306cd10c418d80fe35f1c7a60d4f576cafd1d4b14b5c885ddc2cd26bed0b20");

          echo (pg_query("SELECT * from hotel")); ?>
