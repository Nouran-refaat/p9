<?php

// if 

// if(condtion){
// body 
// }

// var_dump(1>2);

// 0 , '' , [] , (object)[] , false , NULL 
// $x = 5;
// $y =5;
// if($x>$y){
//     echo "hello";
// }

// $gender = 'm';
// $gender = 'f';

// $age = 10;
// $age = 60;

// if($gender == 'm' AND $age == 10){
//     echo "child male";
// }elseif($gender == 'm' AND $age == 60){
//     // gender = f , $age = 60
//     echo "old man";
// }elseif($gender = 'f' AND $age == 10){
//     echo "child female";
// }else {
//     echo "old women";
// }

// if($gender == 'm'){
//     $message = 'male';
// }else{
//     $message = 'female';
// }

// if($age == 10){
//     $message .= ' child';
// }else{
//     $message .= ' old';
// }

// echo $message;


// if($gender == 'm'){
//     if($age == 10){
//         $message = 'child male';
//     }else{
//         $message = 'old male';
//     }
// }else{
//     if($age == 10){
//         $message = 'child female';
//     }else{
//         $message = 'old female';
//     }
// }

// echo $message;










// $weather = 40;
// 

// degree > 40 => hot weather
// degree > 30 , degree <= 40 => warm weather
// degree >20 , degree <= 30 => good weather
// degree <20 => cold weather

// if($weather > 40){
//     $msg = "Hot Weather";
// }elseif($weather >30 AND $weather <= 40){
//     $msg = "warm Weahter";
// }elseif($weather >20 AND $weather <=30){
//     $msg = "good weather";
// }else{
//     $msg = "cold weather";
// }

// echo $msg;

// $status = 0;
// if($status){
//     $msg = 'verified user';
// }

// echo $msg;


/**
 * @swtich
 * / */

// $color = 'black';
// switch ($color) {
//     case "red":
//         $msg =  "your fav color is red<br>";
//         break;
//     case "blue": 
//         $msg= "your fav color is blue<br>";
//         break;
//     case "black": 
//         $msg= "your fav color is black<br>";
//         break;
//     default:
//         $msg= "your color is not supported<br>";
// }

// echo $msg;



/**
 * ternary operator (condtion ? true : false)
 */

$number1 = 5;
$number2 = 6;

// echo($number2 < $number1 ? $number2 : $number1);

$userGender = 'm';
// $gender = $userGender == 'm' ? 'male' : 'female';

// echo $gender;
$degree = 25;
// $weather = $degree > 40 ? 'hot' : (($degree > 20 AND $degree < 30) ? 'warm' : 'cold');

