<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '/xampp/htdocs/registration/PHPMailer-master/src/Exception.php';
require '/xampp/htdocs/registration/PHPMailer-master/src/PHPMailer.php';
require '/xampp/htdocs/registration/PHPMailer-master/src/SMTP.php';
$mail = new PHPMailer(true);
?>

<?php
session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/functions.php');


if(loggedIn()){
    header("Location:myaccount.php");
    exit();
}

function isUnique($email){
    $query = "select * from users where email='$email'";
    global $db;
    
    $result = $db->query($query);
    
    if($result->num_rows > 0){
        return false;
    }
    else return true;
    
}

if(isset($_POST['register'])){
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['confirm_password'] = $_POST['confirm_password'];
    
    if(strlen($_POST['name'])<3){
        header("Location:register.php?err=" . urlencode("The name must be at least 3 characters long"));
        exit();
    }
   else if($_POST['password'] != $_POST['confirm_password']){
        header("Location:register.php?err=" . urlencode("The password and confirm password do not match"));
        exit();
   }
    else if(strlen($_POST['password']) < 5){
         header("Location:register.php?err=" . urlencode("The password should be at least 5 characters"));
        exit();
    }
  
    else if(!isUnique($_POST['email'])){
        header("Location:register.php?err=" . urlencode("Email is already in use. Please use another one"));
        exit();
    }
   
    else {
        $name = mysqli_real_escape_string($db , $_POST['name']);
        $email = mysqli_real_escape_string($db , $_POST['email']);
        $password = mysqli_real_escape_string($db , $_POST['password']);
        $token = bin2hex(openssl_random_pseudo_bytes(32));

        //Mail sender
        try {
          $mail->SMTPDebug = SMTP::DEBUG_OFF;
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'wastemgmtnpl@gmail.com';
          $mail->Password = 'vqsgnvezckqihmmd    '; //gmail app token
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;
      
          $mail->setFrom('wastemgmtnpl@gmail.com ', 'waste mgmt');
          $mail->addAddress($email, $name); 
      
          $mail->isHTML(true);
          $mail->Subject = 'Activation Email';
          $mail->Body = "Hi $name! Account created here is the activation link http://localhost/registration/activate.php?token=$token";
          $mail->send();
          echo 'Message sent!';
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
        //Mail sender
        $query = "insert into users (name,email,password,token) values('$name','$email','$password','$token')";
        
        $db->query($query);
        // $message = "Hi $name! Account created here is the activation link http://localhost/registration/activate.php?token=$token";
        
        mail($email , 'Activate Account' , $message , 'From: suminakdk057@gmail.com');
        header("Location:index.php?success=" . urlencode("Activation Email Sent!"));
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

<!-- navbar started -->
<style>
      .navbar {
        background-color:  #1acc8d;
      }
    </style>
</head>
<style>
  body {
    background-color: #179a43;

  }
  </style>
<body class="login-page">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <a class="navbar-brand" href="index.php">
                    <img src="vendors/images/favicon-32x32.png" alt="">
                    <b>Waste Mangement Nepal</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
&nbsp;
      <form class="d-flex">
    <button class="btn btn-outline-primary" type="submit"><a href="index.php">Login</a></button>&nbsp; &nbsp; &nbsp;  
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
<a href="../fe-garbaze/home.php" class="btn">About Us</a>
  </div>
  </div>
</nav> 
<!-- navbar complete -->

    <div class="container">
        
     <form  action="register.php" method="post" style="margin-top:35px;">
         <h2 style="text-align: center;"> Register Here</h2>
         
         <?php if(isset($_GET['err'])) { ?>
         
         <div class="alert alert-danger"><?php echo $_GET['err']; ?></div>
         
         <?php } ?>
         <hr>
         <style>
         hr {
    
    background-color: green;
    
  } 
  </style>
         <div class="form-group">
    <label>Name:</label>
    <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo @$_SESSION['name']; ?>" required>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo @$_SESSION['email']; ?>" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo @$_SESSION['password']; ?>" required>
  </div>
 
 <div class="form-group">
    <label >Confirm Password</label>
    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo @$_SESSION['confirm_password']; ?>" required>
  </div>
  <button type="submit" name="register" class="btn btn-primary">Register</button>
</form>
   </div>
   <br>
   <!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
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
  </body>
</html>

