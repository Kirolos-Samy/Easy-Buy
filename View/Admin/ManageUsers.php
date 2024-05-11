<?php
session_start();
require "../../Controller/Db_connection.php";

if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    $un = $_SESSION['username'];

    $getIdQuery = "SELECT user_ID FROM user WHERE Username='$un' ";
    $result = $conn->query($getIdQuery);
    $row = $result -> fetch_assoc();
    $id= $row['user_ID'];
    $_SESSION['id']=$id;


    $getUsersQuery = "SELECT * FROM user WHERE role!=1 ORDER BY role ASC";
    $resultU = $conn->query($getUsersQuery);

    // if(isset($_POST["ToggleUser"])){
    //     header("Location: ../../View/Admin/ManageUsers.php?rand=" . rand());
    //     die();
    // }
}



?>

<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Manage Users</title>
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


     #forms{
        background-image: linear-gradient(109.6deg, rgb(20, 30, 48) 11.2%, rgb(36, 59, 85) 91.1%);
        padding-top: 8%;
        width:100%;
        border-radius:8px;
        margin-left:200px;
        padding-bottom:20px;
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
  margin-left:30%;
  font-size:40px;
  color: white;
}


#list{
  margin-left:500%;
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
    <!-- <div class="single-slider slider-height2 d-flex align-items-center" data-background="../assets/img/hero/category.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h1 style="font-weight:bold; font-size:50px;">Admin Page</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div> -->
  <!-- slider Area End-->

  <!--================Checkout Area =================-->
  <section class="checkout_area section_padding">
    <div class="container" style="margin-top: -190px;">
      <div class="billing_details">
        <div class="row">
          <div class="col-lg-8">
            
<div id="forms">

<h2>Manage Users</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
<table id="table" >
  <tr class="header">
    <th>Username</th>
    <th>Role</th>
    <th>Status</th>
  </tr>
  <?php
  while($row3 = $resultU -> fetch_assoc()){
  ?>
  <tr onclick="selectRow(this)" style="cursor: pointer;">
    <td><?php echo $row3['Username'];  ?></td>
    <td><?php  if($row3['Role']==0){
      echo "User";

}
else if($row3['Role']==2){
  echo "Operator";
}

      ?></td>
    <td><?php  if($row3['Status']==1){
      echo "Active";

}
else{
  echo "Not Active";
}

      ?></td>
  </tr>
  <?php
  }

  ?>
</table>

<button name="ToggleUser"  class="btn_3" onclick="sendSelectedRow()" style="margin-left:30px; margin-top:30px; "> 
                                        Toggle User
                                    </button>
                                    
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
  let selectedRow;

function selectRow(row) {
  if (selectedRow) {
    selectedRow.classList.remove("selected");
  }
  selectedRow = row;
  row.classList.add("selected");
}

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
// location.reload();
// window.scrollTo(0, scrollPos);
// }

function sendSelectedRow() {
  if (!selectedRow) {
    return;
  }
  const username = selectedRow.cells[0].innerText;
  const status = selectedRow.cells[2].innerText;

  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        //   setTimeout(function() {
              location.reload();
        //   }, 0); // Add a delay of 1 second (adjust as needed)
        const response = xhr.responseText;
        if (response === 'success') {
          // Update UI accordingly (e.g., change the status of the selected row)
          selectedRow.cells[2].innerText = (status === 'Active') ? 'Not Active' : 'Active';

        } else {
          // Handle other responses or errors from the server
        }
      } else {
        // Handle other HTTP status codes
      }
    }
  };
  xhr.open('POST', 'send-selected-row.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('username=' + encodeURIComponent(username) + '&status=' + encodeURIComponent(status));
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

<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 library -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


</body>
</html>