<?php 
session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/functions.php');

if(!loggedIn()){
    header("Location:index.php?err=" . urlencode("You need to login to View account!!"));
    exit();
}
$email = $_SESSION['user_email'];
$query = "SELECT * FROM request WHERE email = '$email'";
$result = $db->query($query);

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
<style>
  body {
    background-color: #02a117;
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
                  <b>  Waste Mangement Nepal </b></a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03"> 
    </div>
    <style>
    .navbar-right {
			float: right;
      color: aqua;
    }
    .navbar {
        background-color:  #1acc8d;
    }
    </style>
<div class="navbar navbar-right">
<a href="../fe-garbaze/home.php" class="btn">About Us</a>
  </div>
  </div>
  
</nav> 
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

  <!--request form -->
  <div class="page-wrapper">
    <div class="col-lg-12 ">
    <div class="card">
    <div class="card-body">      
    <div class="btn-list">
    <a href="newrequest.php?user=<?php echo $_SESSION['user_email']; ?>">
    <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">Request</button></a>                    
    <a href="orderbook.php?user=<?php echo $_SESSION['user_email']; ?>">
    <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">Clients' Book</button></a>
      </div>
        </div>
        </div>
        </div>
 
        <!--table-->  
    <div class="container-fluid">            
    <div class="row">
    <div class="col-12">
    <div class="card">
    <div class="card-body">
    <h4 class="card-title" style="text-align:center"> Request History</h4>
    <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;

}
</style>
<table>
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Payment Type</th>
    <th>Client Type</th>
    <th>Garbage Type</th>
    <th>Location</th>
    <th>Weight</th>
    <th>Contact</th>
    <th>Status</th>
    <th>Date</th>
  </tr>
  <?php if ($result->num_rows > 0) { echo "<strong>Email: </strong>" . $_SESSION['user_email'] . "<br><br>"; 
    echo "<table>"; 
    while ($row = mysqli_fetch_assoc($result)) { ?>
     <tr><td><?php echo $row['names']; ?></td>
     <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['pay_type']; ?></td>
       <td><?php echo $row['client_type']; ?></td> 
       <td><?php echo $row['garbage_type']; ?></td> 
       <td><?php echo $row['location']; ?></td>
        <td><?php echo $row['weight']; ?></td>
         <td><?php echo $row['contact']; ?></td>
          <td><?php echo $row['status']; ?></td>
           <td><?php echo $row['date']; ?></td>
         </tr> 
         <?php } ?>
         </table> 
         <?php 
         }
          else { echo "<strong>Email:</strong> " . $_SESSION['user_email'] . "<br><br>"; 
          echo "No records found"; } ?>
   <!-- end of table-->
          </table>
</div>
                    </div>
                    </div>
                </div>
          </div>
          </div><br><br>
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
            
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    
 