<?php 


trait media {
    public function uploadPhoto()
    {
       echo "photo from media trait";
    }
}


trait operation {
    public function uploadPhoto()
    {
       echo "photo from operation trait";
    }
}


class user {
    use media,operation {
        media::uploadPhoto AS mediaUploadPhoto;
        operation::uploadPhoto insteadOf media;
    }
}

$user = new user;
$user->mediaUploadPhoto();



interface test {
    function test();
}
interface test2 {
    function test2();
}

// PHP multiple implements , single inheritance
class test3 implements test,test2 {
    function test(){

    }
    function test2(){

    }
}