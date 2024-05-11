<?php
//include '../../Controller/Mail.php';
include '../../Controller/database_validation.php';
include '../../Controller/PhoneRegex.php';
require "../../Controller/Db_connection.php";

session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $id=$_SESSION['id'];
    $un = $_SESSION['username'];
    $retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart ON product.ID=cart.Product_ID WHERE User_ID = '".$id."' ");
$retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
$numberofitemsincrt= mysqli_num_rows($retrievecartproducts);
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
        
        header("location: ../../View/Customers/Address&Payments.php");
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

        if( isset($_POST["CreditCardNumber"]) && isset($_POST["Nameoncard"]) && isset($_POST["ExpirationMonth"]) && isset($_POST["ExpirationYear"])){
            if(!empty($_POST["CreditCardNumber"]) && !empty($_POST["Nameoncard"]) && !empty($_POST["ExpirationMonth"]) && !empty($_POST["ExpirationYear"])){

          $exy=$_POST["ExpirationYear"];
          $ccn=$_POST["CreditCardNumber"];
          $noc=$_POST["Nameoncard"];
          $exm=$_POST["ExpirationMonth"];
         
         $year= date("Y");
         $month = (int)date('m');

              if(!is_numeric($ccn) || strlen($ccn) != 16 ){
                $creditCardnumberErrMsg='Invalid CreditCardNumber';
                }
                    else if(is_numeric($noc)){
                      $nameoncardErrMsg='Name cant contain numbers';
                        }
                        else if(($year == $exy && $month > $exm) ||(int)$exm > 12){
                           $expirationdateErrMsg ='Invalid CreditCard';
                       }
                       else if ($year+12 <= $exy || $year>$exy) {
                        $expirationdateErrMsg ='Invalid CreditCard';
                 }        
         
              else{
                
                  $v = mysqli_query($conn,"INSERT INTO `biling info` (`Credit Card Number`, `user_ID`, `EX.Month`, `Ex.year`,`name on card`)
                   VALUES (' $ccn','$id', '$exm', '$exy',' $noc' )");
              
              header("location: ../../View/Customers/Address&Payments.php");
              die();
                  }
                      }
                    
  
                else{
                    if(empty($_POST['CreditCardNumber'])){
                        $creditCardnumberErrMsg='Credit Card Number is Required!';}
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

    .invisible-cell {
  display: none;
}


     #Footer{
        padding-top:100px;
     }
     h4{
      color: white;
      font-size:20px;
      margin-top:
      30px;
     }
h2{
  padding-bottom:5%;
  padding-top:5%;
  margin-left:30%;
  font-size:40px;
  color: rgb(20, 30, 48);
}
#list{
  margin-left:500%;
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
        include "../assets/includes/secheader.php"
    ?>
    
  <!-- slider Area Start-->
  <div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="../assets/img/hero/category.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Address & Payments</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- slider Area End-->

  <!--================Checkout Area =================-->
 
  <!--================End Checkout Area =================-->
 <!------------------------------------------------------------------->
  <div class="inline">
  <div >
    <div class="card mb-4">
      <div class="card-body">
      <section class="checkout_area section_padding">
    <div class="container">
      <div class="Shipping Details">
        <div class="row">
          <div class="col-lg-8">
            <h3>Shipping Details</h3>
            <form class="row contact_form" action="#" method="post" novalidate="novalidate" id="forms">
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="Fullname" name="Fullname"  value="" placeholder="Full Name"/>
                                        
                                        <span class="errorMessage"><?php echo $fullnameErrMsg?></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="Phonenumber" name="Phonenumber"  placeholder="Phone number" maxlength="11" />
                <span class="errorMessage" ><?php echo $phonenumberErrMsg?></span>
                
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="City" name="City" value="" placeholder="City" />
                <span class="errorMessage"><?php echo $cityErrMsg?></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="district" name="district" value="" placeholder="District" />
                <span class="errorMessage"><?php echo $districtErrMsg?></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="Street" name="Street" value="" placeholder="Street" />
                <span class="errorMessage"><?php echo $streetErrMsg?></span>
              </div>
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" id="Buildingnumber" name="Buildingnumber"  value="" placeholder="Building number"/>
                <span class="errorMessage"><?php echo $buildingnumberErrMsg?></span>
              </div>
              
              
              

              <div class="col-md-12 form-group">
                                  <br>
                                    <button type="submit" value="submit" class="btn_3">
                                        Submit
                                    </button>
                                    
                                </div>

            </form>

            <h3>Credit Card Details</h3>
            <form class="row contact_form" action="#" method="post" novalidate="novalidate" id="forms"> 
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="CreditCardNumber" name="CreditCardNumber"  value="" placeholder="Credit Card Number" maxlength="16">
                                        
                                        <span class="errorMessage"><?php echo $creditCardnumberErrMsg;
                                                                         echo $expirationdateErrMsg;                           ?></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="Nameoncard" name="Nameoncard" value="" placeholder="Name on card"/>
                <span class="errorMessage" ><?php echo $nameoncardErrMsg?></span>
                
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="ExpirationMonth" name="ExpirationMonth" value="" placeholder="ExpirationMonth" maxlength="2">
                <span class="errorMessage" ><?php echo $expirationmonthErrMsg;?></span>
                
              </div>

              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="ExpirationYear" name="ExpirationYear" value="" placeholder="Expiration Year" maxlength="4">
                <span class="errorMessage"><?php echo $expirationyearErrMsg?></span>
              </div>
   
              <div class="col-md-12 form-group">
                                  <br>
                                    <button type="submit" value="submit" class="btn_3">
                                        Submit
                                    </button>
                                    
                                </div>

            </form>
             </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card mb-4">
      
      <div class="card-body">
      <div >
        <h5 class="mb-0">Personal Addresses:</h5>
        </div>

      <form style="color:white;"> 
              <div id="forms">
              <table id="table" >
                <tr class="header">
                  <th>Addresses</th>
                </tr>
                <?php
                foreach($ADDRESS as $Valus):

                            ?>
                <tr onclick="selectRow(this)">
                  <td class="invisible-cell"><?php   echo  $Valus['AddressId'] ;?></td>
                  <td>                      <?php   echo ( $Valus['Building number'].'  '.$Valus['Street'].'  '. $Valus['district'] .'  '.$Valus['City'] );?></td>
              
                </tr>
                <?php
                            endforeach;
              
              
                ?>
              </table>
              
              <button class="btn_3" name="addressDelete" onclick="sendSelectedRow('shiping info')" style=" margin-top:30px; "> 
  delete
</button>
                                                  
              </div>  
              
             
                



     </form>

<!-------Credit Cards Section---------------->
<div>
<h5 class="mx-2" > Credit Cards:</h5> 
  </div>
        <form> 
        <div id="forms">
<table id="table" >
  <tr class="header">
    <th>CreditCard</th>
  </tr>
  <?php
            foreach($creditcards as $ccard):
              ?>
  <tr onclick="selectRow(this)">
     <td class="invisible-cell"><?php echo $ccard['BillingId'] ; ?></td>
    <td>XXXX XXXX XXXX <?php echo substr($ccard['Credit Card Number'], -4) ; ?></td>

  </tr>
  <?php
              endforeach;


  ?>
</table>
<button class="btn_3" name="creditDelete" onclick="sendSelectedRow('biling info')" style=" margin-top:30px; "> 
  delete
</button>
</div>   
        </form>

        
      </div>
      
    </div>
    

    
  </div>
</div>
<!------------------------------------------------------------------->
    <?php
        include "../assets/includes/footer.php"
    ?>            
	<!-- JS here -->
  <script>
let selectedRow;

function selectRow(row) {
  if (selectedRow) {
    selectedRow.classList.remove("selected");
  }
  selectedRow = row;
  row.classList.add("selected");
}

function sendSelectedRow(buttonId) {
  if (!selectedRow) {
    return;
  }
  const id = selectedRow.cells[0].innerText;
  const type = buttonId;

  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        alert("ID: " + id + ", Type: " + type + " sent successfully!");
      } else {
       // alert('Error deleting row');
      }
    }
  };
  xhr.open('POST', 'delete-row.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('id=' + encodeURIComponent(id) + '&type=' + encodeURIComponent(type));

  const scrollPos = window.scrollY || window.scrollTop || document.getElementsByTagName("html")[0].scrollTop;
  location.reload();
  window.scrollTo(0, scrollPos);
}

window.addEventListener("beforeunload", function () {
  sessionStorage.setItem("scrollPos", window.scrollY || window.pageYOffset);
});

window.addEventListener("load", function () {
  const scrollPos = sessionStorage.getItem("scrollPos") || 0;
  window.scrollTo(0, scrollPos);
});

 </script>
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