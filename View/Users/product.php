<?php
session_start();
require "../../Controller/Db_connection.php";


if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $id=$_SESSION['id'];
    $un = $_SESSION['username'];
    $retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart ON product.ID=cart.Product_ID WHERE User_ID = '".$id."' ");
    $retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
    $numberofitemsincrt= mysqli_num_rows($retrievecartproducts);
}

if(isset($_GET['id']) ){
    unset($_SESSION['Search']);
    $categoryID=$_GET['id'];
    $sql = "SELECT * FROM product JOIN cate_product ON product.ID=cate_product.Product_ID WHERE Category_ID = '$categoryID' ";
    $sq = "SELECT * FROM category JOIN cate_product ON ID=cate_product.Category_ID WHERE Category_ID = '$categoryID' ";
    $result = $conn->query($sql);
    $result2 = $conn->query($sq);
    $row2 = $result2->fetch_assoc();
}

if (isset($_GET['Search'])){
    $cleanStr = preg_replace('/[^A-Za-z0-9]/', '', $_GET['Search']);
    $_SESSION['Search']=$cleanStr;
    header("location:product.php");
    die();
}

if(isset($_SESSION['Search'])){
    $search = $_SESSION['Search'];
    $sql= "SELECT * FROM product
    WHERE (Product_name LIKE '%".$search."%') ";
    $result = $conn->query($sql);
}




?>

<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Products</title>
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
                body {
    max-width: 98%;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: auto;
  text-align: center;
  font-family: arial;
  transition: transform 0.3s ease-in-out;
  width:300%;
  height:380px;
}

/* Hover effect for the card */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.price {
  color: grey;
  font-size: 22px;
}


.Category {
    display: inline-block;
    width: 32%;
    height: 30%;
    padding-left :8%;
    padding-bottom :5%;

     
}
h2 {
  position: absolute;

  opacity: 0;
  transition: .5s ease;

}

.Category-image:hover h2 {
  opacity: 1;
}
.Category-image:hover img{
    opacity: 0.5;
}
section img {
  width:100%;
  height: 400px; 
    margin-top: 7px;
  border-radius: 5px;  
  transition: 1s ease;

}  
section h2{ position: absolute;
  top: 50%;
  left: 130%;
  transform: translate(-50%, -50%);
  text-shadow: 5px 5px 10px black;
  font-family: Arial, Helvetica, sans-serif;
}

/* .card img {
        max-width: 100%;
margin: 5% auto;
margin-left: -15px;

} */
    .item-name {

        font-size: 18px;
        font-weight: bold;
        margin-left: -15px;
    }
    .item-price {
        font-size: 16px;
        margin-left: -15px;

    }
    .addToCart {
        width:80%;
        /* margin-left: -5px; */
        padding-bottom:5%;
        background-color: black;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.3);

    }   
    
    .addToCart:hover {
    background-color: #00b1ff;
    transition: background-color 0.3s ease; /* Change '0.3s' to your preferred duration */
}

            </style>
   </head>

   <body>
       
    

   <?php
        include "../assets/includes/uheader.php"
    ?>
    
    <main>
 
    
        <section class="category-area section-padding30" id="category">

            <div class="container-fluid">
                <!-- Category Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center mb-85">
                            <h1><?php
                            if(isset($row2['Categoryname'])){
                            
                            echo "Category : " . $row2['Categoryname'];
                        }
                            else{
                                echo ""; 
                            }
                                ?></h1>
                        </div>
                    </div>
                </div>

                <!-- Products Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center mb-85">
                            <h1 style="margin-top:-210px;">Products</h1>
                        </div>
                    </div>
                </div>

                <?php


while($row = $result->fetch_assoc()){
?>      
               <div class="Category">
                    <!------Card --->
                    <div class="col-xl-4 col-lg-6 rounded">
                        <div>
                        
                        <a href="Item.php?id=<?php echo $row['ID'];?>" >
                        
                        <div class="card">
                        <img src="<?php echo $row['Photo'];?>" style="width:230px;height:230px;">
                        <h5><?php echo $row['Product_name'];?></h5>
                        <p class="price"><?php echo $row['Price'];?>.LE</p></a>
                        <?php
                        if(isset($_SESSION['username']) && $_SESSION['username'] != null){
                            if($row['Quantity']==0){
                                ?>
                                <p class="mx-auto text-danger">Item is out of stock</p>
                                <?php
                            }
                            else{
                        if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM cart WHERE Product_ID='".$row['ID']."' AND USER_ID='".$id."'  "))){
                            ?>

                            <p class="mx-auto text-success">Added To Cart</p>
                            <?php
                        }
                        else{
                            ?>
                                <form method="POST">
                                    <input type="hidden" name="additemtocartwithbutton" value="<?php echo $row['ID']; ?>">
                                    <p style="position: relative; bottom: 0px;">
                                        <button type="submit" name="submitadditemtocartwithbutton" class="addToCart" data-product-id="<?php echo $row['ID']; ?>">Add to Cart</button>
                                    </p>
                                </form>
                            <?php
                        }}}
else{?>

<a href="../../View/Customers/login.php"><button class="addToCart">Add to Cart</button></a>

<?php
 
}

                        ?>
                        
                        </div>
                            
                            
                        </div>
                         <!------Card --->
                     </div>
                </div>
                <?php       
} 
?>
            </div>

        </section>
        <!-- Shop Method Start-->
        <div class="shop-method-area section-padding30">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-package"></i>
                            <h6>Free Shipping Method</h6>
                           
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-unlock"></i>
                            <h6>Secure Payment System</h6>
                            
                        </div>
                    </div> 
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-reload"></i>
                                                        <h6>Free Returns</h6>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Method End-->
        <!-- Gallery Start-->
        <div class="gallery-wrapper lf-padding">
            <div class="gallery-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="gallery-items">
                            <img src="../assets/img/gallery/gallery1.jpg" alt="">
                        </div> 
                        <div class="gallery-items">
                            <img src="../assets/img/gallery/gallery2.jpg" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="../assets/img/gallery/gallery3.jpg" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="../assets/img/gallery/gallery4.jpg" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="../assets/img/gallery/gallery5.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery End-->

    </main>
    
    <?php
        include "../assets/includes/footer.php"
    ?>
   
	<!-- JS here -->

    


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    $(document).on('click', '.addToCart', function(event) {
        event.preventDefault();
        
var productId = $(this).data('product-id');
var $addToCartBtn = $(this); // Reference to the button clicked

$.ajax({
    url: '../Customers/addToCart.php',
    type: 'POST',
    data: { additemtocartwithbutton: productId },

    success: function(response) {
        // Update cart count on success
        var cartCount = parseInt($('#cartCount').text());
        $('#cartCount').text(cartCount + 1);


        // Enable the button and revert its text after success
        $addToCartBtn.replaceWith('<p class="mx-auto text-success" style="margin-left: -15px;  ">Added To Cart</p>');



    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
        // Handle errors here if needed

        // Re-enable the button and reset its text on error
        $addToCartBtn.attr('disabled', false).text('Add to Cart');
    }
});
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
        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript">

</script>
        
    </body>
</html>