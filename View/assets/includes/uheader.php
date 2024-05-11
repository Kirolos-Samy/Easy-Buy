<header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">

               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                  <a href="../../../../Easy Buy/index.php"><img src="../../../../Easy Buy/View/assets/img/logo/Logo.png" width="150px" hieght="50px"></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                     
                                            <li><a href="../../../../Easy Buy/index.php">Home</a></li>
                                            <li><a href="../../../../Easy Buy/View/Users/categories.php">Categories</a></li>
                                            <?php 
                                            if(isset($_SESSION['username']) && $_SESSION['username'] != null){
                                    echo'<li><a href="#">Account</a>
                                    <ul class="submenu">
                                        <li><a href="../../../../Easy Buy/View/Customers/loginAndSecurity.php">Login & security</a></li>
                                        <li><a href="../../../../Easy Buy/View/Customers/Orders.php">Orders</a></li>
                                        <li><a href="../../../../Easy Buy/View/Customers/Address&Payments.php">Payments & Address</a></li>
                                        <li><a href="../../../../Easy Buy/View/Customers/logout.php">Logout</a></li>
                                    </ul>
                                </li>';
                                
                                   }
 ?>
         
                                            <li><a href="../../../../Easy Buy/View/Customers/contact.php">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div> 
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                <form action="#" method="get" >
                                    <li class="d-none d-xl-block">
                                        <div class="form-box f-right ">
                                            <input type="text" name="Search" placeholder="Search products" >
                                            <div class="search-icon">
                                                
                                                <i class="fa fa-search"></i>
                                                
                                            </div>
                                        </div>
                                     </li>
                                     </form>
                                    <li>
                                    <div class="shopping-card" id="cartNumAfter">
                                        <a href="../../../../Easy Buy/View/Customers/cart.php"><i class="fa fa-shopping-cart" style="font-size:24px"></i></a>
                                        <span id="cartCount"><?php if(isset($_SESSION['username']) && $_SESSION['username'] != null){ echo $numberofitemsincrt;}
                                        else echo 0; ?></span>
                                    </div>                                        
                                    </li>
                                    <?php 
                                   
                                   if(isset($_SESSION['username']) && $_SESSION['username'] != null){
                                    echo'<li class="d-none d-lg-block"> <a  class="btn header-btn"style="color:white; ">';
                                    echo $un;
                                   }
                                   else{
                                    echo'<li class="d-none d-lg-block"> <a href="../../../../Easy Buy/View/Customers/login.php" class="btn header-btn">';
                                    echo "Sign in";
                                } 
                                   ?>
                                   </a></li>
                                </ul>
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
<style>
    
    
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


    