<?php
include '../../Controller/Mail.php';
require "../../Controller/Db_connection.php";

session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $id=$_SESSION['id'];
    $un = $_SESSION['username'];

    $retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart ON product.ID=cart.Product_ID WHERE User_ID = '".$id."' ");
    $retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
    $numberofitemsincrt= mysqli_num_rows($retrievecartproducts);

    if( isset($_POST["message"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["subject"]) ){
        if(!empty($_POST["message"]) && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["subject"])){
    sendEmail('e21691140@gmail.com',$_POST["email"],$_POST["subject"],$_POST["message"] );
    header("Location: ../../View/Users/1.php");
    die();        
}    
        else{
            if(empty($_POST["message"])){
                $fullnameErrMsg='message is Required!';}
            if(empty($_POST['name'])){
                $usernameErrMsg='name is Required!';}
            if(empty($_POST['email'])){
                $emailErrMsg='email is Required!';}
            if(empty($_POST['subject'])){
                $passwordErrMsg='subject is Required!';}    
        }
    }
}
else{
    header("Location: ../../View/Customers/login.php");
    die();
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Contact</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
		<!-- CSS here -->
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="../assets/css/owl.c   arousel.min.css">
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
 #cartnumafter::before{
          content:"<?php echo $numberofitemsincrt ?>";
        }
            </style>
   </head>

   <body>
       
  
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
        include "../assets/includes/secheader.php"
    ?>

    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="../assets/img/hero/category.jpg" style="background-image: url(&quot;../assets/img/hero/category.jpg&quot;);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
            <div class="container">
                <div class="d-none d-sm-block mb-5 pb-4">
                 
                    <script>
                        function initMap() {
                            var uluru = {
                                lat: -25.363,
                                lng: 131.044
                            };
                            var grayStyles = [{
                                    featureType: "all",
                                    stylers: [{
                                            saturation: -90
                                        },
                                        {
                                            lightness: 50
                                        }
                                    ]
                                },
                                {
                                    elementType: 'labels.text.fill',
                                    stylers: [{
                                        color: '#ccdee9'
                                    }]
                                }
                            ];
                            var map = new google.maps.Map(document.getElementById('map'), {
                                center: {
                                    lat: -31.197,
                                    lng: 150.744
                                },
                                zoom: 9,
                                styles: grayStyles,
                                scrollwheel: false
                            });
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&amp;callback=initMap">
                    </script>
    
                </div>

    
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Get in Touch</h2>
                    </div>
                    <div class="col-lg-8">
                        <form class="form-contact contact_form" action="#" method="post" novalidate="novalidate">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="message" name="message" value=""
                                        placeholder="Message"  >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" value=""
                                        placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email" value=""
                                        placeholder="email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="subject" name="subject" value=""
                                        placeholder="subject">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                            <button type="submit" value="submit" class="btn_3">
                                        Send
                                    </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>New Cairo, Cairo.</h3>
                                
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+0224923909</h3>
                                <p>Mon to Fri 9am to 6pm</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>e21691140@gmail.com</h3>
                                <p>Send us your Questions anytime!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- ================ contact section end ================= -->
    
    
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
        <script src="./../assets/js/main.js"></script><a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: none;"><i class="ti-arrow-up"></i></a>
        
    
    
    </body></html>