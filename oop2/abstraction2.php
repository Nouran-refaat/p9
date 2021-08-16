<?php 

// interface 

interface operations {
    // const x = 5;
    function create();
    function update();
    function delete();
    function read();
}


// echo operations::x;









class user implements operations{
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

class product implements operations {
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
// polymorphism (many forms) (تعدد الاوجهه)
?>