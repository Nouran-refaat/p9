<?php 


trait media {
    // public $name;
    // public static $x;
    // public static function x () {

    // }    
    public function uploadPhoto($image,$path)
    {
        return 'newPhotoName.extension<br>';
    }
}

trait operation {
    public function create()
    {
        echo "create <br>";
    }
}

trait generalTrait {
    use media , operation;
}

class userParent {
    public function order()
    {
        # code...
    }
}

class user extends userParent {
    use generalTrait;
}
class admin extends userParent {
    use generalTrait;
}

class supplier extends userParent {
    use generalTrait;
}

$user = new user;
echo $user->uploadPhoto('image','users');

