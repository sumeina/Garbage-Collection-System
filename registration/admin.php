<?php
// start a session to store user data
session_start();

// connect to the database
$conn = mysqli_connect("localhost", "root", "", "registration");

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the username and password from the form data
    $name = $_POST["name"];
    $password = $_POST["password"];

    // query the admin table to check if the username and password are correct
    $sql = "SELECT name, password FROM admin WHERE name='$name' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // if the query returns one row, the username and password are correct
    if (mysqli_num_rows($result) == 1) {
        // store the username in the session variable
        $_SESSION["name"] = $name;

        // redirect to the dashboard page
        header("Location: admindashboard.php");
        exit();
    } else {
        // if the username and password are incorrect, display an error message
        
    }
}

// close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
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
  </head>
<body>
<!-- navbar started -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <a class="navbar-brand" href="index.php">
                    <img src="vendors/images/favicon-32x32.png" alt="">
                    <b>Waste Mangement Nepal</b> </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">     
    </div>
    <style>
      .navbar {
        background-color:  #1acc8d;
      }
    </style>
<div class="navbar navbar-right">
<a href="../fe-garbaze/home.php" class="btn">About Us</a>
  </div>
  </div>
</nav> 
<!-- navbar complete -->
	 
	<style>
		@import url(https://fonts.googleapis.com/css?family=Roboto:300);
header .header{
  background-color: #fff;
  height: 45px;
}
header a img{
  width: 134px;
margin-top: 4px;
}
.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.login-page .form .login{
  margin-top: -31px;
margin-bottom: 26px;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background-color: #328f8a;
  background-image: linear-gradient(45deg,#328f8a,#08ac4b); 
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}

.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}

body {
  background-color: #328f8a;
   background-image: linear-gradient(45deg,#328f8a,#08ac4b); 
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
		</style>
	<div class="login-page">
      <div class="form">
	  <form action="admin.php" method="post">  
        <div class="login">
          <div class="login-header">
            <h3>Login As Admin</h3>
            <p>Please enter your credentials to login.</p>
          </div>
        </div>
        <form class="login-form">
          <input type="text" placeholder=" Enter username" name="name" required />
          <input type="password" placeholder="Enter password"name="password" required />
          <button type="submit">Login</button>
        </form>
      </form>
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
       &copy; Copyright <strong><span></span></strong>. All Rights Reserved 
      </div>
      <div class="credits">
        Designed by Waste-mgmt-group</a>
      </div>
    </div>
  </footer>
  <!-- End Footer -->  
</body>
</html>