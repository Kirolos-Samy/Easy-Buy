<?php 
    require "../../Controller/Db_connection.php";

    include '../../Controller/database_validation.php';
    include '../../Controller/PhoneRegex.php';
    include '../../Controller/ActivationSet.php';
    session_start();
    $usernameErrMsg='';
    $fullnameErrMsg='';
    $passwordErrMsg='';
    $phoneErrMsg='';
    $ConfirmPasswordErrMsg='';
    $emailErrMsg='';

if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $id=$_SESSION['id'];
    $un = $_SESSION['username'];
    $_SESSION['username'] =  $un;

    $sql = "SELECT *  FROM user WHERE User_ID='$id' ";
    $result = $conn->query($sql);
    $row = $result -> fetch_assoc();


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

                else{
                    $fn=$_POST["fullname"];
                    $em=$_POST["email"];
                    $ps=$_POST["password"];
                    $pn=$_POST["phonenumber"];
                    $un=$_POST["username"];
                    $ql =  "UPDATE user SET Name = '$fn' ,Password='$ps' , Pnumber='$pn' WHERE user_ID = $id";
                    $result = $conn->query($ql);
                }
            
            
            
            
            }

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
    


}
        else{
            header("Location: ../../View/Customers/login.php");
            die();
        }
?>


   
<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login and security </title>
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
        color: White;
        font-weight: 100;
        font-size:12px;
                 }
     #loginandsecurity{
        width: 50%;
        margin-left: 20%;

                      }

     form{
        background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);
        padding-top: 8%;
        width:100%;
        border-radius:8px;
        padding-left:27.5%;
        padding-bottom:20px;
     }

     #Footer{
        padding-top:100px;
     }
    h2{
     padding-bottom:10%;
     margin-left:25%;
     
     color: rgb(20, 30, 48);
    }  h4{
     padding-bottom:10%;

     color: White;
    }

    .loginAndSecurity{
    flex-wrap: wrap;
    padding-left: 20%;
    margin: 10%;

    }
    #list{
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
                                  <a href="../../View/Admin/admin.php"><img src="../assets/img/logo/Logo.png" width="150px" hieght="50px"></a>
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






                                <div>
    <div class="col-lg-6 col-md-6" id="loginandsecurity">
                    <div class="loginAndSecurity">
                    <h2>login and security <br></h2>
                    

                        <div class="">
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star" id="Input">
                                  <label><h4> fullname </h4><label>
                                    <input type="text" class="form-control"  name="fullname" 
                                    value="<?php echo  $row["Name"]?>">
                                    <span class="errorMessage"><?php echo $fullnameErrMsg?> <br></span>

                                   

                                </div>
                                <div class="col-md-12 form-group p_star">
                                <label> <h4>username</h4><label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                    value="<?php echo  $row["Username"]?>"readonly>
                                    <span class="errorMessage"><?php echo $usernameErrMsg?><br></span>
 
                                    

                                </div>
                             
                                <div class="col-md-12 form-group p_star">
                                <label><h4>email</h4> <label>
                                    <input type="text" class="form-control" id="email" name="email" 
                                    value="<?php echo  $row["Email"]?>"readonly>
                                    <span class="errorMessage"><?php echo $emailErrMsg?> <br></span>

                                    

                                </div>
                                <div class="col-md-12 form-group p_star">
                                <label> <h4>password</h4><label>
                                    <input type="password" class="form-control" id="password" name="password" 
                                    value="<?php echo  $row["Password"]?>">
                                 <span class="errorMessage"><?php echo $passwordErrMsg?><br></span> 
                               
                                </div>
                                <div class="col-md-12 form-group p_star">
                                <label> <h4>Confirm Password</h4><label>
                                    <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" value="<?php echo  $row["Password"]?>"
                                       >
                                        <span class="errorMessage"><?php echo $ConfirmPasswordErrMsg?></span>    
                                </div>
                                <div class="col-md-12 form-group p_star">
                                <label><h4>phone number</h4> <label>
                                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" 
                                    value="<?php echo  $row["Pnumber"]?>" maxlength=11>
                                  <span class="errorMessage"><?php echo $phoneErrMsg?><br></span>
                                  


                                </div>
                                <div class="col-md-12 form-group">
                                  <br>
                                    <button type="submit" value="edit" class="btn_3" style=" margin-left:10%;">
                                       edit
                                    </button>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                </div>









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