<?php
session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/functions.php');

if(!loggedIn()){
    header("Location:index.php?err=" . urlencode("You need to login to View account!!"));
    exit();
}

if (isset($_POST['submit'])) {
  // Get the form data
  $_SESSION['names'] = $_POST['names'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['pay_type'] = $_POST['pay_type'];
  $_SESSION['client_type'] = $_POST['client_type'];
  $_SESSION['garbage_type'] = $_POST['garbage_type'];
  $_SESSION['location'] = $_POST['location'];
  $_SESSION['weight'] = $_POST['weight'];
  $_SESSION['contact'] = $_POST['contact'];
  $_SESSION['status'] = "pending";
  $_SESSION['date'] = date("Y-m-d");

  $names = mysqli_real_escape_string($db, $_POST['names']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $pay_type = mysqli_real_escape_string($db, $_POST['pay_type']);
  $client_type = mysqli_real_escape_string($db, $_POST['client_type']);
  $garbage_type = mysqli_real_escape_string($db, $_POST['garbage_type']);
  $location = mysqli_real_escape_string($db, $_POST['location']);
  $weight = mysqli_real_escape_string($db, $_POST['weight']);
  $contact = mysqli_real_escape_string($db, $_POST['contact']);

  if (empty($names) || empty($email) || empty($pay_type) || empty($client_type) || empty($garbage_type) || empty($location) || empty($contact)) {
    // Display error message
    echo "Error: All fields are required.";
  } else {
    // Fetch the user's email from the session
    $user_email = $_SESSION['email'];
  
    // Validate the email entered in the request table against the fetched email
    $request_email = $email;
    if ($request_email != $user_email) {
      // If the emails do not match, return an error message to the user
      die("Error: Request email does not match user email");
    } else {
      $query = "INSERT INTO request (names, email, pay_type, client_type, garbage_type, location, weight, contact, status, date) 
      VALUES ('$names','$email','$pay_type', '$client_type', '$garbage_type', '$location',  '$weight', '$contact', '{$_SESSION['status']}', '{$_SESSION['date']}')";
  
      $db->query($query);
      $message = "Hi $user_email! New request has been submitted.";
      mail($user_email , 'Garbage Collection Request' , $message , 'From: suminakdk057@gmail.com');
      header("Location:newrequest.php?success=" . urlencode(" Request Sent!"));
    }
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
    <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">New Request</button></a>                    
    <a href="orderbook.php?user=<?php echo $_SESSION['user_email']; ?>">
    <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">Clients' Book</button></a>
      </div>
        </div>
        </div>
        </div>
 
        <!--form-->  
    <div class="container-fluid">            
    <div class="row">
    <div class="col-12">
    <div class="card">
    <div class="card-body">
    <h4 class="card-title"></h4>
    <form  enctype="multipart/form-data" method="post" action="newrequest.php" autocomplete="off">
        <div class="form-body">
        <div class="row">
        <div class="col-md-2">
        <div class="form-group">
        <label>Name</label>
            </div>
            </div>
        <div class="col-md-10">
        <div class="form-group">
<input type="hidden" name="date" required  class="form-control" value="<?php echo date('Y-m-d') ?>">
 <input type="text" name="names" required  class="form-control" placeholder="Enter the username " value="<?php echo @$_SESSION['names']; ?>" required>
         </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-2">
    <div class="form-group">
    <label>Email</label>
         </div>
        </div>
     <div class="col-md-10">
     <div class="form-group">
     <input type="email" name="email" required  class="form-control" placeholder="Enter your email that you have logged in with" value="<?php echo @$_SESSION['email']; ?>" required>
 </div>
 </div>
   </div>
     <div class="row">
    <div class="col-md-2">
    <div class="form-group">
    <label>Payment Type</label>
         </div>
        </div>
     <div class="col-md-10">
     <div class="form-group">
 <select name="pay_type" class="form-control show-tick" required data-live-search="true" value="<?php echo @$_SESSION['pay_type']; ?>" required>
     <option selected value="">---Choose---</option>
     <option value="monthly"> Monthly</option> 
     <option value="percollection">Per Collection </option> 
        </select>                                               
          </div>
          </div>
          </div>
    <div class="row">
    <div class="col-md-2">
    <div class="form-group">
    <label>Client Type</label>
        </div>
        </div>
   <div class="col-md-10">
     <div class="form-group">
<select name="client_type" class="form-control show-tick" required data-live-search="true" value="<?php echo @$_SESSION['client_type']; ?>" required>
    <option selected value="">---Choose---</option>
     <option value="company"> Company</option> 
     <option value="individual">Individual </option> 
    </select> 
        </div>
        </div>
         </div>
   <div class="row">
    <div class="col-md-2">
    <div class="form-group">
    <label>Address</label>
         </div>
        </div>
     <div class="col-md-10">
     <div class="form-group">
     <input type="text" name="location" required  class="form-control" placeholder="Enter your address" value="<?php echo @$_SESSION['location']; ?>" required>
 </div>
 </div>
   </div>
   <div class="row">
       <div class="col-md-2">
            <div class="form-group">
              <label>Weight/kg</label>
          </div>
          </div>
           <div class="col-md-10">
         <div class="form-group">
    <input type="number" name="weight" required  class="form-control" placeholder="Enter weight you expect per kg" value="<?php echo @$_SESSION['weight']; ?>" required>
     </div>
        </div>
          </div>

 <div class="row">
  <div class="col-md-2">
    <div class="form-group">
       <label>Contact</label>
               </div>
                </div>
     <div class="col-md-10">
    <div class="form-group">
 <input type="number" name="contact" required  class="form-control" placeholder="Enter the contact number" value="<?php echo @$_SESSION['contact']; ?>" required>
  </div>
     </div>
        </div>
    <div class="row">
    <div class="col-md-2">
    <div class="form-group">
      <label>Garbage Type</label>
       </div>
          </div>
    <div class="col-md-10">
     <div class="form-group">
 <select name="garbage_type" class="form-control show-tick" required data-live-search="true" value="<?php echo @$_SESSION['garbage_type']; ?>" required>
   <option selected value="">---Choose---</option>
        <?php 
            $sql=mysqli_query($db,"SELECT * FROM garbage_type");
              while($row=mysqli_fetch_array($sql))
                   {
                ?>
       <option value="<?php echo $row['name'];?>">&nbsp;&nbsp;&nbsp;&nbsp;
       <?php echo $row['name'];?></option>
         <?php } ?>
         </select>                                              
          </div>
             </div>
           </div>
  <input type="hidden" name="status" required  class="form-control" value="pending">
  <div class="form-actions">
  <script>
function showSuccessMessage() {
  alert("Request Sent!");
  window.location.href = 'myaccount.php';
}
</script>
  <div class="text-right">
    <button type="submit" name="submit" class="btn btn-info">Request</button>
    <button type="reset" class="btn btn-dark">Reset</button>
 

<!-- Your form HTML code goes here -->

<?php
  if (isset($_GET['success'])) {
    echo '<script>showSuccessMessage();</script>';
  }
?>
  </div>
</div>
</div>
</div>
 </div>
                </div>
                <br>
                <!-- end of request form-->
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