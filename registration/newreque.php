<?php
session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/functions.php');

if (!loggedIn()) {
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
  $_SESSION['address'] = $_POST['address'];
  $_SESSION['weight'] = $_POST['weight'];
  $_SESSION['contact'] = $_POST['contact'];
  $_SESSION['status'] = "pending";
  $_SESSION['date'] = date("Y-m-d");

  $names = mysqli_real_escape_string($db, $_POST['names']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $pay_type = mysqli_real_escape_string($db, $_POST['pay_type']);
  $client_type = mysqli_real_escape_string($db, $_POST['client_type']);
  $garbage_type = mysqli_real_escape_string($db, $_POST['garbage_type']);
  $lat = mysqli_real_escape_string($db, $_POST['lat']);
  $lng = mysqli_real_escape_string($db, $_POST['lng']);
  $location = '[' . $lat . ',' . $lng . ']';
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $weight = mysqli_real_escape_string($db, $_POST['weight']);
  $contact = mysqli_real_escape_string($db, $_POST['contact']);

  if (empty($names) || empty($email) || empty($pay_type) || empty($client_type) || empty($garbage_type) || empty($location) || empty($contact)) {
    // Display error message
    echo "Error: All fields are required.";
    var_dump($names, $email, $pay_type, $client_type, $garbage_type, $location, $contact);

  } else {
    // Fetch the user's email from the session
    $user_email = $_SESSION['email'];

    // Validate the email entered in the request table against the fetched email
    $request_email = $email;
    if ($request_email != $user_email) {
      // If the emails do not match, return an error message to the user
      die("Error: Request email does not match user email");
    } else {
      // $query = "INSERT INTO request (names, email, pay_type, client_type, garbage_type, location, weight, contact, status, date) 
      // VALUES ('$names','$email','$pay_type', '$client_type', '$garbage_type', '$location',  '$weight', '$contact', '{$_SESSION['status']}', '{$_SESSION['date']}')";
      //new query
      // $query = "INSERT INTO request (names, email, pay_type, client_type, garbage_type, location, weight, contact, address, status, date) 
      //  VALUES ('$names','$email','$pay_type', '$client_type', '$garbage_type', '$location',  '$weight', '$contact', '$address', '{$_SESSION['status']}', '{$_SESSION['date']}')";
  $query = "INSERT INTO request (names, email, pay_type, client_type, garbage_type, location, weight, contact, address, status, date) 
 VALUES ('$names','$email','$pay_type', '$client_type', '$garbage_type', '$location',  '$weight', '$contact', '$address', '{$_SESSION['status']}', '{$_SESSION['date']}')";

      // $db->query($query);
      $message = "Hi $user_email! New request has been submitted.";
      mail($user_email, 'Garbage Collection Request', $message, 'From: suminakdk057@gmail.com');
      header("Location:newrequest.php?success=" . urlencode(" Request Sent!"));
      $response = array(
        'success' => true,
        'message' => 'Request submitted successfully.',
        'data' => array(
          'names' => $names,
          'email' => $email,
          'pay_type' => $pay_type,
          'client_type' => $client_type,
          'garbage_type' => $garbage_type,
          'location' => $location,
          'address' => $address,
          'weight' => $weight,
          'contact' => $contact
        )
      );

      // Send the response as JSON
      header('Content-Type: application/json');
      echo json_encode($response);
      exit();
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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
  <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
</head>
<style>
  body {
    background-color: #02a117;
  }
</style>

<body class="login-page">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <img src="vendors/images/favicon-32x32.png" alt="">
        <b>Waste Mangement Nepal</b>
      </a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03"></div>
      <style>
        .navbar-right {
          float: right;
          color: aqua;
        }

        .navbar {
          background-color: #1acc8d;
        }
      </style>
      <style>
        .leaflet-popup-content {
          font-size: 16px;
          /* Adjust the font size as desired */
        }
      </style>

      <div class="navbar navbar-right">
        <a href="../fe-garbaze/home.php" class="btn">About Us</a>
      </div>
    </div>
  </nav> <!--- navbar complete-->
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
                  <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">New
                    Request</button></a>
                <a href="orderbook.php?user=<?php echo $_SESSION['user_email']; ?>">
                  <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">Clients'
                    Book</button></a>
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
                  <form enctype="multipart/form-data" method="post" action="newrequest.php" autocomplete="off">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Name</label>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group">
                            <input type="hidden" name="date" required class="form-control"
                              value="<?php echo date('Y-m-d') ?>">
                            <input type="text" name="names" required class="form-control" placeholder="Enter your name "
                              value="<?php echo @$_SESSION['names']; ?>" required>
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
                            <input type="email" name="email" required class="form-control"
                              placeholder="Enter your email that you have logged in with" value="<?php if (isset($_SESSION['user_email'])) {
                                echo $_SESSION['user_email'];
                              } else
                                echo $_COOKIE['user_email']; ?>">

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
                            <select name="pay_type" class="form-control show-tick" required data-live-search="true"
                              value="<?php echo @$_SESSION['pay_type']; ?>" required>
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
                            <select name="client_type" class="form-control show-tick" required data-live-search="true"
                              value="<?php echo @$_SESSION['client_type']; ?>" required>
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
                            <label>Address: Please mark pick-up point</label>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group">
                            <input type="hidden" name="location" id="location" value="" required>
                            <input type="hidden" name="address" id="address" class="form-control">
                            <div id="map" style="width:900px; height: 50vh"></div>
                            <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
                            <script>
                              var lat, lon;
                              var isLocationSelected = false;
                              let selectedLocation = { lat: "", long: "" };
                              var latlng;
                              var address;
                              var map = L.map('map').setView([27.70514, 85.3185], 13);
                              var marker = L.marker([0, 0]);
                              // marker.bindPopup("<b>Hello!</b><br>This is a drop-off point.").openPopup();

                              mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
                              L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: 'Leaflet &copy; ' + mapLink + ', contribution', maxZoom: 18 }).addTo(map);
                              latlng = map.on('click', function (e) {
                                isLocationSelected = true;
                                console.log(e)
                                lat = e.latlng.lat;
                                lon = e.latlng.lng;
                                // added code
                                document.getElementById('lat').value = lat;
                                document.getElementById('lng').value = lon;
                                console.log("Lat: " + lat + "Long: " + lon);
                                selectedLocation.lat = lat;
                                selectedLocation.long = lon
                                var newLatLng = new L.LatLng(lat, lon);
                                
                                marker.setLatLng(newLatLng);
                                marker.addTo(map)
                                console.log(newLatLng)
                                // return newLatLng;
                                //Function to add location
                                // saveLocation();
                                //Function to add location
                              });
                              function saveLocation() {
                                // console.log("Save Location")
                                if (isLocationSelected) {
                                  var xhr = new XMLHttpRequest();
                                  xhr.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                      console.log(this.responseText);
                                      //Address GETTER
                                      const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${selectedLocation.lat}&lon=${selectedLocation.long}`;

                                      return fetch(apiUrl)
                                        .then(response => response.json())
                                        .then(data => {
                                          // const address = data.display_name;
                                          const address = data["address"].suburb;

                                          // Assign address value to the hidden input field
                                          document.getElementById("address").value = address;
                                          // Submit the form
                                          document.getElementById("form").submit();
                                          // address = data;
                                          console.log(address);
                                          // return address;
                                        
                                          fetch('final/registration/newrequest.php', {
                                            method: 'POST',
                                            body: formData
                                          })
                                            .then(response => response.json())
                                            .then(data => {
                                              // Check if the request was successful
                                              if (data.success) {
                                                // Retrieve the values from the response data
                                                const names = data.data.names;
                                                const email = data.data.email;
                                                const payType = data.data.pay_type;
                                                const clientType = data.data.client_type;
                                                const garbageType = data.data.garbage_type;
                                                const location = data.data.location;
                                                const address = data.data.address;
                                                const weight = data.data.weight;
                                                const contact = data.data.contact;

                                                // Do something with the retrieved values
                                                console.log(names, email, payType, clientType, garbageType, location, address, weight, contact);
                                              } else {
                                                // Display an error message
                                                console.log('Request failed:', data.message);
                                              }
                                            })
                                            .catch(error => {
                                              // Handle any errors
                                              console.error('Error:', error);
                                            });

                                        })
                                        .catch(error => {
                                          console.log('Error:', error);
                                          return null;
                                        });
                                     

                                      //Address GETTER
                                      alert("Location saved successfully!");
                                    }
                                  };
                                  xhr.open("POST", "newrequest.php", true);
                                  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                  xhr.send("lat=" + selectedLocation.lat + "&long=" + selectedLocation.long + "&address=" + address);
                                  // xhr.send("address=" address);


                                } else {
                                  alert("Please select a location on the map first!");
                                }
                              }

                            
                              // assume that `newLatLng` is a Leaflet LatLng object
                              document.getElementById('location').value = newLatLng.lat + ',' + newLatLng.lng;
                              document.getElementById('address').value = address;
                            </script>
                            <script>
                              var newLatLng = null;
                              function onMapClick(e) {
                                newLatLng = e.latlng;
                                document.getElementById('lat').value = newLatLng.lat;
                                document.getElementById('lng').value = newLatLng.lng;
                              }
                              map.on('click', onMapClick);
                            </script>

                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="lng" id="lng">
                            <!-- <input type="hiden" name="address" id="address">  -->

                          </div>
                        </div>
                      </div><br>
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Weight/kg</label>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group">
                            <input type="number" name="weight" required class="form-control"
                              placeholder="Enter weight per kg" value="<?php echo @$_SESSION['weight']; ?>" required>
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
                            <input type="text" name="contact" required class="form-control" pattern="[0-9]{10}"
                              placeholder="Enter the contact number" value="<?php echo @$_SESSION['contact']; ?>"
                              required>
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
                            <select name="garbage_type" class="form-control show-tick" required data-live-search="true"
                              value="<?php echo @$_SESSION['garbage_type']; ?>" required>
                              <option selected value="">---Choose---</option>
                              <?php
                              $sql = mysqli_query($db, "SELECT * FROM garbage_type");
                              while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?php echo $row['name']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;
                                  <?php echo $row['name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="status" required class="form-control" value="pending">
                      <div class="form-actions">
                        <script>
                          function showSuccessMessage() {
                            alert("Request Sent!");
                            window.location.href = 'myaccount.php';
                          }
                        </script>
                        <div class="text-right">
                          <button type="submit" name="submit" class="btn btn-info"
                            onclick="saveLocation()">Request</button>
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
                  </form>

                </div>
              </div>
              <br>
              <!-- end of request form-->
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

            </div>
            <!-- End Footer -->
            <!-- Bootstrap core JavaScript
    ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <!-- map implementation for location -->
            <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>



</body>

</html>
 <?php
// Process your form data and store it in the database

// After processing the form data and storing it in the database

// Create an associative array with the desired values
$names = isset($_POST['names']) ? $_POST['names'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$pay_type = isset($_POST['pay_type']) ? $_POST['pay_type'] : null;
$client_type = isset($_POST['client_type']) ? $_POST['client_type'] : null;
$garbage_type = isset($_POST['garbage_type']) ? $_POST['garbage_type'] : null;
$location = isset($_POST['location']) ? $_POST['location'] : null;
$address = isset($_POST['address']) ? $_POST['address'] : null;
$weight = isset($_POST['weight']) ? $_POST['weight'] : null;
$contact = isset($_POST['contact']) ? $_POST['contact'] : null;

$response = array(
  'success' => true,
  'message' => 'Request submitted successfully.',
  'data' => array(
    'names' => $names,
    'email' => $email,
    'pay_type' => $pay_type,
    'client_type' => $client_type,
    'garbage_type' => $garbage_type,
    'location' => $location,
    'address' => $address,
    'weight' => $weight,
    'contact' => $contact
  )
);

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();
?> 