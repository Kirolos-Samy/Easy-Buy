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
                                  <a href="../../View/Admin/admin.php"><img src="../assets/img/logo/Logo.png" width="150px" hieght="50px"></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                     


                                            <li><a href="#" id="list">Account</a>
                                                <ul class="submenu" id="list">
                                                    <li><a href="../../View/Admin/admin.php">Manage Products</a></li>
                                                    <li><a href="../../View/Admin/ViewOrders.php">Manage Orders</a></li>
                                                    <li><a href="../../View/Admin/ManageUsers.php">Manage Users</a></li>
                                                    <li><a href="../../View/Admin/AddOperator.php">Add Operator</a></li>
                                                    <li><a href="../../View/Admin/loginAndSecurityForAdmin.php">Login & Security</a></li>
                                                    <li><a href="../../View/Customers/logout.php">Logout</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div> 
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">

                                    <?php 
                                   
                                   if(isset($_SESSION['username']) && $_SESSION['username'] != null){
                                    echo'<li class="d-none d-lg-block"> <a  class="btn header-btn"style="color:white; ">';
                                    echo $un;
                                   }
                                   else{
                                    echo'<li class="d-none d-lg-block"> <a href="../../View/Customers/login.php" class="btn header-btn">';
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

