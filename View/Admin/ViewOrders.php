<?php 
require "../../Controller/Db_connection.php";
session_start();
$Orderid="";
$date="";
$cost="";
$status="";

if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $id=$_SESSION['id'];
    $un = $_SESSION['username'];
}

// $sq = "SELECT user_ID FROM user WHERE Username='$un' ";
// $result = $conn->query($sq);
// $row = $result -> fetch_assoc();

// $id= $row['user_ID'];
// $_SESSION['id']=$id;





$orders ="SELECT * FROM  ordert  WHERE O_status='2' ";
$userorders = $conn->query($orders);

$ndorders ="SELECT * FROM ordert   WHERE O_status='1' ";
$nduserorders = $conn->query($ndorders);
$numberOfndorders = mysqli_num_rows($nduserorders);


$cancelledorders ="SELECT * FROM ordert WHERE O_status='3' ";
$cuserorders =  $conn->query($cancelledorders);



?>
<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Orders </title>
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
    <style>
    .errorMessage{
        color: red;
        font-weight: 100;
        font-size:12px;
                 }
    
                 .orders{
        margin-top: 7%;
        padding-left: 5%;
        padding-right: 5%;

     }      
    .rows{
        margin-top: 3%;
        margin-right: 20%;
        
    } 

    #forms{
border-radius:8px;
background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);
width:900px;
padding:40px;
margin-bottom:20px;
}
h6{
    color:white;
    font-size:20px;
}
#list{
  margin-left:500%;
}
#err {
  text-align: center;
  width: max-content;
  margin: -40px auto 55px ;
}
</style>
</head> 

<body>




<?php
        include "../assets/includes/aheader.php"
    ?>


<div class="orders">
        <h2>Orders</h2>
        <div class="properties__button">
                            <!--Nav Button  -->
                            <nav">                                                                                                
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="color: black;" >Delivered Orders</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="color: black;">Not yet delivered</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" style="color: black;">Cancelled Orders</a>
                                </div>
                            </nav>
                            <!--End Nav Button  -->
         </div>

        <div class="tab-content" id="nav-tabContent">

                    <!-- card one -->
                   
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="rows" >   
                        
                            <?php
                           while($uorder = $userorders->fetch_assoc()){
                            ?>       
                        <li class="list-group-item d-flex justify-content-between lh-sm m-2 rounded" 
                        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"
                         style="border:2px solid gray;" id="forms">

                        <div class="row d-flex justify-content-center align-items-center  m-0" >  
                            
                                     
                            <div >
                                <div> <h6>
                                    Date Placed: <?php echo $uorder['Date'] ; ?> <br>
                                    Total Cost: <?php echo $uorder['Cost'] ; ?></h6>
                                    <br>
                                </div>
                                <a href="Orderdetails.php?id=<?php echo $uorder['Order_ID'];?>" >
                                <button  class="btn_3"> Order Details</button>
                                    
                                    </a>
                            </div>
                            
                        </div>
                        
                        </li>
                        
                        <?php
                           }
                        ?>
                        
                    </div>    
                </div>
        
                                         
                    

                    <!-- Card two -->
                     <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="rows">   
                    
                        <?php
                            if($numberOfndorders == 0){
                                echo '<br> <div class="alert alert-success" id="err" role="alert">
                                <h6 class="m-0 mx-0">All orders were delivered successfully</h6>
                                </div>';
                            }
                            while($ndorder= $nduserorders->fetch_assoc()){
                        ?>       
                                             <li class="list-group-item d-flex justify-content-between lh-sm m-2 rounded" 
                                             style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"                         style="border:2px solid gray;" id="forms">

                        <div class="row d-flex justify-content-center align-items-center  m-0" >  
                            
                                     
                            <div >
                                <div> <h6>
                                    Date Placed: <?php echo $ndorder['Date'] ; ?> <br>
                                    Total Cost: <?php echo $ndorder['Cost'] ; ?></h6>
                                    <br>
                                </div>
                                <a href="Orderdetails.php?id=<?php echo $ndorder['Order_ID'];?>" >
                                <button  class="btn_3"> Order Details</button>
                                <a href="cancelOrder.php?id=<?php echo $ndorder['Order_ID'];?>" >
                                <button  class="btn_3"> Cancel Order</button>
                                    
                                    </a>
                            </div>
                            
                        </div>
                        
                        </li>
                        
                        <?php
                           }
                        ?>
                        
                    </div>    
                </div>

                    <!-- Card three -->
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="rows">
                      
                        <?php
                            while($corder= $cuserorders ->fetch_assoc()){
                        ?>       
                                             <li class="list-group-item d-flex justify-content-between lh-sm m-2 rounded" 
                                             style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"                         style="border:2px solid gray;" id="forms">

                        <div class="row d-flex justify-content-center align-items-center  m-0" >  
                            
                                     
                            <div >
                                <div> <h6>
                                    Date Placed: <?php echo $corder['Date'] ; ?> <br>
                                    Total Cost: <?php echo $corder['Cost'] ; ?></h6>
                                    <br>
                                </div>
                                <a href="Orderdetails.php?id=<?php echo $corder['Order_ID'];?>" >
                                <button  class="btn_3"> Order Details</button>
                                    
                                    </a>
                            </div>
                            
                        </div>
                        
                        </li>
                        
                        <?php
                           }
                        ?>
                        
                    </div>    
                </div>

    <footer>

<!-- Footer Start-->
<div class="footer-area footer-padding">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
               <div class="single-footer-caption mb-50">
                 <div class="single-footer-caption mb-30">
                      <!-- logo -->
                     <div class="footer-logo">
                         <a href="1.php"><img src="../assets/img/logo/Logo2_footer.png" alt=""width="150px" hieght="50px"></a>
                     </div>
                     <div class="footer-tittle">
                         <div class="footer-pera">
                             <p>Best Place To Buy Your Desired Items</p>
                        </div>
                     </div>
                 </div>
               </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                <div class="single-footer-caption mb-50">
                    <div class="footer-tittle">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#"> Offers & Discounts</a></li>
                            <li><a href="#"> Get Coupon</a></li>
                            <li><a href="#">  Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                <div class="single-footer-caption mb-50">
                    <div class="footer-tittle">
                        <h4>New Products</h4>
                        <ul>
                            <li><a href="#">Woman Cloth</a></li>
                            <li><a href="#">Fashion Accessories</a></li>
                            <li><a href="#"> Man Accessories</a></li>
                            <li><a href="#"> Rubber made Toys</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                <div class="single-footer-caption mb-50">
                    <div class="footer-tittle">
                        <h4>Support</h4>
                        <ul>
                         <li><a href="#">Frequently Asked Questions</a></li>
                         <li><a href="#">Terms & Conditions</a></li>
                         <li><a href="#">Privacy Policy</a></li>
                         <li><a href="#">Privacy Policy</a></li>
                         <li><a href="#">Report a Payment Issue</a></li>
                     </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer bottom -->
   
     </div>
    </div>
</div>
<!-- Footer End-->

</footer>


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

</body>
    
</html>