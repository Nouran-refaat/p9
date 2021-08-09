<?php


$x = 5;
$y = 6;

// function functionName (i/ps) {
//     // body
// }

// has i/p , hasn't o/p
function calculateWeatherV1($degree){
    if($degree > 40){
        $msg = "Hot Weather<br>";
    } elseif ($degree > 30 and $degree <= 40) {
        $msg = "warm Weahter<br>";
    } elseif ($degree > 20 and $degree <= 30) {
        $msg = "good weather<br>";
    } else {
        $msg = "cold weather<br>";
    }
    echo $msg;
}

// calculateWeatherV1(30);

// has i/p , has o/p
function calculateWeatherV2($degree){
    if($degree > 40){
        return "Hot Weather<br>";
    } elseif ($degree > 30 and $degree <= 40) {
        return "warm Weahter<br>";
    } elseif ($degree > 20 and $degree <= 30) {
        return "good weather<br>";
    } else {
        return "cold weather<br>";
    }
}
$message = calculateWeatherV2(-5);
// echo $message;

// has not i/p , has not o/p
function calculateWeatherV3(){
    $degree = 60;
    if($degree > 40){
        echo "Hot Weather<br>";
    } elseif ($degree > 30 and $degree <= 40) {
        echo "warm Weahter<br>";
    } elseif ($degree > 20 and $degree <= 30) {
        echo "good weather<br>";
    } else {
        echo "cold weather<br>";
    }
}

// calculateWeatherV3();

// has not i/p , has o/p
function calculateWeatherV4(){
    $degree = 35;
    if($degree > 40){
        return "Hot Weather<br>";
    } elseif ($degree > 30 and $degree <= 40) {
        return "warm Weahter<br>";
    } elseif ($degree > 20 and $degree <= 30) {
        return "good weather<br>";
    } else {
        return "cold weather<br>";
    }
}

// echo calculateWeatherV4();

$number1 = 11;
$number2 = 15;
function sumTwoNumbers($number2,$number3,$number1 = 10)
{
    // $sum =  $number1 + $number2;
    // return $sum;
    return $number2 + $number1 + $number3;
    // return $number1;
}

echo sumTwoNumbers(5,15);