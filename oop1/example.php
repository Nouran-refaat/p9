<?php

// Samsung => NOTE20 , 256 Gbyte , 8 GRAM , 1080P , Charger => yes , wireless charger => no , can take photos , can make calls
// apple => iphone 12, 128 Gbyte , 6 GRAM , 4k , charger => no , Wireless Charger => no , can take photos , can make calls

class phone {
    public $brand;
    public $name;
    public $storage;
    public $RAM;
    public $resolution;
    public $charger;
    public $wirelessCharger = false;

    public function takePhoto()
    {
        echo "take photo from $this->brand $this->name <br>";
    }

    public function makeCall()
    {
        $this->takePhoto();
        echo "Call <br>";
    }
}

$samsung = new phone;
$samsung->brand = 'Samsung';
$samsung->name = 'NOTE 20';
$samsung->storage = 256;
$samsung->RAM = 8;
$samsung->resolution = '1080p';
$samsung->charger = true;
// $samsung->makeCall();


$apple = new phone;
$apple->brand = 'Apple';
$apple->name = 'Iphone 12';
$apple->storage = 128;
$apple->RAM = 6;
$apple->resolution = '4k';
$apple->charger = false;
$apple->makeCall();
// print_r($samsung);
// print_r($apple);
