<?php

// classes => use to organize application structure (local scope)
// class=> group similar tasks 

// objects => to deal with class into glboal scope

// features
//  more clean , more organized
// easy to maintain
// more dynamic 
// more secure

// principles of oop
// 1) inheritance
// 2) encapsulation 
// 3) abstraction 
// 4) polymorphism 
// $x;
class user {
    public $name; // property
    public $age;
    public $gender;
    public $status;
    public $phone;
    public $image = 'default.png';
    public function login() // method
    {
        // pseudo vairable $this => refer to object
       echo 'login '.$this->name.' <br>';
    }
    public function logout() // method
    {
       echo 'logout <br>';
    }
}


$toqaya = new user();
$toqaya->name = 'toqaya';
$toqaya->age = 20;
$toqaya->gender = 'f';
$toqaya->phone = null;
$toqaya->status = TRUE;
$toqaya->front = 'good';
// $toqaya->login();
// print_r($toqaya);

$galal = new user;
$galal->name = "galal";
// $galal->login();
// print_r($galal);

$ahmed = new user;
$ahmed->name = 'ahmed';
// $ahmed->login();