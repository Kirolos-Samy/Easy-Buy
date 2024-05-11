<?php
require "../../Controller/Db_connection.php";
session_start();

$un = $_SESSION['username'];

$Orderid="";
$date="";
$cost="";
$status="";
if(isset($_GET['id']) ){
    $OrderID=$_GET['id'];
    $orders ="SELECT * FROM orderdetails join ordert on orderdetails.Order_Id =ordert.Order_ID join product on orderdetails.Product_Id=product.ID WHERE  orderdetails.Order_Id= $OrderID;";
    $userorders = $conn->query($orders);
    
}
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
    #cartnumafter::before{
          content:"<?php echo $numberofitemsincrt ?>";
        }
    
    #list2{
border-radius:8px;
background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);
width:90%;


}

#list{
  margin-left:500%;
}

h6{
    color:white;
    font-size:20px;
    padding-left:10px;
}
.orders{
    padding-left:20%;
}
h2{
    padding-left:30%; 
}

#list2{
  margin-left:500%;
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
        include "../assets/includes/aheader.php"
    ?>


    <div class="orders">
        <h2>Order Details</h2>
        <div class="properties__button">

         </div>

        <div class="tab-content" id="nav-tabContent">

                    <!-- card one -->
                   
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="rows" >   

                        <li class="list-group-item d-flex justify-content-between lh-sm m-2 rounded" 
                        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"
                         style="border:2px solid gray;" id="list2">

                        <div class="row d-flex justify-content-center align-items-center  m-0" >  
                        <?php
                         while( $uporder = $userorders->fetch_assoc()){
                            ?>                                 

                 <div id="details">
   
          
                    <img src="<?php echo $uporder['Photo'] ."<br>"; ?>" alt="" style="  border-radius: 8px; padding: 10px; width: 200px;">
                    <h6>product name: <?php echo $uporder['Product_name']."<br>"; ?></h6>
                    <h6>Quantity: <?php echo $uporder['QuantityD']."<br>"; ?></h6>

                    <a href="ViewOrders.php">
                        <button  class="btn_3" style="margin:10px; padding:10px 20px">Back</button>
                    </a>    

 


                 
                </div>
                <?php
                           }
                        ?>   
                        </div>
                       
                        

                        </li>

                        
                    </div>    
    </div>
                
    <footer>

<!-- Footer Start-->
<div class="footer-area footer-padding" style="margin-left:-20%;">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
               <div class="single-footer-caption mb-50">
                 <div class="single-footer-caption mb-30">
                      <!-- logo -->
                     <div class="footer-logo">
                         <a href="../../View/Users/1.php"><img src="../assets/img/logo/Logo2_footer.png" alt=""width="150px" hieght="50px"></a>
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