<?php


// comparison operators
// < , > , <=  , >= , == , != , === , !==
$firstNumber = 15;
$secondNumber = 10;
// var_dump($firstNumber !== $secondNumber);


// logical operators
// and &&, or ||, !

var_dump( !(($firstNumber < $secondNumber && 0 == 1) || 5 > 4) );


// arthimatic operators
// + , - , * , / , ** , % 
$firstNumber = 15;
$secondNumber = 5;

$sum = $firstNumber % $secondNumber;
// echo $sum;



// assignment opertors

$number1 = 6;
// $number1 = $number1 + 4;
$number1 += 4 ;
// $number1 = $number1 - 5;
$number1 -= 5;

$number1 *= 5;
$number1 /= 6;
$number1 .= 5;
$number1 .= 'doaa';
// echo $number1;





// increment/decremnet operators
// $x = 10;

// echo $x++; // post-increment (10,11)
// echo "<br>";
// echo ++$x; // pre-increment (12,12)
// echo "<br>";
// echo $x--; // post-decrement (12,11)
// echo "<br>";
// echo --$x; // pre-decrement (10,10)
// echo "<br>";
// echo $x;

// ternary operator


// escape operator
// $message = 'isn\'t';

// string operator
// . 
