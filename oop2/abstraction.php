<?php 

abstract class operations {
    // crud , create,update,delete,read
    public $name;
    public static $age;
    const x = 5;
    public function FunctionName1()
    {
        # code...
    }
    public static function FunctionName()
    {
        # code...
    }
    public abstract function create();
    public abstract function update();
    public abstract function delete();
    public abstract function read();
}

class user extends operations {
    public function create(){
        echo "user create";
    }
    public function update(){
        echo "user update";
    }
    public function delete(){
        echo "user delete";
    }
    public function read(){
        echo "user read";
    }
    
}

class product extends operations {
    public function create(){
        echo "product create";
    }
     public function update(){
        echo "product update";
    }
    public function delete(){
        echo "product delete";
    }
    public function read(){
        echo "product read";
    }
}

