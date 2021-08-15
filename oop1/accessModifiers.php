<?php

// access modifiers (public , private , protected)
// inside class , child classes , global scope
// public => global scope, inside class , child classes
// protected => inside Class , child classes
// private => inside Class
class test {
    public $name = 'test';
    protected $phone = 123456;
    private $age = 25;

    public function insideClass()
    {
        echo $this->age;
    }
}


class testChild extends test {
    public function childClass()
    {
        echo $this->age;
    }
}


$test = new test;
// echo $test->age;
$test->insideClass();
$testChild = new testChild;
// $testChild->childClass();