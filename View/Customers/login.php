<?php 
session_start();
require "../../Controller/Db_connection.php";
require '../../Controller/database_validation.php';
require '../../Controller/ActivationSet.php';

$usernameErrMsg='';
$passwordErrMsg='';
$passwordLengthErrMsg='';
$activationErrMsg='';
if(isset($_POST['name'])&& isset($_POST['password']))
{
    $passwordlength=$_POST['password'];
if(!empty($_POST['password'] )&& strlen($passwordlength )< 8 && !empty($_POST['name'] )  ){
        
    $passwordLengthErrMsg= 'Invalid Password cant be less than 8 characters!';}
    else
        {

    if(!empty($_POST['name']) && !empty($_POST['password']))
    {
        $un = $_POST['name'];
        if( usernameEXISTValidation($un,$conn)){
            $sql = "SELECT Password,Status,Role FROM user WHERE Username='$un'";
            $result = $conn->query($sql);
            $row = $result -> fetch_assoc();
            $input_password = $_POST['password'];
            $stored_password = trim($row['Password']); // Trim to remove spaces
            
            $result = password_verify($input_password, $stored_password);
            
            if($result) {
                

                if($row["Status"]==1){
                    if($row["Role"]==1){
                        $_SESSION['username'] =  $un;
                        header("Location: ../../View/Admin/admin.php");
                        exit();
                    }   
                    else if($row["Role"]==2){
                        $_SESSION['username'] =  $un;
                        header("Location: ../../View/Operator/operator.php");
                        exit();
                    }   
            else{
                $_SESSION['username'] =  $un;
                header("Location: ../../index.php");
                exit();
            }
            
            
            }
                else{
                    $_SESSION['username'] =  $un;
                    activation($un);
                }
            }
            else{
                $passwordErrMsg='Wrong Password!';  
            }
        }
        else{
            $usernameErrMsg='Username Doesnt Exist!';
        }
    
}
      else{
        if(empty($_POST['name'])){
        $usernameErrMsg='Username is Required!';}
        if(empty($_POST['password'])){
        $passwordErrMsg='Password is Required!';}
        }     
}}

?>
<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/favicon.ico">
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
     .logo{
     position: fixed; 
     padding-left: 45%; 
    margin-top: 3%;
                }

              .activationBTN{
                border:none;
                font-size:12px;
                text-decoration: none;
                background-color: white;
                color:red;
            }
                

        </style>
</head> 

<body>

    <header>
        <!-- Header Start -->

               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                <a href="../../index.php"><img src="../assets/img/logo/Logo2_footer.png" alt=""width="150px" hieght="50px"></a>
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

    <!-- slider Area Start-->

    <!-- slider Area End-->

    <!--================login_part Area =================-->
    <section class="login_part section_padding ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>New to our Shop?</h2>
                            <p></p>
                            <a href="../../View/Users/signup.php" class="btn_3">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back ! <br>
                                Please Sign in now</h3>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="name" name="name" value=""
                                        placeholder="Username">
                                        <span class="errorMessage"><?php echo $usernameErrMsg;?>
                                        </span>
                                        <br>
                                       
                                    </button> 
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value=""
                                        placeholder="Password">
                                        <span class="errorMessage" ><?php echo $passwordErrMsg;
                                                                            echo $passwordLengthErrMsg;
                                        ?></span>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Remember me</label>
                                    </div>
                                    <button type="submit" value="submit" class="btn_3">
                                        log in
                                    </button>
                                    <a class="lost_pass" href="#">forget password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->

    <?php
        include "../assets/includes/footer.php"
    ?>

<!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="././assets/js/vendor/modernizr-3.5.0.min.js"></script>
    
    <!-- Jquery, Popper, Bootstrap -->
    <script src="././assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="././assets/js/popper.min.js"></script>
    <script src="././assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="././assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="././assets/js/owl.carousel.min.js"></script>
    <script src="././assets/js/slick.min.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="././assets/js/wow.min.js"></script>
    <script src="././assets/js/animated.headline.js"></script>
    
    <!-- Scrollup, nice-select, sticky -->
    <script src="././assets/js/jquery.scrollUp.min.js"></script>
    <script src="././assets/js/jquery.nice-select.min.js"></script>
    <script src="././assets/js/jquery.sticky.js"></script>
    <script src="././assets/js/jquery.magnific-popup.js"></script>

    <!-- contact js -->
    <script src="././assets/js/contact.js"></script>
    <script src="././assets/js/jquery.form.js"></script>
    <script src="././assets/js/jquery.validate.min.js"></script>
    <script src="././assets/js/mail-script.js"></script>
    <script src="././assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="././assets/js/plugins.js"></script>
    <script src="././assets/js/main.js"></script>

</body>
    
</html>