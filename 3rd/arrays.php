<?php
// arrays
//1) indexed arrays (array with numeric index)

$name = 'ahmed';
$password = 123456;
$email = 'galal.husseny@gmail.com';
// $user = [$name,$password,$email,true,5.5,NULL];
// $user = array($name,$password,$email,true,5.5,NULL);
$array = [1,2,3,4,5];

$productName = 'ihpone12';
$productPrice = 152;
$productImage = 'default.png';
$productDetails = 'product gamd';
$productsSpecs = '256 G Ram';

$product1 = ['ihpone12', 152,'default.png','product gamd','256 G Storage']; // how to decalre

// echo $product1[3]; // get value
$product1[1] = 17000; // edit value
$product1[5] = '8GRAM'; // set new value
$product1[6] = 'No Charger';
$product1[10] = '1080P Reslotion';
$product1[7] = 'AirPods';
$product1[-7] = 'test';
$product1[-5] = 'test2';
// $_POST[5];
// echo $product1[1];

// print_r($product1);

$numbers = [784,21,5,215,99,2515,251,21,51,2,15,15,5,151,51,515];
// print_r($numbers);



//2) associative array (array with string keys) => array operator

// $user = ['name'=>'samir','age'=>26,'gender'=>'male','email'=>'email@email.com','password'=>'123456Samir','code'=>NULL,'status'=>true,'age'=>60];
// $user = array('name'=>'samir','age'=>26,'gender'=>'male','email'=>'email@email.com','password'=>'123456Samir','code'=>NULL,'status'=>true);

// print_r($user['email']); // how to get value
// $user['age'] = 46; // how to edit
// $user['phone'] = '01000498488';
// print_r($user);


// object (property , values)
$user = (object)['name'=>'samir','age'=>26,'gender'=>'male','email'=>'email@email.com','password'=>'123456Samir','code'=>NULL]; // decalre
// print_r($user->name); // how to get value
$user->age = 50; // edit value
$user->status = true; // set value
// print_r($user);
