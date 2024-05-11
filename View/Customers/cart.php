

<?php
session_start();
require "../../Controller/Db_connection.php";

if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $USERID=$_SESSION['id'];
    $un = $_SESSION['username'];


$errormsg='';
$total=0;
    



$retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart  ON  product.ID = cart.Product_ID  WHERE User_ID = '".$USERID."'");
$retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
$numberofitemsincrt= mysqli_num_rows($retrievecartproducts);
$price =0 ;
foreach($retrievecartproducts as $row){
  $price +=  $row['Quantity']*$row['Price'];
}

if(isset($_POST['pro-checkout'])  )
  

  
  
  
  
 {
  foreach($retrievedata as $cartitem)
{
  if($cartitem['Quantity']==0){
    $errormsg='Item  Is Out Of Stock , You Got All Of Them!';
    break;
  }
  else {
    header('location: ./Checkout.php');
    $_SESSION['user_total'] = $total;
  }
}


}


}
else{
  header("Location: ../../View/Customers/login.php");
  die;
}




?>
<!doctype html>
<html lang="zxx">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Cart</title>
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
        /** CArt Number On Shoping Cart Icon **/
        #cartNumAfter::before{
          content:none;
        }
#cartCount{
    position: absolute;
    content: "02";
    width: 25px;
    height: 25px;
    background: #00b1ff;
    color: #fff;
    line-height: 25px;
    text-align: center;
    border-radius: 30px;
    font-size: 12px;
    top: 0px;
    right: -6px;
    -webkit-transition: all 0.2s ease-out 0s;
    -moz-transition: all 0.2s ease-out 0s;
    -ms-transition: all 0.2s ease-out 0s;
    -o-transition: all 0.2s ease-out 0s;
    transition: all 0.2s ease-out 0s;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
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
        include "../assets/includes/secheader.php"
    ?>


  <!----------------------------------- Cart Section-------------------------------------->
  <section class="pb-4 w-75 mx-auto " style="margin-top: 30px;">
  <div class="m-4 bg-white border rounded-5" style="box-shadow: grey 0px 0px 5px;border-radius:15px">
    
    <section class="w-100 px-3 py-5 mx-auto rounded-3" style="background-color: white; border-radius: 10px;">
      <div class="row d-flex justify-content-center">
        <div class="col-xl-11">

          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-normal mb-0 text-black mx-auto" >Your Shopping Cart</h3>
            
          </div>
          <div id="empty_Cart">
        
        <!---------cartLOOP------------>
        
        <?php

        if(!$retrievedata){
            echo '<div class="alert alert-primary" role="alert">
            <h6 class="m-0 mx-0">Your Cart Is Empty So Far.</h6>
          </div>';
        }
        if($errormsg){
          echo '<div class="alert alert-warning" role="alert">
          <h6 class="m-0 mx-0">'. $errormsg.'</h6>
        </div>';
      }
      foreach($retrievedata as $cartitem):
        
            ?>
            
            <!---------------------CARD----------------------->
            <div class='card'>
          <div class="card rounded-3 mb-4">
            <div class="card-body p-4 rounded-5">
              <div class="row d-flex justify-content-between align-items-center rounded-5">
                <div class="col-md-2 col-lg-2 col-xl-2">
                  <img src="<?php  echo $cartitem['Photo'] ?>" class="img-fluid rounded-3" alt="<?php echo $cartitem['Product_name'] ?>">
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3">
                  <p class="lead fw-normal mb-2"><?php echo $cartitem['Product_name'] ?></p>
                  <!-- <p class="mx-0" style="color:red;"><?php echo $errormsg; ?></p> -->
                </div>
                
                <div class="col-md-3 col-lg-3 col-xl-3 d-flex">
                
  <!-- Increment Button -->
<form method="POST">
    <input type="hidden" name="cartincprid" value="<?php echo $cartitem['Product_ID'] ?>">
    <button class="btn btn-link p-1 m-1 incrementButton" data-product-id="<?php echo $cartitem['Product_ID'] ?>" name="cartinc" onclick="bindIncrementButton()">
        <i class="fas fa-plus"></i>
    </button>
</form>

<input  id="<?php echo $cartitem['Product_ID'] ?>" min="0" name="cartincprquantity" value="<?php echo $cartitem['Quantity'] ?>" type="text" class="form-control form-control-md w-25">

<form method="POST">
    <input type="hidden" name="cartdecprid" value="<?php echo $cartitem['Product_ID'] ?>">
    <button class="btn btn-link p-1 m-1 decrementButton" data-product-id="<?php echo $cartitem['Product_ID'] ?>" name="cartdec" onclick="bindDecrementButton()">
        <i class="fas fa-minus"></i>
    </button>
</form>
                  
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h6  style="font-family: 'Open Sans', sans-serif;" >Unit Price:<?php echo   $cartitem['Price']  ?></h6>
                </div>


                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                    <form method="POST">
                    <input type="hidden" name="cartdel" value="<?php echo $cartitem['Quantity'] ?>">

                        <input type="hidden" name="cartiddel" value="<?php echo $cartitem['Product_ID'] ?>">
                        <button style="width:33px;height:33px;background-color:transparent;border:none;cursor:pointer;"  onclick="bindDeleteButton()" type="submit" class="deleteButton" name="cartitemdelbutton" data-product-id="<?php echo $cartitem['Product_ID'] ?>" ><i class="fas fa-trash fa-lg" style="color: red;"></i></button>
                    </form>
                  
                </div>
              </div>
            </div>
</div>
</div>
        <!---------------------CARD----------------------->
        
            <?php

        endforeach;

        ?>
</div>
          <form method="POST">
          <div class="d-flex align-items-end flex-column">
            <p class="lead fw-normal " id="totalPrice">Total : <?php echo $price ; $_SESSION['user_total']=$price; ?></p>
            
            <button type="submit" class="w-50 btn btn-warning btn-block btn-md" style="box-shadow: grey 0px 0px 5px;" name="pro-checkout">Proceed to Checkout?</button><!---Ordering Page here -->
            
          </div>
              </form>
            
          

        </div>
      </div>
    </section>
    
    
    

    
    
  </div>
</section>
<!----------------------------------- Cart Section-------------------------------------->
<?php
        include "../assets/includes/footer.php"
    ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function bindIncrementButton() {
    $(document).on('click', '.incrementButton', function(event) {
        event.preventDefault();
        var productId = $(this).data('product-id');
        var name = 'cartinc';
        var quantity = document.getElementById(productId).value;
                console.log(quantity);
        $.ajax({
            url: 'cartManipulation.php',
            type: 'POST',
            data: {
                productId: productId,
                name: name,
                quantity: quantity
            },
            success: function(response) {
              var jsonResponse = JSON.parse(response);
              var updatedQuantity = jsonResponse.quantityOfItems;
              var quantityInput = document.getElementById(productId);
              var totalPrice = jsonResponse.totalPrice;
                quantityInput.value = updatedQuantity;
                var price= document.getElementById('totalPrice');
                price.textContent = "Total : " + totalPrice;

            },
            error: function(xhr, status, error) {
                console.error('Error occurred while incrementing:', error);
                console.log(xhr.responseText);
            }
        });
    });
}




function bindDecrementButton() {
$(document).on('click', '.decrementButton', function(event) {
    event.preventDefault();
    
    var productId = $(this).data('product-id');
    var name = 'cartdec';
    var quantity = document.getElementById(productId).value;
    var cardToDelete = $(this).closest('.card'); 
    var emptyCart=document.getElementById('empty_Cart');


        $.ajax({
        url: 'cartManipulation.php',
        type: 'POST',
        data: { productId: productId,
                name: name,
                quantity:quantity
              },
              success: function(response) {
    

    console.log(response);

    var jsonResponse = JSON.parse(response);
    var numberOfItems = jsonResponse.numberOfItems;
    var updatedQuantity = jsonResponse.quantityOfItems;
    
    var quantityInput = document.getElementById(productId);
    var totalPrice = jsonResponse.totalPrice;
                if(quantityInput!=null){
                quantityInput.value = updatedQuantity;}
                var price= document.getElementById('totalPrice');
                price.textContent = "Total : " + totalPrice;

          $('#cartCount').text(numberOfItems); // Update the displayed count
          if(numberOfItems==0){
            emptyCart.innerHTML = `
    <div class="alert alert-primary" role="alert">
        <h6 class="m-0 mx-0">Your Cart Is Empty So Far.</h6>
    </div>
`;

          }
            if (updatedQuantity == 0){
              cardToDelete.innerHTML =` `;
              cardToDelete.remove();
              
            }
        },
        error: function(xhr, status, error) {
            // Handle errors here
        }
    });

});
}

// Example AJAX call for incrementing cart quantity
function bindDeleteButton() {
    $(document).on('click', '.deleteButton', function(event) {
        event.preventDefault();
        
        var productId = $(this).data('product-id');
        var name = 'cartitemdelbutton';
        var quantity = $(this).siblings('input[name="cartdel"]').val();

        var cardToDelete = $(this).closest('.card'); // Find the closest card element to the button clicked
        var emptyCart = document.getElementById('empty_Cart');

        $.ajax({
            url: 'cartManipulation.php',
            type: 'POST',
            data: {
                productId: productId,
                name: name,
                quantity: quantity
            },
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                var updatedQuantity = jsonResponse.quantityOfItems;
                var totalPrice = jsonResponse.totalPrice;

                var price = document.getElementById('totalPrice');
                price.textContent = 'Total : ' + totalPrice; // Update the total price displayed

                var numberOfItems = jsonResponse.numberOfItems;
                cardToDelete.innerHTML =` `;
                cardToDelete.remove();
                $('#cartCount').text(numberOfItems); // Update the displayed count
                if (numberOfItems == 0) {
                  emptyCart.innerHTML = `
    <div class="alert alert-primary" role="alert">
        <h6 class="m-0 mx-0">Your Cart Is Empty So Far.</h6>
    </div>
`;

                }
            },
            error: function(xhr, status, error) {
                // Handle errors here
            }
        });
    });
}

function rebindFunctions() {
    bindIncrementButton();
    bindDecrementButton();
    bindDeleteButton();
}

// Initial binding
rebindFunctions();
</script>

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