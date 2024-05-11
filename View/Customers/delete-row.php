<?php
    require "../../Controller/Db_connection.php";
    if(isset($_POST['id'])) {
      $id = $_POST['id'];
    $type = $_POST['type'];
      if(isset($_POST['type'])) {
        $type = $_POST['type'];
        if($type == "shiping info") {
          $sql= " DELETE FROM `shipping info` WHERE `shipping info`.`AddressId` =  $id";
          
          $result = $conn->query($sql);

        } else  {
         $sql= " DELETE FROM `biling info` WHERE `biling info`.`BillingId` = $id ";
        
         $result = $conn->query($sql);


        } 
      } else {
        echo "Type not specified";
      }
    } else {
      echo "ID not specified";
    }
?>