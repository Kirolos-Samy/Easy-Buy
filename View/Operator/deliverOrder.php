<?php
require "../../Controller/Db_connection.php";

if(isset($_GET['id']) ){
    $OrderID=$_GET['id'];
    $orders ="UPDATE  ordert set O_status='2' WHERE Order_ID =  $OrderID";
    $userorders = $conn->query($orders);
    header("Location: ../../View/Operator/operator.php");
    die();
}

?>