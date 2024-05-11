<?php 
session_start();
require "../../Controller/Db_connection.php";

if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $id=$_SESSION['id'];
    $un = $_SESSION['username'];
    $retrievecartproducts=mysqli_query($conn,"SELECT * FROM product JOIN cart ON product.ID=cart.Product_ID WHERE User_ID = '".$id."' ");
    $retrievedata = mysqli_fetch_all($retrievecartproducts,MYSQLI_ASSOC);
    $numberofitemsincrt= mysqli_num_rows($retrievecartproducts);
    // $conn = mysqli_connect('localhost','root','','e-commerce');
if(!$conn){
    echo 'Error In Database connection';
}

$Orderid="";
$date="";
$cost="";
$status="";
if(isset($_GET['id']) ){
    $OrderID=$_GET['id'];
    $orders ="SELECT * FROM orderdetails join ordert on orderdetails.Order_Id =ordert.Order_ID join product on orderdetails.Product_Id=product.ID WHERE user_ID= $id and orderdetails.Order_Id= $OrderID;";
    $userorders = $conn->query($orders);
    
}

}
else{
    header("Location: ../../View/Customers/login.php");
    die();
}?>
<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Orders </title>
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
        color: red;
        font-weight: 100;
        font-size:12px;
                 }
    
    .orders{
        margin-top: 7%;
        padding-left: 5%;
        padding-right: 5%;

     }      
    .rows{
        margin-top: 3%;
        margin-right: 20%;
        
    }
    #cartnumafter::before{
          content:"<?php echo $numberofitemsincrt ?>";
        }
    
    #list{
border-radius:8px;
background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);
width:90%;


}
h6{
    color:white;
    font-size:20px;
    padding-left:10px;
}
.orders{
    padding-left:20%;
}
h2{
    padding-left:30%; 
}

 

        </style>
</head> 

<body>



<?php
        include "../assets/includes/uheader.php"
    ?>
    
    <div class="orders">
        <h2>Order Details</h2>
        <div class="properties__button">

         </div>

        <div class="tab-content" id="nav-tabContent">

                    <!-- card one -->
                   
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="rows" >   

                        <li class="list-group-item d-flex justify-content-between lh-sm m-2 rounded" 
                        style=" 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"
                         style="border:2px solid gray;" id="list">

                        <div class="row d-flex justify-content-center align-items-center  m-0" >  
                        <?php
                         while( $uporder = $userorders->fetch_assoc()){
                            ?>                                 

                 <div id="details">
   
          
                    <img src="<?php echo $uporder['Photo'];?>" alt="" style="  border-radius: 8px; padding: 10px; width: 200px;">
                    <h6>product name: <?php echo $uporder['Product_name']."<br>"; ?></h6>
                    <h6>Quantity: <?php echo $uporder['QuantityD']."<br>"; ?></h6>
                    <a href=" ../../View/Users/Item.php?id=<?php echo $uporder['Product_Id'];?>" style="color: yellow;    padding-left:10px;">view your item</a>
                            <br>
 


                 
                </div>
                <?php
                           }
                        ?>   
                        </div>
                       
                        

                        </li>

                        
                    </div>    
    </div>
                
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