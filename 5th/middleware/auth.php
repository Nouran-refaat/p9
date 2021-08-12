<?php
// check if user not authorized 
if(empty($_SESSION['user'])){
    header('location:login.php');
}