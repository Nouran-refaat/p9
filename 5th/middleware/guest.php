<?php
// print_r($_SESSION['user']);die;
if(isset($_SESSION['user'])){
    header('location:index.php');
}