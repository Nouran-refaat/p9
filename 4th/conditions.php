<?php

$x = 5;

if($x){
    // any values except 0 , '' , [] , null , false , (object)[]
}

if(!$x){
    // 0 , '' , [] , null , false , (object)[]
}

if(isset($x)){
    // if the variable is defined
}

if(!isset($x)){
    // 
}

if(empty($x)){
    // the variable isn't defined ,  0 , '' , [] , null , false , (object)[]
}

if(!empty($x)){
    // the variable is defined ,  any values except 0 , '' , [] , null , false , (object)[]
}



$y = [1,2];

if($y){
    // if array has values
}

if(!$y){
    // if array is empty
}

if(isset($y)){
    // if array is deifined
}

if(!isset($y)){
    // if array is not defiend
}

if(empty($y)){
    // if array is not defiend , if array is empty 
}

if(!empty($y)){
    // if array defiend and has values
}



$_POST['email'] = 'email@email.com';
// $z['email'] = 'email@email.com';

if($_POST['email']){
    // if email key has value
}

if(!$_POST['email']){
    // if email key hasn't value 
}

if(isset($_POST['email'])){
    // if email key is exists in post array
}

if(!isset($_POST['email'])){
    // if key dosen't exists in $_POST array
}

if(empty($_POST['email'])){
    // if key dosen't defiend or has restricted values
}

if(!empty($_POST['email'])){
    // if key has values except restricted values 
}


if(isset($_POST)){
    
}

if($_POST){
    
}