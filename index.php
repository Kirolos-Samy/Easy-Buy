<?php
    session_start();

    require "./Controller/Db_connection.php";
    if(isset($_SESSION['username']) && $_SESSION['username'] != null){
        $un = $_SESSION['username'];
        $sq = "SELECT user_ID FROM user WHERE Username='$un' ";
        $result = $conn->query($sq);
        $row = $result -> fetch_assoc();
        $id= $row['user_ID'];
        $_SESSION['id']=$id;
        $retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart ON product.ID=cart.Product_ID WHERE User_ID = '".$id."' ");
        $retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
        $numberofitemsincrt= mysqli_num_rows($retrievecartproducts);
        $SQR= "SELECT * FROM category join cate_product on category.ID = cate_product.Category_ID join cart on cate_product.Product_ID=cart.Product_ID WHERE user_ID= $id LIMIT 3";
        $result = $conn->query($SQR);
        $rowcount=mysqli_num_rows($result);
        if($rowcount<1){
            $sql = "SELECT * FROM category LIMIT 3";
            $result = $conn->query($sql);
        }
        }
        else{
            $sql = "SELECT * FROM category LIMIT 3";
            $result = $conn->query($sql);
        
        }
        if (isset($_GET['Search'])){
            $cleanStr = preg_replace('/[^A-Za-z0-9]/', '', $_GET['Search']);
            $_SESSION['Search']=$cleanStr;
            header("location:./View/Users/product.php");
            die();
        }

?>

<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Home</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="./View/assets/img/favicon.ico">
            <link rel="stylesheet" href="./View/assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="./View/assets/css/owl.c   arousel.min.css">
            <link rel="stylesheet" href="./View/assets/css/flaticon.css">
            <link rel="stylesheet" href="./View/assets/css/slicknav.css">
            <link rel="stylesheet" href="./View/assets/css/animate.min.css">
            <link rel="stylesheet" href="./View/assets/css/magnific-popup.css">
            <link rel="stylesheet" href="./View/assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="./View/assets/css/themify-icons.css">
            <link rel="stylesheet" href="./View/assets/css/slick.css">
            <link rel="stylesheet" href="./View/assets/css/nice-select.css">
            <link rel="stylesheet" href="./View/assets/css/style.css">
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
  width: 250%;
  height:380px;
  margin-left: 45px;
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

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 80%;
  font-size: 18px;
  border-radius:8px;
}

.card button:hover {
  opacity: 0.7;
}
.Category {
    display: inline-block;
    width: 32%;
    height: 30%;
    padding-left :8%;
    padding-bottom :5%;

     
}


.Category-image:hover img{
    opacity: 0.5;
}

.Category {
    display: inline-block;
    width: 33%;
    height: 30%;
    padding-left :4%;
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
  width:300%;
  height: 400px; 
 margin-top: 7px;
  transition: 1s ease;

}    
section h2{ position: absolute;
  top: 50%;
  left: 130%;
  transform: translate(-50%, -50%);
  text-shadow: 5px 5px 10px black;
  font-family: Arial, Helvetica, sans-serif;
}

#message {
  text-align: center;
  width: max-content;
  margin: 0 auto 20px ;
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
        include "./View/assets/includes/uheader.php"

    ?>


    <main>
    
    <!-- Order Placed Successfully message -->
        <?php
            if (isset($_SESSION['orderplaced'])) {
                echo '<div class="alert alert-success" id="message" role="alert">
                    <h6 class="m-0 mx-0">' . $_SESSION['orderplaced'] . '</h6>
                </div>';
                unset($_SESSION['orderplaced']); // Clear the message after displaying it
            }
        ?>
    <!-- --------------------------------- -->

        <!-- slider Area Start -->
        <div class="slider-area "style="width: 100%; height: 700px;">
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div class="single-slider slider-height" >
                    <div class="container">
                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                                <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                    <img src="./View/assets/img/hero/dress.png" alt="" style="width: 750px; height: 700px;">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8">
                                <div class="hero__caption">
                                    <span data-animation="fadeInRight" data-delay=".4s">60% Discount</span>
                                    <h1 data-animation="fadeInRight" data-delay=".6s">Summer <br> Collection</h1>
                                    <p data-animation="fadeInRight" data-delay=".8s">Best Cloth Collection By 2023!</p>
                                    <!-- Hero-btn -->
                                    <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                        <a href="./View/Users/product.php?id=2" class="btn hero-btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- slider Area End-->
        <!-- Category Area Start-->
        <section class="category-area section-padding30" id="category">
            <div class="container-fluid">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center mb-85">
                            <h1 style="margin-bottom:-50px;;">Recomended categories for you</h1>
                        </div>
                    </div>
                </div>
               
        <section class="category-area section-padding30" id="category">


    <?php

while($row = $result->fetch_assoc()){
?>      
    <div class="Category">
        <div class="col-xl-4 col-lg-6">
            <div>
            <a href="./View/Users/product.php?id=<?php echo $row['ID'];?>" >
                <div class="Category-image">
                    <img src="<?php echo $row['C_Photo'];?>" alt="" style="border: 4px solid Black;
box-shadow: 5px 5px 5px 5px #888888;  border-radius: 8px;  ">
                    <div class="category-caption">
                        <h2><?php echo $row['Categoryname'];?></h2>
                    </div>
                </div>
                
                </a>
                
            </div>
        </div>
    </div>
    <?php       
} 
?>
</div>
</section>
</section>
        <!-- Category Area End-->
        <!-- Latest Products Start -->
       
                    <!-- Section Tittle -->
                    <div class="col-xl-4 col-lg-5 col-md-5 mx-auto">
                        <div class="section-tittle mb-30 mx-auto">
                            <h1 class="mx-auto" style="padding-left:23%;">Latest Products</h1>
                        </div>
                    </div>
                    <section>
                    <?php
$sql=" SELECT * FROM `product` ORDER BY `product`.`ID` DESC limit 6";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>      
               <div class="Category">
                    <!------Card --->
                    <div class="col-xl-4 col-lg-6 rounded">
                        <div>
                        
                        <a href="./View/Users/Item.php?id=<?php echo $row['ID'];?>" >
                        
                        <div class="card">
                        <?php
                            // To Fix the relative path of image
                            // Replace "../images"
                            //      With "./View/images"

                            $imgname = $row['Photo'];
                            // Check if the first two characters are ".." and replace them with "./View"
                            if (substr($imgname, 0, 2) === "..") {
                                $imgname = str_replace("..", "./View", $imgname);
                            }
                        ?>
                        <img src="<?php echo $imgname;?>" style="width:230px;height:230px;">
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

                            <a href="./View/Customers/login.php"><button class="add-to-cart" style="margin-left:-12px;">Add to Cart</button></a>
                            
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
?></section>
        </section>
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
                            <img src="./View/assets/img/gallery/gallery1.jpg" alt="">
                        </div> 
                        <div class="gallery-items">
                            <img src="./View/assets/img/gallery/gallery2.jpg" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="./View/assets/img/gallery/gallery3.jpg" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="./View/assets/img/gallery/gallery4.jpg" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="./View/assets/img/gallery/gallery5.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery End-->

    </main>

    <?php
        include "./View/assets/includes/footer.php"
    ?>

	<!-- JS here -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        $(document).on('click', '.addToCart', function(event) {
            event.preventDefault();
            
    var productId = $(this).data('product-id');
    var $addToCartBtn = $(this); // Reference to the button clicked

    $.ajax({
        url: './View/Customers/addToCart.php',
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
        <script src="./View/assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./View/assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./View/assets/js/popper.min.js"></script>
        <script src="./View/assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./View/assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./View/assets/js/owl.carousel.min.js"></script>
        <script src="./View/assets/js/slick.min.js"></script>

		<!-- One Page, Animated-HeadLin -->
        <script src="./View/assets/js/wow.min.js"></script>
		<script src="./View/assets/js/animated.headline.js"></script>
        <script src="./View/assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./View/assets/js/jquery.scrollUp.min.js"></script>
        <script src="./View/assets/js/jquery.nice-select.min.js"></script>
		<script src="./View/assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./View/assets/js/contact.js"></script>
        <script src="./View/assets/js/jquery.form.js"></script>
        <script src="./View/assets/js/jquery.validate.min.js"></script>
        <script src="./View/assets/js/mail-script.js"></script>
        <script src="./View/assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="./View/assets/js/plugins.js"></script>
        <script src="./View/assets/js/main.js"></script>
        
    </body>
</html>