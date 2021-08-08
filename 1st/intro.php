<?php

$name = 'ahmed'; //string
$age = 25; // integer
$percetange = 95.5; // float
$status = true; // bolean
$activities = ['football','running']; // array
$code = NULL; // null
$user = (object)['data'=>'data']; // object


// echo($code); // couldn't print array , object

// print($activies); // couldn't print array , object

// print_r($name); // can print any datatype

// var_dump($user); // can print any datatype


$firstName = "galal";
$lastName = "husseny";
$fullName = $firstName . ' ' . $lastName . ' age: '. $age . ' percentage: ' .$percetange . ',status: '. $status; 
echo($fullName); // concate, concatenation


