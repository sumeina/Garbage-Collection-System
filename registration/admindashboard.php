<?php
// start a session to store user data
session_start();

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
<html lang="en">
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
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
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->

</head>
<style>
    /* Navbar styles */
    body {
        margin: 0;
        padding: 0;
        background-color: #EDEADE;
    }

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

    th{
        background-color: green;
        color: whitesmoke;
    }
</style>

<!-- Navbar -->
<div class="navbar">
    <div class="navbar-left">
        <a class="active" href="#">Admin Dashboard</a>
    </div>
    <div class="navbar-center">
        <p>Welcome,
            <?php echo $name; ?>!
        </p>
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
        margin-left: 200px;
        /* Same as the width of the sidenav */
        padding: 0px 10px;
    }

    /* Content styles */
    h1 {
        margin-top: 50px;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .bttn{
        align-items: center;
        margin-top: 10px;
        margin-bottom: 10px;
        padding: 10px;
        font-size: 20px;
        border-radius: 10px;
        background-color: #fc1c03;
        color: #f2f2f2;
        border: none;
    }
    .hidden{
        padding: 10px;
        border: 1px solid black;
        /* display: none; */
    }
</style>
<body>
    <!-- Side dashboard -->
    <div class="sidenav">
        <br>
        <div class="sidenav">
            <br>
            <a href="adminviewreq.php"><i class="fas fa-users"></i> User Management</a><br>
            <a href="logout.php"><i class="fas fa-plus-circle"></i> Logout</a><br>
        </div>
    </div>

    <div class="main">
        <h1>User Details</h1>
        <br>
        <!-- PHP Code to display the user table and calculate distace -->
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "registration";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the table
        $sql = "SELECT * FROM request";
        $result = $conn->query($sql);


        // Check if any rows are returned
        if ($result->num_rows > 0) {
            // Start table
            echo "<table >";

            // Table headers
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Payment Type</th>";
            echo "<th>Client Type</th>";
            echo "<th>Garbage Type</th>";
            echo "<th>Location</th>";
            echo "<th>Address</th>";
            echo "<th>Weight</th>";
            echo "<th>Contact</th>";
            echo "<th>Status</th>";
            echo "<th>Date</th>";
            echo "<th>Email</th>";
            echo "</tr>";

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["names"] . "</td>";
                echo "<td>" . $row["pay_type"] . "</td>";
                echo "<td>" . $row["client_type"] . "</td>";
                echo "<td>" . $row["garbage_type"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["weight"] . "</td>";
                echo "<td>" . $row["contact"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "</tr>";
            }

            // End table
            echo "</table>";
        } else {
            echo "No results found.";
        }

        // Close the connection
        $conn->close();
        ?>
        <!-- PHP Code to display the user table and calculate distace -->
        <!-- </div> -->
        <button id="calculateBTN" class="bttn">Calculate Route and Distances</button>
        <!-- <button id = "getAddress">Get Address</button> -->
        <p id="weight" class="block" style="font-size: 18px"></p>
        <p id="distance" style="font-size: 18px"></p>
        
        <div id="map" class="d-none" style="height: 300px"></div>

    </div>
    <script src="tsp.js"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script src="https://npmcdn.com/leaflet-geometryutil"></script>


    <script src="./js/tsp.js"></script>


</body>

</html>