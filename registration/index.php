<?php
session_start();

include('includes/config.php');
include('includes/db.php');
include('includes/functions.php');

if(loggedIn()){
    header("Location:myaccount.php");
    exit();
}
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($db , $_POST['email']);
    $password = mysqli_real_escape_string($db , $_POST['password']);
    
    $query = "select * from users where email='$email' and password='$password'";
    
    $result = $db->query($query);
    
    if($row = $result->fetch_assoc()){
        if($row['status'] == 1){
            $_SESSION['user_email'] = $email;
            if(isset($_POST['remember_me'])){
                setcookie("user_email" , $email , time()+60*5);
            }
            header("Location:myaccount.php");
            exit();
        }else {
            header("Location:index.php?err=" . urlencode("The user account is not activated!"));
            exit();
        }
    }else {
        header("Location:index.php?err=" . urlencode("Wrong Email or Password!"));
            exit();
    }
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

    <style>
      .navbar {
        background-color:  #1acc8d;
      }
    </style>
</head>
<style>
  body {
    background-color: #02a117;
  }
  </style>

  <!-- /* hr {
    
    background-color: green;
    
  } */ -->


<body class="login-page">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php">
                    <img src="vendors/images/favicon-32x32.png" alt="">
                   <b> Waste Mangement Nepal</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <style>
  .navbar-nav .nav-link {
    color: red;
  }
</style>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <b><a class="nav-link active" aria-current="page" href="../fe-garbaze/home.php" style="color: green;" >
            <u>About Waste Management Nepal</u></a></b>
        </li>
</ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <form class="d-flex">
        <button class="btn btn-outline-primary" type="submit"><a href="index.php">Login</a></button>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <button class="btn btn-outline-primary" type="submit"><a href="register.php">Register</a></button>  
      </form>
    </div>
   
    <style>
    .navbar-right {
			float: right;
      color: aqua;
    }
    </style>
   <div class="navbar navbar-right">
 <a href="admin.php" class="btn">Login as Admin</a> </div>
  </div>  
</nav> 
  
<!--navbar complete-->      
<!--second part-->
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="vendors/images/login-page-img.png" alt="">
                </div>
      <div class="col-md-6 col-lg-5">
                     <!--form-->>
                     <div class="login-box bg-white box-shadow border-radius-10">
                         <div class="login-title">
                             
  <hr>
                             <h2 class="text-center text-primary">Login</h2>
                         </div>

    
     <form action="index.php" method="post" style="margin-top:35px;">
        
         
         <?php if(isset($_GET['success'])) { ?>
         
         <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
         
         <?php } ?>
         
         <?php if(isset($_GET['err'])) { ?>
         
         <div class="alert alert-danger"><?php echo $_GET['err']; ?></div>
         
         <?php } ?>
         
         <hr>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password">
  </div>
 
  <div class="checkbox">
    <label>
      <input type="checkbox" name="remember_me"> Remember Me
    </label>
  </div>
  <button type="submit" name="login" class="btn btn-primary">Login</button>
  <a href="#">Forgot Password?</a>


    </div><!-- /.container -->
       
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
        
    </div>
         </div>
                           
                        </form>
                    </div>
                </div>
         </div>
         </div>
<!--footer -->
         <style>
  footer .copyright {
  border-top: 1px solid #197901;
  text-align: center;
  padding-top: 30px;
}
  footer .credits {
  padding-top: 10px;
  text-align: center;
  font-size: 13px;
  color: #fff;
}
</style>
         <footer>
        
    <div class="container">
      <div class="copyright">
        <b> &copy; Copyright <strong><span></span></strong>. All Rights Reserved </b>
      </div>
      <div class="credits">
        Designed by Waste-mgmt-group</a>
      </div>
    </div>
  </footer>
  <!-- End Footer -->   
          <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
    
</body>
</html>
  

