<?php
    require "../../Controller/Db_connection.php";

$productName = $_POST['ProductName'];

$deleteQuery = "DELETE FROM product WHERE Product_name='$productName';";
$conn->query($deleteQuery);

?>