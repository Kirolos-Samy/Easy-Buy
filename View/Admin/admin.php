<?php
session_start();
require "../../Controller/Db_connection.php";

if(isset($_SESSION['username']) && $_SESSION['username'] != null){
$un = $_SESSION['username'];

$sq = "SELECT user_ID FROM user WHERE Username='$un' ";
$result = $conn->query($sq);
$row = $result -> fetch_assoc();

$ss = "SELECT * FROM `product` ORDER BY `product`.`Product_name` ASC";
$resultN = $conn->query($ss);

$ssc= "SELECT * FROM `category` ORDER BY `category`.`ID` ASC";
$resultC = $conn->query($ssc);

$id= $row['user_ID'];
$_SESSION['id']=$id;

$sqU = "SELECT * FROM user WHERE role!=1 ORDER BY role ASC";
$resultU = $conn->query($sqU);

// function addProduct($productName , $productPrice ,  $productQuantity , $productImage ,$productDesc) {
//   require "../../Controller/Db_connection.php";

//   // $targetDirectory = "./ProductIMGs/"; // Update this with your desired directory

//   // // Get the temporary uploaded file location
//   // $tempImage = $_FILES['ProductImage']['tmp_name'];
  
//   // // Get the original file name and extension
//   // $originalName = $_FILES['ProductImage']['name'];
//   // $extension = pathinfo($originalName, PATHINFO_EXTENSION);

//   // // Generate a unique name for the uploaded file using the original extension
//   // $targetImage = $targetDirectory . uniqid() . '.' . $extension;
  
//   // move_uploaded_file($tempImage, $targetImage);

//   $imgName = $productImage['name'];

//   $sql = "INSERT INTO product (Price, Product_name,  Quantity , Photo , Description) VALUES ('$productPrice', '$productName',  '$productQuantity', '$imgName  ', '$productDesc')";
//   $conn->query($sql); 
    
//   }
  

function addProduct($productName, $productPrice, $productQuantity, $productImage, $productDesc)
{
    require "../../Controller/Db_connection.php";

    // Create folder for images if not exist
    if(!is_dir("../images")){
      mkdir("../images");
    }

    // $targetDirectory = "ProductsIMGs/"; // Update this with your desired directory

    // Get the temporary uploaded file location
    // $tempImage = $productImage['tmp_name'];

    // Valid Image Extension
    $ext = strtolower(pathinfo($productImage['name'], PATHINFO_EXTENSION));
    // $validExension = ["png", "jpg", "jepg" , "bmp"];

    // Creating unique name for image
    $newName = uniqid().".".$ext; 
    $imagesrc = "../images/".$newName ;
    // $_POST['imagesrc'] = $imagesrc ;

    // Move image to the new location with the new name
    move_uploaded_file($productImage['tmp_name'], $imagesrc);

    $imagename = $productImage['name'];

    echo $imagename ;

    $sql = "INSERT INTO product (Price, Product_name, Quantity, Photo, Description) VALUES ('$productPrice', '$productName', '$productQuantity', '$imagesrc', '$productDesc')";
    $conn->query($sql);
    
}

function editProduct( $productPrice, $productQuantity,$productName,$productImage) {
  require "../../Controller/Db_connection.php";

  $q ="SELECT * FROM product WHERE Product_name = '$productName' ";
    $result1 = $conn->query($q);
    $row = $result1 -> fetch_assoc();
    $NumberofRows = mysqli_num_rows ($result1);
    if($NumberofRows>0){
      $productId= $row['ID'];
    $sql = "UPDATE product SET price='$productPrice', Quantity='$productQuantity' ,Photo='$productImage' WHERE id=$productId";
    $result2 = $conn->query($sql); }
    else{
    $productPriceErrMsg = "product doesnt exist";
    }  
  }
  



$productPriceErrMsg = "";
$productNameErrMsg = "";
$productStatusErrMsg = "";
$productQuantityErrMsg = "";
$productImageErrMsg = "";

if(isset($_POST["ProductPrice"]) && isset($_POST["ProductName"]) &&  isset($_POST["ProductQuantity"]) && isset($_FILES["ProductImage"])){
    if(!empty($_POST["ProductPrice"]) && !empty($_POST["ProductName"])  && !empty($_POST["ProductQuantity"])&& !empty($_FILES["ProductImage"])){
      if(!is_numeric($_POST["ProductPrice"])){
        $productPriceErrMsg = "Price must be Digits";
      }

      else if(!is_numeric($_POST["ProductQuantity"])){
        $productQuantityErrMsg = "must be Digits";  
      }

      else{
        $productPrice=$_POST["ProductPrice"];
        $productName=$_POST["ProductName"];
        $productQuantity=$_POST["ProductQuantity"];
        $productImage=$_FILES["ProductImage"];
        $productDesc=$_POST["ProductDesc"];

        // $productImage=$_POST["ProductImage"];

        if (isset($_POST['addProduct'])) {
            addProduct($productName,$productPrice, $productQuantity,$productImage,$productDesc);
            $categoryname = $_POST["Categoryname"];
            $sqs ="SELECT * FROM category WHERE  Categoryname='$categoryname'";
            $resultCC = $conn->query($sqs); 
            $row = $resultCC -> fetch_assoc();
            $Cid =$row["ID"];

            $sqp ="SELECT * FROM product WHERE  Product_name='$productName'";
            $resultP = $conn->query($sqp); 
            $rowP = $resultP -> fetch_assoc();
            $Pid = $rowP["ID"];

            $sqi= " INSERT INTO `cate_product` (`Category_ID`, `Product_ID`) VALUES ('$Cid', ' $Pid');";
            $resultI = $conn->query($sqi); 
        }
        else if(isset($_POST['editProduct'])){
            editProduct( $productPrice, $productQuantity,$productName,$productImage);
        }
        header("Location: ../../View/Admin/admin.php");
        die(); 
        }}
        else{
            if(empty($_POST['ProductName'])){
              $productNameErrMsg = "Product Name Required!";}
            if(empty($_POST['ProductPrice'])){
              $productPriceErrMsg = "Product Price Required!";}
            if(empty($_POST['ProductStatus'])){
                $emailErrMsg="Product Status Required!";}
            if(empty($_POST['ProductQuantity'])){
                $passwordErrMsg="Product Quantity Required!";}
            if(empty($_POST['ProductImage'])){
                $ConfirmPasswordErrMsg="Proudct Image Required!";} 

           
        }}}
else{
  header("Location: ../../View/Customers/login.php");
  die();
    }
    if(isset($_POST["ToggleUser"])){

     header("Location: ../../View/Admin/admin.php");
      die();
    }
?>


<!-----Lma tn2l L form 5od L names bta3t L form w input w submit---->

   
<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin DashBoard</title>
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

#myForm{
  /* padding-top:10%; */
  margin:auto;
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
     h4{
      color: white;
      font-size:20px;
      margin-top:
      30px;
     }
     form{
        background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);
        width:100%;
        border-radius:8px;
        margin-left: 500px;
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
        text-align: center;
     }
#list{
  margin-left:500%;
}

.center {
  margin-top: -30px; 
  text-align: center;
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

  <!-- slider Area Start-->
  <div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="../assets/img/hero/category.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h1 style="font-weight:bold; font-size:50px;">Manage Products</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- slider Area End-->

  <!--================Checkout Area =================-->
  <section class="checkout_area section_padding">
    <div class="container">
      <div class="billing_details">
        <div class="row">
          <!-- <div class="col-lg-8"> -->
          <div class="col-lg-8 col-md-6" id="myForm">
            <form class="row contact_form" action="#" method="POST" novalidate="novalidate" id="forms" enctype="multipart/form-data">
            <!-- <form class="row contact_form" action="#" method="POST" novalidate="novalidate" id="forms"> -->
              <h2 class="col-md-12">Add Product</h2>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="ProductName" name="ProductName" value="" placeholder="Product Name" />
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="ProductPrice" name="ProductPrice"  placeholder="Product Price"/>
                <span class="errorMessage"><?php echo $productPriceErrMsg?></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="ProductQuantity" name="ProductQuantity" value="" placeholder="Quantity" />

              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="ProductDesc" name="ProductDesc" value="" placeholder="Description" />
         
              </div>
              <div class="col-md-12 form-group p_star">
              <input class="form-control" name="ProductImage" type="file" id="formFile">

                <h4>Category :</h4>
              </div>

              
              <div class="col-md-6 form-group p_star">
              
<select   id="Categoryname" name="Categoryname" class="classic">
         <?php
         while($row3 = $resultC-> fetch_assoc()){
         ?> 
<option value="<?php echo $row3['Categoryname'] ?>"><?php echo $row3['Categoryname'] ?></option>
<?php
        }
         ?> 
</select>
</div>
              
              <div class="col-md-12 form-group">
                
              </div>
              <div class="col-md-12 form-group">
              <div class="col-md-12 form-group center">
                                  <br>
                                    <button type="submit" value="submit" class="btn_3" name="addProduct">
                                        Add
                                    </button>
                                    
                                </div>
              </div>
            </form>

            
            <form class="row contact_form" action="#" method="post" novalidate="novalidate"  id="forms" >
            <h2 class="col-md-12">Edit Product</h2>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="ProductPrice" name="ProductPrice"  placeholder="Product Price"/>
                <span class="errorMessage"><?php echo $productPriceErrMsg?></span>
              </div>
              <div class="col-md-6 form-group p_star">

                <select id="ProductName" name="ProductName" value="" placeholder="Product Name" class="classic">
                         <?php
                         while($row2 = $resultN -> fetch_assoc()){
                         ?> 
                <option value="<?php echo $row2['Product_name'] ?>"><?php echo $row2['Product_name'] ?></option>
                <?php
                        }
                         ?> 
        </select>
              </div>

              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="ProductQuantity" name="ProductQuantity" value="" placeholder="Product Quantity" />
                <span class="errorMessage"><?php echo $productQuantityErrMsg?></span>
              </div>
              <div class="col-md-12 form-group p_star">
                <input type="file" class="form-control" id="ProductImage" name="ProductImage"  value="" placeholder="Product Image"/>
                
              </div>

              <div class="col-md-12 form-group center">
                                  <br>
                                    <button type="submit" value="submit" class="btn_3" name="editProduct">
                                        Edit
                                    </button>

                                    
                                </div>
              </div>
            </form>
                                    
</div>
      </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->


<!-- JS here -->

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


</script> 
 <script>
//   let selectedRow;

// function selectRow(row) {
//   if (selectedRow) {
//     selectedRow.classList.remove("selected");
//   }
//   selectedRow = row;
//   row.classList.add("selected");
// }

// function sendSelectedRow() {
//   if (!selectedRow) {
//     return;
//   }
//   const username = selectedRow.cells[0].innerText;
//   const status = selectedRow.cells[2].innerText;

//   const xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function() {
//     if (xhr.readyState === XMLHttpRequest.DONE) {
//       if (xhr.status === 200) {

//       } 
//     }
//   };
//   xhr.open('POST', 'send-selected-row.php');
//   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   xhr.send('username=' + encodeURIComponent(username) + '&status=' + encodeURIComponent(status));
// const scrollPos = window.scrollY || window.scrollTop || document.getElementsByTagName("html")[0].scrollTop;
// location.reload();
// window.scrollTo(0, scrollPos);
// }

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

<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 library -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


 
</body>
</html>