<?php
session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/functions.php');

if(!loggedIn()){
    header("Location:index.php?err=" . urlencode("You need to login to View account!!"));
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garbage Collection Management</title>

     <!-- Bootstrap core CSS -->
     <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
 

</head>

<body class="login-page"; style="background-color: #148c38;">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php">
                    <img src="vendors/images/deskapp-logo.png" alt="">
                    Waste Mangement Nepal
                </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
</ul>

    </div>
  </div>
</nav> 
<!-- navbar complete -->
<!--- sidebar-->
   
<div id="container">
  <div id="sidebar">
    <div class="list">
      <h4>Waste</h4>
      <a href="myaccount.php">
        <img src="house.svg" alt="Waste Icon" class="icon">
        <p class="text">Return To home page</p>
      </a>
    </div>

    <div class="list">
      <h4>New Request</h4>
      <a href="newrequest.php">
        <img src="hand-index.svg" alt="New Request Icon" class="icon">
        <p class="text">Submit a new request</p>
      </a>
    </div>

    <div class="list">
      <h4>Clients' Book</h4>
      <a href="orderbook.php">
        <img src="book.svg" alt="Order History Icon" class="icon">
        <p class="text">View your order history</p>
      </a>
    </div>

    <div class="list">
      <h4>Logout</h4>
      <a href="logout.php">
        <img src="box-arrow-right.svg" alt="Logout Icon" class="icon">
        <p class="text">Log out of your account</p>
      </a>
    </div>
  </div>

  <div id="main-content">
    <!-- Your main content here -->

<!-- second part start-->

    <div class="container">
<br>

    	<div class="jumbotron">
			<h2>Welcome <?php  if(isset($_SESSION['user_email'])) {echo $_SESSION['user_email'];} else echo $_COOKIE['user_email']; ?></h2>
		</div>
    </div><!-- /.container -->


  

  <!-- four box here -->

  <div style="display: flex; flex-wrap: wrap; justify-content: center;">
  

  <div style="background-color:white; width: 280px; height: 150px; margin: 20px; text-align: center;">
  <a href="orderbook.php">
    <i data-feather="tag" class="fa fa-television" style="color: black; font-size: 30px;padding-top: 50px; "></i>
    <h2 style="color: black; font-size: 20px; padding-top: 20px; padding-down: 10px;">Clients' Book</h2>
  </div>

  <div style="background-color: white; width: 280px; height: 150px; margin: 20px; text-align: center;">
  <a href="newrequest.php">
    <i data-feather="tag" class="fa fa-diamond" style="color: black; font-size:30px;padding-top: 50px;"></i>
    <h2 style="color: black; font-size: 20px; padding-top: 20px; padding-down: 10px; ">New Request</h2>
</a>
  </div>

  <div style="background-color: white; width: 280px; height: 150px; margin: 20px; text-align: center;">
  <a href="logout.php">
    <i data-feather="tag" class="fa fa-user-plus" style="color: black; font-size:30px;padding-top: 50px;"></i>
    <h2 style="color: black; font-size: 20px; padding-top: 20px; padding-down: 10px;">Logout</h2>
</a>
  </div>
</div> 
</div>
</div>  

<!-- 
-->
  
<footer style="width: 100%; display: flex; justify-content: center; padding-top:5px">
  <p style="color: black; font-size: 15px; text-align: center;">
    All Rights Reserved. Waste-Mgmt-Group
  </p>
</footer>
       
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    
  </body>
</html>
