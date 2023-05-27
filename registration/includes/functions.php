<?php
function loggedIn(){
    if(isset($_SESSION['user_email']) || isset($_COOKIE['user_email'])){
        return true;
    }else return false;
}
