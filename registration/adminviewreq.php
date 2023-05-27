<?php
// start a session to store user data
session_start();
// Establish a connection to the database
  $conn = mysqli_connect('localhost', 'root', '', 'registration');
  // Check if the connection was successful
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
// check if the admin is not logged in
if (!isset($_SESSION["name"])) {
    // if the admin is not logged in, redirect to the login page
    header("Location: admindashboard.php");

    exit(); // exit the script to prevent further execution
}

// set the value of $name variable
$name = $_SESSION["name"];
?>
<!DOCTYPE html>
<html>
<head>
   <!-- Basic Page Info -->
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Request</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <style>
      /* Navbar styles */
.navbar {
    background-color: #333;
    overflow: hidden;
    height: 70px;
}

.navbar a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

.navbar a.active {
    background-color: #4CAF50;
    color: white;
}

.navbar-right {
    float: right;
}

/* New styles for centering welcome message */
.navbar-center {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}

.navbar-center p {
    display: inline-block;
    margin: 0;
    color: #f2f2f2;
    font-size: 17px;
    padding: 14px 16px;
    text-align: center;
}

.navbar-right a {
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

    </style>
</head>
    <!-- Navbar -->
    <div class="navbar">
    <div class="navbar-left">
        <a class="active" href="admindashboard.php">Admin Dashboard</a>
    </div>
    <div class="navbar-center">
        <p>Welcome, <?php echo $name; ?>!</p>
    </div>
    <div class="navbar-right">
        <a href="logout.php">Logout</a>
    </div>
</div>

    <style>
        
        /* Side dashboard styles */
        .sidenav {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 80px;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 30px;
        }
        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
            padding-top: 20px;
        }
        .sidenav a:hover {
            color: #f1f1f1;
            padding-top: 20px;
        }
        .main {
            margin-left: 200px; /* Same as the width of the sidenav */
            padding: 0px 10px;
        }
        /* Content styles */
        h1 {
            margin-top: 50px;
        }
        
    </style>
 
        <!--table-->  
    <div class="container-fluid">            
    <div class="row">
    <div class="col-12">
    <div class="card">
    <div class="card-body">
    <h4 class="card-title" style="text-align:center"> Request History</h4>
    <style>
table, th, td {
  margin-left: 210px;
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  align:center;
}
table{
padding-left: 100px;
}
th{
        background-color: green;
        color: white;
    }
</style>
  <!-- Side dashboard -->
  <div class="sidenav">
    <br>
    <div class="sidenav">
  <br>
  <a href="adminviewreq.php"><i class="fas fa-users"></i> User Management</a><br>
  
  <a href="logout.php"><i class="fas fa-plus-circle"></i> Logout</a><br>
 
</div>

</div>
                    </div>
                    </div>
                </div>
          </div>
          </div><br><br>
    <?php 
  
   // Construct the SQL query
   $sql = "SELECT * FROM request ORDER BY date DESC";

   // Execute the SQL query
   $result = mysqli_query($conn, $sql);
 
   // Check if any rows were returned
   if (mysqli_num_rows($result) > 0) {
     // Output the table header
     echo '<table>';
     echo '<tr><th>Name</th><th>Email</th><th>Payment Type</th><th>Client Type</th><th>Garbage Type</th><th>Location</th><th>Weight</th><th>Contact</th><th>Status</th><th>Date</th></tr>';
 
     // Loop through each row of the result set and output the data in a table row
     while ($row = mysqli_fetch_assoc($result)) {
       echo '<tr>';
       echo '<td>' . $row['names'] . '</td>';
       echo '<td>' . $row['email'] . '</td>';
       echo '<td>' . $row['pay_type'] . '</td>';
       echo '<td>' . $row['client_type'] . '</td>';
       echo '<td>' . $row['garbage_type'] . '</td>';
       echo '<td>' . $row['location'] . '</td>';
       echo '<td>' . $row['weight'] . '</td>';
       echo '<td>' . $row['contact'] . '</td>';
       echo '<td>' . $row['status'] . '</td>';
       echo '<td>' . $row['date'] . '</td>';
       echo '</tr>';
     }
 
     // Output the closing table tag
     echo '</table>';
   } else {
     // If no rows were returned, display a message
     echo 'No records found';
   }
   ?> 
   <br>
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
    
 