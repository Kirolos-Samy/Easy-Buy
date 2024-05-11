<?php 
require "../../Controller/Db_connection.php";
session_start();
$Orderid="";
$date="";
$cost="";
$status="";

$un = $_SESSION['username'];

$sq = "SELECT user_ID FROM user WHERE Username='$un' ";
$result = $conn->query($sq);
$row = $result -> fetch_assoc();

$id= $row['user_ID'];
$_SESSION['id']=$id;


$ndorders ="SELECT * FROM ordert WHERE O_status ='1' ";
$nduserorders = $conn->query($ndorders);
$numberOfndorders = mysqli_num_rows($nduserorders);

$dorders ="SELECT * FROM ordert WHERE O_status ='2' ";
$duserorders = $conn->query($dorders);





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




    <header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">

               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                  <a href="../../View/Operator/operator.php"><img src="../assets/img/logo/Logo.png" width="150px" hieght="50px"></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                     


                                            <li><a href="#" id="list">Account</a>
                                                <ul class="submenu" id="list">
                                                    <!-- <li><a href="../../View/Admin/admin.php">Admin Page</a></li> -->
                                                    <li><a href="../../View/Operator/operator.php">Manage Orders</a></li>

                                                    <li><a href="../../View/Operator/loginAndSecurityForOperator.php">Login & security</a></li>
                                                    <li><a href="../../View/Customers/logout.php">Logout</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div> 
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">

                                    <?php 
                                   
                                   if(isset($_SESSION['username']) && $_SESSION['username'] != null){
                                    echo'<li class="d-none d-lg-block"> <a  class="btn header-btn"style="color:white; ">';
                                    echo $un;
                                   }
                                   else{
                                    echo'<li class="d-none d-lg-block"> <a href="../../View/Customers/login.php" class="btn header-btn">';
                                    echo "Sign in";
                                } 
                                   ?>
                                   </a></li>
                                </ul>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>

            <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center mb-40">
                            <h1>Not Delivered Yet : </h1>
                        </div>
                    </div>
                </div>


    <?php


if($numberOfndorders == 0){
    echo '<br> <div class="alert alert-info" id="err" role="alert">
    <h6 class="m-0 mx-0">All orders were delivered successfully</h6>
    </div>';
}

                            while($ndorder= $nduserorders->fetch_assoc()){
                        ?>       
                                             

                        <div class="row d-flex justify-content-center align-items-center  m-0" >  
                            
                                     
                            <div id="forms">
                                <div> <h6>
                                    Date Placed: <?php echo $ndorder['Date'] ; ?> <br>
                                    Total Cost: <?php echo $ndorder['Cost'] ; ?></h6>
                                    <br>
                                </div>
                                <a href="Orderdetails2.php?id=<?php echo $ndorder['Order_ID'];?>" >
                                <button  class="btn_3" style="margin:10;"> Order Details</button>
                                </a>
                                <a href="deliverOrder.php?id=<?php echo $ndorder['Order_ID'];?>" >
                                <button  class="btn_3"> deliver Order</button>
                                </a>
                            </div>
                            
                        </div>
                        
                        
                        <?php
                           }
                        ?>
<br>
<br>
            <!-- Section Tittle -->
            <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center mb-40">
                            <h1>Delivered : </h1>
                        </div>
                    </div>
                </div>


    <?php
                            while($dorder= $duserorders->fetch_assoc()){
                        ?>       
                                             

                        <div class="row d-flex justify-content-center align-items-center  m-0" >  
                            
                                     
                            <div id="forms">
                                <div> <h6>
                                    Date Placed: <?php echo $dorder['Date'] ; ?> <br>
                                    Total Cost: <?php echo $dorder['Cost'] ; ?></h6>
                                    <br>
                                </div>
                                <a href="Orderdetails2.php?id=<?php echo $dorder['Order_ID'];?>" >
                                <button  class="btn_3" style="margin:10;"> Order Details</button>
                                <!-- <a href="deliverOrder.php?id=<?php echo $dorder['Order_ID'];?>" >
                                <button  class="btn_3"> deliver Order</button>
                                    
                                    </a> -->
                            </div>
                            
                        </div>
                        
                        
                        <?php
                           }
                        ?>

                    
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