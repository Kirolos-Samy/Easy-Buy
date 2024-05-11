<?php
include '../../Controller/Mail.php';
require __DIR__ . '/../Controller/Db_connection.php';
function activation($un){
        require __DIR__ . '/../Controller/Db_connection.php';

        $activationCode= rand(100000,999999);
        
        $q = "UPDATE user SET A_code= '$activationCode' , Status=0  WHERE Username='$un'";
        $result = $conn->query($q);
        $sql = "SELECT Email FROM user WHERE Username = '$un'";
        $result2 = $conn->query($sql);
        $row2 = $result2 -> fetch_assoc();
        sendEmail($row2["Email"],$un,"Activation", "This is your activation code: $activationCode");
        header("Location: ../../View/Customers/Activation.php");
        die();     
 }
    ?>