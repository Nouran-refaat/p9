<?php

class category {
    private $name;
    function __construct()
    {
        echo " category <br>";
    }

    public function getName()
    {
       return $this->name;
    }

    public function setName($name)
    {
       $this->name = $name;
    }

    function __destruct()
    {
        echo " destruct category <br>";
    }
}
// $electronics = new category;
// $electronics->setName('laptops');
// echo $electronics->getName() . '<br>';
class product { 
    function __construct()
    {
        echo " product <br>";
    }
    function __destruct()
    {
        echo " destruct product <br>";
    }
}
// $laptop = new product;

// echo "hello <br>";


class magicConstants {

    public static function printMagic()
    {
        // echo __DIR__;
        // echo __FILE__;
        // echo __CLASS__;
        // echo __FUNCTION__;
        // echo __METHOD__;
        // echo __LINE__;
    }
}

magicConstants::printMagic();