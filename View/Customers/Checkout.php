<?php
session_start();
include '../../Controller/Mail.php';
require "../../Controller/Db_connection.php";

if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $USERID=$_SESSION['id'];
    $un = $_SESSION['username'];

$totalamount = $_SESSION['user_total'];
$errormsg='';
$total=0;
    



if(!$conn){
    echo 'Error In Database connection';
}


$retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart ON product.ID=cart.Product_ID WHERE User_ID = '".$USERID."' ");
$retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
$numberofitemsincrt= mysqli_num_rows($retrievecartproducts);
if($numberofitemsincrt==0){
  header("Location: ../../View/Customers/cart.php");
}
// echo '<pre>';
// print_r($retrievedata);
// echo '</pre>';



//Retrieve Credit Cards From DB
$creditcardsq=mysqli_query($conn,"SELECT * FROM `biling info` WHERE user_ID='".$USERID."'  ");
$creditcards = mysqli_fetch_all($creditcardsq,MYSQLI_ASSOC);


//Retrieve User Adresses From Db

$useraddressesf =mysqli_query($conn,"SELECT * FROM `shipping info` WHERE user_ID='".$USERID."' ");
$thisuseraddresses = mysqli_fetch_all($useraddressesf,MYSQLI_ASSOC);


//Retrieve User info From Db

$userinfos =mysqli_query($conn,"SELECT * FROM user WHERE user_ID='".$USERID."' ");
$thisuserinfo = mysqli_fetch_all($userinfos,MYSQLI_ASSOC);


if(isset($_POST['PlaceOrder'])){

  if(isset($_POST['addressId'])){

    $addressId= $_POST['addressId'];
    $date= date("Y-m-d");
    $SQU="SELECT * FROM user WHERE user_ID='".$USERID."' ";
    $resultU = $conn->query($SQU);
    $userinfos= $resultU->fetch_assoc();

    $em=$userinfos['Email'];
    $un=$userinfos['Username'];
    $name=$userinfos['Name'];




    $SQO="INSERT INTO `ordert` (`user_ID`, `Date`, `Cost`, `O_status`) VALUES ('$USERID', '$date' , ' $totalamount', '1')";
    $result = $conn->query($SQO);

    $SQO1="SELECT * FROM `ordert` WHERE user_ID=".$USERID." ORDER BY `ordert`.`Order_ID` DESC;";
    $result1 = $conn->query($SQO1);
    $row1 = $result1->fetch_assoc();
    $ORDERID=$row1['Order_ID'];

    $SQO2="SELECT * FROM `cart` WHERE user_ID='".$USERID."'  ";
    $result2 = $conn->query($SQO2);


    while($row2 = $result2->fetch_assoc()){
      $productID = $row2['Product_ID'];
      $Quantity = $row2['Quantity'];
      $SQO5="SELECT * FROM `product` WHERE ID='".$productID."'  ";
      $result5 = $conn->query($SQO5);
      $row5 = $result5->fetch_assoc();
      $quantity= $row5['Quantity'];
      $SQO4 ="UPDATE product set quantity = ($quantity-$Quantity) where ID=$productID ";
      $result4 = $conn->query($SQO4);

    $SQO3="INSERT INTO `orderdetails` (`Order_Id`, `Product_Id`, `QuantityD`, `AddressId`) VALUES ('$ORDERID', '$productID', '$Quantity', '$addressId')";
    $result3 = $conn->query($SQO3);
    }

    $SQO4="DELETE FROM cart WHERE user_ID='".$USERID."'  ";
    $result4 = $conn->query($SQO4);
    sendEmail($em,$un,"activation", "Hi, [$name]. Thank you for your recent purchase. We are honored to gain you as a customer and hope to serve you for a long time.");

    $_SESSION['orderplaced'] = "Your order has been successfully placed";
    header("Location: ../../index.php");
    die();

    }
    else{
      header("Location: ../../View/Customers/Beforeorderaddress.php");
      die();
    }









  }



    }

else{    
  header("Location: ../../View/Customers/login.php");
  die();}

?>



<!doctype html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Check Out</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="site.webmanifest">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

  <!-- CSS here -->
      <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
      <link rel="stylesheet" href="../assets/css/flaticon.css">
      <link rel="stylesheet" href="../assets/css/slicknav.css">
      <link rel="stylesheet" href="../assets/css/animate.min.css">
      <link rel="stylesheet" href="../assets/css/magnific-popup.css">
      <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
      <link rel="stylesheet" href="../assets/css/themify-icons.css">
      <link rel="stylesheet" href="../assets/css/slick.css">
      <link rel="stylesheet" href="../assets/css/nice-select.css">
      <link rel="stylesheet" href="../assets/css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      

      

      <style>
        /** CArt Number On Shoping Cart Icon **/
        #cartnumafter::before{
          content:"<?php echo $numberofitemsincrt ?>";
        }
        #table th, #table td {
  text-align: left; /* Left-align text */
  padding: 12px; /* Add padding */
  color:White;
}
#forms{
  background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);
padding-top: 8%;
width:100%;
border-radius:8px;
padding-left: 10px;
padding-bottom: 10px;
}
section{
float:left;
    width: 50%;
    height: 30%;
    padding-left :4%;
    padding-bottom :5%;
    display: inline-block;
}
h3{
  padding-bottom:8%;
  padding-top:8%;
}
h5{
  padding-bottom:8%;
  padding-top:8%;
}
#table tr {
  /* Add a bottom border to all table rows */
  border-bottom: 1px solid #ddd;
}


.selected {
    background-color: Brown;
    color: #FFF;
}
#table td{
width: 100%;}
    .errorMessage{
        color: yellow;
        font-weight: 100;
        font-size:12px;
    }

    .invisible-cell {
  display: none;
}

      </style>
      
</head>

<body>

      <!-- Preloader Start -->
      <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                <img src="../assets/img/logo/Logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <?php
        include "../assets/includes/uheader.php"
    ?>

<!----------------------------------- ProceedToCheckout Section Kerolos-------------------------------------->
<div class="row w-75 mx-auto">
  <div class="col-md-8 mb-4">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Biling details</h5>
      </div>
      <div class="card-body">
        <form method="post">
          <!-- 2 column grid layout with text inputs for the first and last names -->
          <div class="row mb-4">
            <div class="col">
              <div class="form-outline">
                <label class="form-label" for="form7Example1">First name</label>
                <input type="text" id="form7Example1" class="form-control" value="<?php echo $thisuserinfo[0]['Name'] ?>" readonly>
                
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <label class="form-label" for="form7Example2">Phone Number</label>
                <input type="text" id="form7Example2" class="form-control" value="<?php echo $thisuserinfo[0]['Pnumber'] ?>">
                
              </div>
            </div>
          </div>

          <!-- Text input -->



            

            <div class="form-outline mb-4">
            <label class="form-label" for="form7Example3">Address</label>


       

            <!-----PHP SECTION FOR ADDRESSES-->
            <div >
             
                
                  
               
                <select   id="addressId" name="addressId" value="" placeholder="Product Name" class="classic">
                         <?php
                        foreach($thisuseraddresses as $Valus):
                         ?> 
                <option value="  <?php   echo  $Valus['AddressId'] ;?>"><?php   echo ( $Valus['Building number'].'  '.$Valus['Street'].'  '. $Valus['district'] .'  '.$Valus['City'] );?></option>
                <?php
                         endforeach;
                         ?> 
</select>

              


                                                  
              </div>  
              
            
          </div>


          
        
        <a href="Beforeorderaddress.php" style="color:blue;" class="d-flex mx-auto"><p class="mx-auto" style="color:blue;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Add New Address?</p></a>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Summary</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Products
            <span><?php echo $totalamount.'L.E'?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            Shipping
            <span style="color:green;">Free Shipping</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
            <div>
              <strong>Total amount</strong>
              <strong>
                <p class="mb-0">(including VAT)</p>
              </strong>
            </div>
            <span><strong><?php echo $totalamount.'L.E'?></strong></span>
          </li>
        </ul>
<!-------Credit Cards Section---------------->

        <h6 class="mx-2" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Saved Credit Cards:</h6>
    

        <li class="list-group-item d-flex justify-content-between lh-sm m-2 rounded" style="background-color: rgba(221, 228, 236, 0.501);font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"> 
        <div class="row d-flex justify-content-between align-items-center m-0">
                    <input type="radio" name="creditcardcheck" checked >
                       
                        
                        <h6 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:3px;">&emsp; Cash</h6>
                    
                    </div>
                </li>
            


        <?php

            foreach($creditcards as $ccard):
                ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm m-2 rounded" style="background-color: rgba(221, 228, 236, 0.501);font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                    <input type="radio" name="creditcardcheck" value="">
                    <div class="row d-flex justify-content-center align-items-center m-0">
                        <img class="img-fluid" src="https://img.icons8.com/color/48/000000/mastercard-logo.png">
                        <h6 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">XXXX XXXX XXXX <?php echo substr($ccard['Credit Card Number'], -4) ; ?></h6>
                    
                    </div>
                </li>
                <?php

            endforeach;

            ?>


                
<a href="Beforeordercredit.php" style="color:blue;" class="d-flex mx-auto"><p class="mx-auto" style="color:blue;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Add New Credit Card?</p></a>

<button type="submit" name="PlaceOrder" id="PlaceOrder" class="btn btn-primary btn-sm btn-block" >
  Order
</button>
                


        </form>

      </div>
      
    </div>
    

    
  </div>
</div>
  
<!----------------------------------- ProceedToCheckout Section Kerolos-------------------------------------->

<?php
        include "../assets/includes/footer.php"
    ?>


<!-- JS here -->




    <!-- All JS Custom Plugins Link Here here -->
    <script src="./../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./../assets/js/popper.min.js"></script>
    <script src="./../assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./../assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./../assets/js/owl.carousel.min.js"></script>
    <script src="./../assets/js/slick.min.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="./../assets/js/wow.min.js"></script>
    <script src="./../assets/js/animated.headline.js"></script>
    
    <!-- Scrollup, nice-select, sticky -->
    <script src="./../assets/js/jquery.scrollUp.min.js"></script>
    <script src="./../assets/js/jquery.nice-select.min.js"></script>
    <script src="./../assets/js/jquery.sticky.js"></script>
    <script src="./../assets/js/jquery.magnific-popup.js"></script>

    <!-- contact js -->
    <script src="./../assets/js/contact.js"></script>
    <script src="./../assets/js/jquery.form.js"></script>
    <script src="./../assets/js/jquery.validate.min.js"></script>
    <script src="./../assets/js/mail-script.js"></script>
    <script src="./../assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./../assets/js/plugins.js"></script>
    <script src="./../assets/js/main.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>

</html>

<!------------------------



Use substr() with a negative number for the 2nd argument.

$newstring = substr($dynamicstring, -7);

->