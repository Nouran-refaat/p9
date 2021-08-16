<?php

// magic methods

class animal {
    private $food;
    private $name;
    function __construct($name)
    {
        // when you create an object from this class
        $this->name = $name;
    }
    /**
     * Get the value of food
     */ 
    public function getFood()
    {
        return $this->food;
    }

    /**
     * Set the value of food
     *
     * @return  self
     */ 
    public function setFood($food)
    {
        $this->food = $food;

        return $this;
    }

    public function eat()
    {
        echo "this $this->name eats $this->food <br>";
    }

}
$animal = new animal('cat');
$animal->setFood('milk');
$animal->eat();

$dog = new animal('dog');
$dog->setFood('bone');
$dog->eat();
// magic constants
