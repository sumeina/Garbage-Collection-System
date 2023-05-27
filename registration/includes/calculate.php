<?php
 require("./config.php");
 require("./db.php");
header("Content-Type:application/json");//retrive data from server, json response

$query = "select * from request where status='pending'";

$result = $db->query($query)->fetch_all(MYSQLI_ASSOC);
echo json_encode(array("data"=>$result));



 