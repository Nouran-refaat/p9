<?php 

class cat {
    public $food = 'milk';

    public function assignNewFood($food)
    {
        $this->food = $food;
    }

    public function eat($food)
    {

       echo "this cat eats $food <br>";
       return $this;
    }

    public function returnObject()
    {
        return $this;
    }
}

$sheraz = new cat;
// $sheraz->eat('milk');
// echo $sheraz->food .'<br>';
$sheraz->assignNewFood('cheese');
// echo $sheraz->food .'<br>';
// $sheraz->eat('burger');
$sheraz->returnObject()->assignNewFood('cheese');


$syame = new cat;

// print_r($syame->returnObject());
?>