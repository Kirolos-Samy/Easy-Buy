<?php
//include '../../Controller/Mail.php';
include '../../Controller/database_validation.php';
include '../../Controller/PhoneRegex.php';
require "../../Controller/Db_connection.php";

session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $id=$_SESSION['id'];
    $un = $_SESSION['username'];

$fullnameErrMsg='';
$phonenumberErrMsg='';
$cityErrMsg='';
$districtErrMsg='';
$streetErrMsg='';
$buildingnumberErrMsg='';

$creditCardnumberErrMsg='';
$nameoncardErrMsg='';
$expirationyearErrMsg='';
$expirationmonthErrMsg='';
$expirationdateErrMsg='';
// $conn = mysqli_connect('localhost','root','','estoredbtesting');
if( isset($_POST["Fullname"]) && isset($_POST["Phonenumber"]) && isset($_POST["City"])&& isset($_POST["district"]) && isset($_POST["Street"]) && isset($_POST["Buildingnumber"])){
    if(!empty($_POST["Fullname"]) && !empty($_POST["Phonenumber"]) && !empty($_POST["City"])&& !empty($_POST["district"]) && !empty($_POST["Street"]) && !empty($_POST["Buildingnumber"])){
        if(is_numeric($_POST["Fullname"])){
            $fullnameErrMsg='Name cant contain numbers';
            }
            else if(!phoneValidation($_POST['Phonenumber']) || strlen($_POST['Phonenumber']) != 11 ){
            $phonenumberErrMsg='Invalid Phone Number';
            }
            else if (is_numeric($_POST["City"])){
                $cityErrMsg='Name cant contain numbers';
                }
            else if (is_numeric($_POST["district"])){
                  $cityErrMsg='Name cant contain numbers';
                  }
            else if (is_numeric($_POST["Street"])){
                    $streetErrMsg='Name cant contain numbers';
                    }
            else if (!is_numeric($_POST["Buildingnumber"])){
                    $buildingnumberErrMsg='Invalid buildingnumber';
            }
          
      else{
        $fn=$_POST["Fullname"];
        $pn=$_POST["Phonenumber"];
        $c=$_POST["City"];
        $d=$_POST["district"];
        $s=$_POST["Street"];
        $bn=$_POST["Buildingnumber"];
        

      
        $q = mysqli_query($conn,"INSERT INTO `shipping info` (`user_ID`, `Full name`, `Phone number`, `City`, `district`, `Street`, `Building number`)
         VALUES ('$id', ' $fn', ' $pn', '$c', '$d', '$s', '$bn')");
        
        header("location: ../../View/Customers/Checkout.php");
        die();
        }}
        else{
            if(empty($_POST['Fullname'])){
                $fullnameErrMsg='Full name is Required!';}
            if(empty($_POST['Phonenumber'])){
                $phonenumberErrMsg='username is Required!';}
            if(empty($_POST['City'])){
                $cityErrMsg='city is Required!';}
            if(empty($_POST['district'])){
                $districtErrMsg='district is Required!';}
            if(empty($_POST['Street'])){
                $streetErrMsg='password is Required!';} 
            if(empty($_POST['Buildingnumber'])){
                $buildingnumberErrMsg='phonenumber is Required!';}
           
           
        }}

      

    }
                  else{
                    header("Location: ../../View/Customers/login.php");
                    die();
                } 

         
//Retrieve Credit Cards From DB
$creditcardsq=mysqli_query($conn,"SELECT * FROM `biling info` WHERE user_ID='".$id."'  ");
$creditcards = mysqli_fetch_all($creditcardsq,MYSQLI_ASSOC);
//$creditcarddeletesq=mysqli_query($conn,"DELETE FROM `biling info` WHERE Status='"FALSE"'  ");
$ADDRESSsq_2=mysqli_query($conn,"SELECT * FROM `Shipping info`  WHERE user_ID='".$id."' ");
$ADDRESS= mysqli_fetch_all($ADDRESSsq_2,MYSQLI_ASSOC);


$retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart ON product.ID=cart.Product_ID WHERE User_ID = '".$id."' ");
$retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
$numberofitemsincrt= mysqli_num_rows($retrievecartproducts);

//Retrieve User Addresses to check if there exist any addresses or not 
$addressesQuery=mysqli_query($conn,"SELECT * FROM `shipping info` WHERE user_ID='".$id."'  ");
$numberOfAddresses = mysqli_num_rows($addressesQuery);

?>




<!-----Lma tn2l L form 5od L names bta3t L form w input w submit---->

<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Address&Payments</title>
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
#cartnumafter::before{
          content:"<?php echo $numberofitemsincrt ?>";
        }


#forms{
  background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);
padding-top: 3.5%;
width:100%;
border-radius:8px;
padding-left: 10px;
padding-right: 10px;
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
.errorMessage{
        color: white;
        font-weight: 100;
        font-size:12px;
                 }

#err {
  text-align: center;
  width: max-content;
  margin: 0 auto 20px ;
}

        </style>
</head>

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
    
  <!-- slider Area Start-->
 
  <!-- slider Area End-->

  <!--================Checkout Area =================-->
 
  <!--================End Checkout Area =================-->
  <div class="d-flex mx-auto m-0 py-0">
    
<h5 class="mx-auto" style="font-size: 30px;padding:20px;"> Shipping Details:</h5> 
  </div>


<!-- Check if user has no addresses -->
<?php
    if($numberOfAddresses == 0){
        echo '<div class="alert alert-danger" id="err" role="alert">
        <h6 class="m-0 mx-0">You must enter one address at least !</h6>
        </div>';
    }
?>

  <form class="row contact_form w-50 mx-auto" action="#" method="post" novalidate="novalidate" id="forms">
            <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="Fullname" name="Fullname" value="" placeholder="Full Name">
                                        
                                        <span class="errorMessage"></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="Phonenumber" name="Phonenumber" placeholder="Phone number" maxlength="11">
                <span class="errorMessage"></span>
                
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="City" name="City" value="" placeholder="City">
                <span class="errorMessage"></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="district" name="district" value="" placeholder="District">
                <span class="errorMessage"></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="Street" name="Street" value="" placeholder="Street">
                <span class="errorMessage"></span>
              </div>
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" id="Buildingnumber" name="Buildingnumber" value="" placeholder="Building number">
                <span class="errorMessage"></span>
              </div>
              
              
              

              <div class="col-md-12 form-group">
                                  <br>
                                    <button type="submit" value="submit" class="btn_3">
                                        Submit
                                    </button>
                                    
                                </div>

            </form>
<!------------------------------------------------------------------->
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
      
</body>

</html>