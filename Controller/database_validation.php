<?php
require __DIR__ . '/../Controller/Db_connection.php';

function userNameDBValidation($conn){
$sql = "SELECT * FROM user ORDER BY Username ASC ";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
if($row["Username"]==$_POST["username"]){
return 1;
}}}

function emailDBValidation($conn){
$sq = "SELECT * FROM user ORDER BY Email ASC ";
$result = $conn->query($sq);
while($row = $result->fetch_assoc()){
if($row["Email"]==$_POST["email"]){
return 1;
}}}

function usernameEXISTValidation($Username, $conn) {
    $sql = "SELECT Username FROM user";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        if ($row["Username"] == $Username) {
            return 1;
        }
    }
}
    
    ?>