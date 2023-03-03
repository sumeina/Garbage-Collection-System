<?php

include('includes/config.php');
include('includes/db.php');

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $query = "update users set status='1' where token='$token'";
    if($db->query($query)){
        // Display a pop-up message to the user
        

        // Redirect the user to the login page
        header("Location:index.php?success=Account Activated!!");
        exit();
    }
    
}

?>
 <script>
function showSuccessMessage() {
  alert("Account Activated, Login Now!");

}
</script>
<?php
  if (header("Location:index.php?success=Account Activated!!")) {
    echo '<script>showSuccessMessage();</script>';
  }
?>