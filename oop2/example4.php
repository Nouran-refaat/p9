<?php

interface z {
    function test();
    function test2();
}


class x {
    function test(){
        echo "test from x";
    }
}


class y extends x implements z {
    function test2(){

    }
}

class g extends y implements z {

}


/* */



class user {
    private $email;
    private $password;

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}

$marina = new user;
$marina->setEmail('galal@gmail.com');
$marina->setPassword('123456');
class login {
    public $emailDB = 'galal@gmail.com';
    public $passwordDB = '123456';
    public function handle(user $user)
    {
        if($this->emailDB == $user->getEmail() && $this->passwordDB == $user->getPassword()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}


$attemptLogin = new login;
$result = $attemptLogin->handle($marina);
if($result){
    echo "correct attempt";
}else{
    echo "wrong attempt";
}

// traits
// namespaces
// autoload class