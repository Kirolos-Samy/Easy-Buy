<?php
include '../../Controller/Mail.php';
include '../../Controller/database_validation.php';
include '../../Controller/PhoneRegex.php';
require "../../Controller/Db_connection.php";

$cityQuery= "SELECT * FROM `city`";
$cityResult = $conn->query($cityQuery);

session_start();

if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $un = $_SESSION['username'];
}

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
            else if(strlen($_POST['password']) < 8 ){
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
        $cityID=$_POST["CityID"];

        $activationCode= rand(100000,999999);
        $passwordHashed= md5($ps);
        $operatorQuery = mysqli_query($conn,"INSERT INTO user (Name, Username, Email , Password, A_code, Pnumber, Role) VALUES ('$fn', '$un', '$em',' $passwordHashed',' $activationCode','$pn','2')"); 
        // $_SESSION['username'] =  $un;

        // sendEmail($em,$un,"Activation", "This is your activation code: $activationCode");
        
        $getIdQuery = "SELECT user_ID FROM user WHERE Email='$em' ";
        $result = $conn->query($getIdQuery);
        $row = $result -> fetch_assoc();
        
        $id = $row['user_ID'];
        
        $operatorCityQuery = mysqli_query($conn,"INSERT INTO operator_city (operator_id, city_id) VALUES ('$id','$cityID')"); 
        header("Location: ../../View/Admin/admin.php");
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


<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add Operator</title>
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

form{
        background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);
        width:100%;
        border-radius:8px;
        margin-bottom: 500px;
        margin-top: -120px;

     }
     h2{
        font-size:50px;
        color:white;
        padding-bottom: 5%;
        padding-left: 2%;
        padding-top: 5%;
        margin: auto;
     }

     #myInput {
  width: 99%; 
  margin-left:0.5%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd; 
  margin-bottom: 12px; 
}

#table {
  border-collapse: collapse; /* Collapse borders */
  width: 100%; /* Full-width */
  font-size: 18px; /* Increase font-size */
}

#table th, #table td {
  text-align: left; /* Left-align text */
  padding: 12px; /* Add padding */
  color:White;
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


     /* #forms{
        background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);
        padding-top: 8%;
        width:100%;
        border-radius:8px;
        margin-left:200px;
        padding-bottom:20px;
     } */

     #Footer{
        padding-top:100px;
     }
#list{
  margin-left:500%;
}

</style>

</head> 


<?php
        include "../assets/includes/aheader.php"
    ?>



<div class="col-lg-6 col-md-6" id="SignupForm">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                          <br>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                            <h2>Add Operator</h2>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="fullname" name="fullname" value=""
                                        placeholder="FullName">
                                        <span class="errorMessage"><?php echo $fullnameErrMsg?></span>
                                </div>                                
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="email" value=""
                                        placeholder="Email">
                                        <span class="errorMessage"><?php echo $emailErrMsg?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="username" name="username" value=""
                                        placeholder="UserName" maxlength="20">
                                        <span class="errorMessage"><?php echo $usernameErrMsg?></span>
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

                                <div class="col-md-12 form-group p_star">
                                    <!-- <input class="form-control" name="ProductImage" type="file" id="formFile"> -->
                                    <h4 style='color:white;'>Choose City :</h4>
                                </div>

                                <div class="col-md-6 form-group p_star">
                                    <select  id="CityID" name="CityID" class="classic" multiple>
                                        <?php
                                            while($city = $cityResult-> fetch_assoc()){
                                        ?> 
                                            <option value="<?php echo $city['id'] ?>"><?php echo $city['city_name'] ?></option>
                                        <?php
                                            }
                                        ?> 
                                    </select>
                                </div>

                                <div class="col-md-12 form-group">
                                  <br>
                                    <button type="submit" value="submit" class="btn_3">
                                        Add Operator
                                    </button>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



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
 <script src="./../assets/js/jquery.magnific-popup.js"></script>

<!-- Scrollup, nice-select, sticky -->
 <script src="./../assets/js/jquery.scrollUp.min.js"></script>
 <script src="./../assets/js/jquery.nice-select.min.js"></script>
<script src="./../assets/js/jquery.sticky.js"></script>
 
 <!-- contact js -->
 <script src="./../assets/js/contact.js"></script>
 <script src="./../assets/js/jquery.form.js"></script>
 <script src="./../assets/js/jquery.validate.min.js"></script>
 <script src="./../assets/js/mail-script.js"></script>
 <script src="./../assets/js/jquery.ajaxchimp.min.js"></script>
 
<!-- Jquery Plugins, main Jquery -->	
 <script src="./../assets/js/plugins.js"></script>
 <script src="./../assets/js/main.js"></script>

<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 library -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>