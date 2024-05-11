<?php
include '../../Controller/Mail.php';
include '../../Controller/database_validation.php';
include '../../Controller/PhoneRegex.php';
require "../../Controller/Db_connection.php";


session_start();
$fn;
$un;
$em;
$ps;
$pn;
$usernameErrMsg='';
$fullnameErrMsg='';
$passwordErrMsg='';
$phoneErrMsg='';
$ConfirmPasswordErrMsg='';
$emailErrMsg='';

if( isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["phonenumber"]) && isset($_POST["username"])&& isset($_POST["ConfirmPassword"])){
    if(!empty($_POST["fullname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["phonenumber"]) && !empty($_POST["username"])&& !empty($_POST["ConfirmPassword"])){

        if(is_numeric($_POST["fullname"])){
            $fullnameErrMsg='Name cant contain numbers';
            }
            else  if(strlen($_POST['password']) < 8 ){
            $passwordErrMsg='password must be 8 or more characters';
            }
            else if($_POST['password'] !== $_POST['ConfirmPassword'])
            {
            $ConfirmPasswordErrMsg='password doesnt match';
            }
            else if(!phoneValidation($_POST['phonenumber'])|| strlen($_POST['phonenumber']) != 11 ){
            $phoneErrMsg='Invalid PhoneNumber';
            }
            else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErrMsg = "Invalid email format";
            }
            else if(userNameDBValidation($conn)==1){
            $usernameErrMsg='UserName already exists';
            }
            else if(emailDBValidation($conn)==1){
            $emailErrMsg='Email already exists';
            }

    else{
        $fn=$_POST["fullname"];
        $em=$_POST["email"];
        $ps=$_POST["password"];
        $pn=$_POST["phonenumber"];
        $un=$_POST["username"];
        $activationCode= rand(100000,999999);
        $passwordHashed = password_hash($ps, PASSWORD_DEFAULT);
                $q = mysqli_query($conn,"INSERT INTO user (Name, Username, Email , Password, A_code, Pnumber) VALUES ('$fn', '$un', '$em',' $passwordHashed',' $activationCode','$pn')");
        $_SESSION['username'] =  $un;
        sendEmail($em,$un,"activation", "this is your activation code: $activationCode");
        header("Location: ../../View/Customers/Activation.php");
        die();
        }}
        else{
            if(empty($_POST['fullname'])){
                $fullnameErrMsg='fullname is Required!';}
            if(empty($_POST['username'])){
                $usernameErrMsg='username is Required!';}
            if(empty($_POST['email'])){
                $emailErrMsg='email is Required!';}
            if(empty($_POST['password'])){
                $passwordErrMsg='password is Required!';}
            if(empty($_POST['ConfirmPassword'])){
                $ConfirmPasswordErrMsg='password is Required!';}
            if(empty($_POST['phonenumber'])){
                $phoneErrMsg='phonenumber is Required!';}


        }}
?>


<!-----Lma tn2l L form 5od L names bta3t L form w input w submit---->



<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SignUp</title>
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
#SignupForm{
  padding-top:10%;
  margin:auto;


}

.errorMessage{
        color: red;
        font-weight: 100;
        font-size:12px;
}

.logo{
    width: 100%;
    align-items: center;
    margin: auto;
}

.logo img {
    width: 100%;
}

form{
        background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);

        width:100%;
        border-radius:8px;

     }
     h2{
        font-size:50px;
        color:white;
        padding-bottom: 5%;
        padding-left: 2%;
        padding-top: 5%;
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
    <header>
        <!-- Header Start -->

               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                            <div class="logo">
                                <a href="../../index.php"><img src="../assets/img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">

                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">

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

    <div class="col-lg-6 col-md-6" id="SignupForm">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">

                          <br>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                            <h2>Sign Up</h2>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="fullname" name="fullname" value=""
                                        placeholder="FullName">
                                        <span class="errorMessage"><?php echo $fullnameErrMsg?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="username" name="username" value=""
                                        placeholder="UserName" maxlength="20">
                                        <span class="errorMessage"><?php echo $usernameErrMsg?></span>
                                </div>

                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="email" value=""
                                        placeholder="Email">
                                        <span class="errorMessage"><?php echo $emailErrMsg?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value=""
                                        placeholder="Password">
                                        <span class="errorMessage"><?php echo $passwordErrMsg?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" value=""
                                        placeholder="ConfirmPassword">
                                        <span class="errorMessage"><?php echo $ConfirmPasswordErrMsg?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" value=""
                                        placeholder="Phone number" maxlength="11" >
                                        <span class="errorMessage"><?php echo $phoneErrMsg?></span>
                                </div>
                                <div class="col-md-12 form-group">
                                  <br>
                                    <button type="submit" value="submit" class="btn_3">
                                        Sign UP
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>



    <!-- slider Area Start-->

    <!-- slider Area End-->

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

</body>