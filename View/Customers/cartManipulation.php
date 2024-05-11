<?php
//deleting from cart//
require "../../Controller/Db_connection.php";

session_start();
if (isset($_POST['productId']) && isset($_POST['name'])) {
    $productId = $_POST['productId'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
}
    $id=$_SESSION['id'];
if($name=='cartitemdelbutton'){
    mysqli_query($conn, "DELETE FROM cart WHERE Product_ID='".  $productId."' AND User_ID='".$id."' ");
    $retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart  ON  product.ID = cart.Product_ID  WHERE User_ID = '".$id."'");
$retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
$numberofitemsincrt= mysqli_num_rows($retrievecartproducts);
$retrievecartproducts2=mysqli_query($conn,"SELECT * FROM product JOIN cart  ON  product.ID = cart.Product_ID  WHERE User_ID = '".$id."'and product.ID = '".$productId."'");
$retrievedata2 = mysqli_fetch_assoc($retrievecartproducts2);
$numberofitemsincrt2= mysqli_num_rows($retrievecartproducts2);
$price=0;
foreach($retrievecartproducts as $row){
    $price +=  $row['Quantity']*$row['Price'];
}
if($numberofitemsincrt2=1){

$response = array(
    'numberOfItems' => $numberofitemsincrt,
    'quantityOfItems'=> 0,
    'totalPrice'=>$price
);
}

else{
    $response = array(
        'numberOfItems' => $numberofitemsincrt,
        'quantityOfItems'=> 0,
        'totalPrice'=>$price
    );
}
    echo json_encode($response);

}

if($name=='cartinc'){
    $canmore = mysqli_query($conn, "SELECT * FROM product WHERE ID ='".$productId."'  ");
    $seecanmore = mysqli_fetch_all($canmore, MYSQLI_ASSOC);

    if($seecanmore[0]['Quantity'] > $quantity){
        mysqli_query($conn, "UPDATE cart SET `Quantity`=".$quantity."+1 WHERE User_ID=".$id." AND Product_ID=".$productId." ");
    } else {
        $errormsg = 'Item "'.$seecanmore[0]['Product_name'].'" Is Out Of Stock , You Got All Of Them!';
    }
    $retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart  ON  product.ID = cart.Product_ID  WHERE User_ID = '".$id."'");
    $retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
    $numberofitemsincrt= mysqli_num_rows($retrievecartproducts);
    $retrievecartproducts2=mysqli_query($conn,"SELECT * FROM product JOIN cart  ON  product.ID = cart.Product_ID  WHERE User_ID = '".$id."'and product.ID = '".$productId."'");
    $retrievedata2 = mysqli_fetch_assoc($retrievecartproducts2);

$Quantity=$retrievedata2['Quantity'];
$price=0;
foreach($retrievecartproducts as $row){
    $price +=  $row['Quantity']*$row['Price'];
}
    $response = array(
        'numberOfItems' => $numberofitemsincrt,
        'quantityOfItems'=>$Quantity,
        'totalPrice'=>$price
    );
    echo json_encode($response);
}



//decreasing in cart//
if($name=='cartdec'){
    if(!$quantity == 0){
        mysqli_query($conn, "UPDATE cart SET `Quantity`=".$quantity."-1 WHERE User_ID=".$id." AND Product_ID=".$productId." ");
    }
    if($quantity == 1){
        mysqli_query($conn, "DELETE FROM cart WHERE Product_ID='".$productId."' AND User_ID='".$id."' ");
    }
    $retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart  ON  product.ID = cart.Product_ID  WHERE User_ID = '".$id."'");
$retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
$numberofitemsincrt= mysqli_num_rows($retrievecartproducts);
$retrievecartproducts2=mysqli_query($conn,"SELECT * FROM product JOIN cart  ON  product.ID = cart.Product_ID  WHERE User_ID = '".$id."'and product.ID = '".$productId."'");
$retrievedata2 = mysqli_fetch_assoc($retrievecartproducts2);
$numberofitemsincrt2= mysqli_num_rows($retrievecartproducts2);
$price=0;
foreach($retrievecartproducts as $row){
    $price +=  $row['Quantity']*$row['Price'];
}
if($numberofitemsincrt2==1){
    $Quantity=$retrievedata2['Quantity'];
    $response = array(
        'numberOfItems' => $numberofitemsincrt,
        'quantityOfItems'=> $Quantity,
        'totalPrice'=>$price
    );}
    else{
        $response = array(
            'numberOfItems' => $numberofitemsincrt,
            'quantityOfItems'=> 0,
            'totalPrice'=>$price
        );
    }
    echo json_encode($response);


}


?>