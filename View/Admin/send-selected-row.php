<?php
    require "../../Controller/Db_connection.php";

$username = $_POST['username'];
$status = $_POST['status'];

if($status=="Active"){
    $sql = "UPDATE user SET Status= 0 WHERE Username='$username'";
    $result2 = $conn->query($sql);
    // header("Location: " . $_SERVER['PHP_SELF']);
    // exit();
}
else{
    $sql = "UPDATE user SET Status= 1 WHERE Username='$username'"; 
    $result2 = $conn->query($sql);
    // header("Location: " . $_SERVER['PHP_SELF']);
    // exit();
}

?>
