<?php
// loops (for,while,do while , foreach)

// for (intailize counter; condition; step) { 
//     # code...
// }
// int
// check condition
// do body
// step

// for (;true;) {
// echo "nti";
// }

// for ($i=0 ; $i < 3 ; $i++) { 
//     echo "hello world $i<br>";
// }
// $games = ['football','running','swimming','gym'];
// echo $games[0];
// echo $games[1];
// echo $games[2];
// $gamesCount = count($games);
// $lastIndex = $gamesCount -1;

// for ($i=0; $i < $gamesCount ; $i++) { 
//     echo $games[$i] .'<br>';
// }

// for ($i=0; $i <= $lastIndex ; $i++) { 
//     echo $games[$i] .'<br>';
// }


// for ($i=$lastIndex; $i >= 0 ; $i--) { 
//     echo $games[$i] .'<br>';
// }

// intailize counter
// while(condition){
    # code...


    // step
// }

$games = ['football','running','swimming','gym'];
$gamesCount = count($games);
$lastIndex = $gamesCount -1;

// $counter =0;
// while($counter <= $lastIndex){
//     echo $games[$counter] .'<br>';
//     $counter++;
// }


// $counter =$lastIndex;
// while($counter >= 0){
//     echo $games[$counter] .'<br>';
//     $counter--;
    // $counter -=1;
    // $counter = $counter - 1;
// }



// intailize counter
// do{
    # code...

    // step
// } while(condition);


// $dowhileCounter = $lastIndex;
// do{
//     echo $games[$dowhileCounter] .'<br>';
//     $dowhileCounter--;
// }while($dowhileCounter <= 0);

// $dowhileCounter = 0;
// do{
//     echo $games[$dowhileCounter] .'<br>';
//     $dowhileCounter++;
// }while($dowhileCounter <= $lastIndex);



// foreach ($array||$object AS $var1=>$var2) {

// }

// foreach ($array||$object AS $var) {

// }

$numbers = [10,20,30]; // indexed array
$genders = ['male'=>'ahmed','female'=>'may']; // associative array
$user = (object)['id'=>1,'name'=>'mohamed']; // object 

// foreach ($numbers as $index => $value) {
//     echo $index . ' ===>>> ' .$value.'<br>';
// }

// foreach ($genders as $key => $value) {
//     echo $key . ' ===>>> ' .$value.'<br>';
// }

// foreach ($user as $property => $value) {
//     echo $property . ' ===>>> ' .$value.'<br>';
// }

// foreach ($genders as $y) {
//     echo $y.'<br>';
// }