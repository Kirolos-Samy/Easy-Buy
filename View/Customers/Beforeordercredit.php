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


        if( isset($_POST["CreditCardNumber"]) && isset($_POST["Nameoncard"]) && isset($_POST["ExpirationMonth"]) && isset($_POST["ExpirationYear"])){
            if(!empty($_POST["CreditCardNumber"]) && !empty($_POST["Nameoncard"]) && !empty($_POST["ExpirationMonth"]) && !empty($_POST["ExpirationYear"])){
          $t=time();
          $exy=$_POST["ExpirationYear"];
          $ccn=$_POST["CreditCardNumber"];
          $noc=$_POST["Nameoncard"];
          $exm=$_POST["ExpirationMonth"];
         
         $year= date("Y");
         $month = date('m');

              if(!is_numeric($ccn) || strlen($ccn) != 16 ){
                $creditCardnumberErrMsg='Invalid CreditCardNumber';
                }
                    else if(is_numeric($noc)){
                      $nameoncardErrMsg='Name cant contain numbers';
                        }
                       else if ($year+12 <= $exy || $year>$exy) {
                        $expirationdateErrMsg ='Invalid CreditCard';
                 }        else if($year == $exy && $month<$exm ){
                    $expirationdateErrMsg ='Invalid CreditCard';
                }
         
              else{
                
                  $v = mysqli_query($conn,"INSERT INTO `biling info` (`Credit Card Number`, `user_ID`, `EX.Month`, `Ex.year`,`name on card`)
                   VALUES (' $ccn','$id', '$exm', '$exy',' $noc' )");
              
              header("location: ../../View/Customers/Checkout.php");
              die();
                  }
                      }
                    
  
                else{
                    if(empty($_POST['CreditCardNumber'])){
                        $creditcardnumberErrMsg='Credit Card Number is Required!';}
                    if(empty($_POST['Nameoncard'])){
                        $nameoncardErrMsg='Name on card is Required!';}
                    if(empty($_POST['ExpirationMonth'])){
                        $expirationmonthErrMsg='Expiration Month is Required!';}
                    if(empty($_POST['ExpirationYear'])){
                        $expirationyearErrMsg='Expiration Year is Required!';}
                   
                    }    } 

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
.errorMessage{
        color: white;
        font-weight: 100;
        font-size:12px;
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
<h5 class="mx-auto" style="font-size: 30px;padding:20px;"> Credit Cards:</h5> 
  </div>
  <form class="row contact_form w-50 mx-auto" action="#" method="post" novalidate="novalidate" id="forms"> 
    
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="CreditCardNumber" name="CreditCardNumber" value="" placeholder="Credit Card Number" maxlength="16">
                                        
                <span class="errorMessage"></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="Nameoncard" name="Nameoncard" value="" placeholder="Name on card">
                <span class="errorMessage"></span>
                
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="ExpirationMonth" name="ExpirationMonth" value="" placeholder="ExpirationMonth" maxlength="2">
                <span class="errorMessage"></span>
                
              </div>

              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="ExpirationYear" name="ExpirationYear" value="" placeholder="Expiration Year" maxlength="4">
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