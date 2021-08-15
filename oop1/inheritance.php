<?php


// inheritance
// parent class (super class)
// child class 
class phone
{
    public $brand;
    public $name;
    public $storage;
    public $RAM = 8;
    public $resolution;
    public $charger;
    public function takePhoto()
    {
        echo "take photo<br>";
    }
    public function makeCall()
    {
        echo "Call <br>";
    }
}

class samsung extends phone
{
    public function alwaysOnDisplay()
    {
        echo "alwaysondisplay";
    }
}
$a70 = new samsung;
$a70->alwaysOnDisplay();
// print_r($a70);
class apple extends phone
{
    public function faceID()
    {
        echo "faceID";
    }
}
$iphonex = new apple;
$iphonex->faceID();
// print_r($iphonex);
class oppo extends phone
{

}
$f7 = new oppo;
$f7->alwaysOnDisplay();
$f7->faceID();
print_r($f7);
