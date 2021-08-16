<?php

// public , protected , private

class user {
    private $email;
    private $password;
    private $gender;
    private $name;
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    public function getGender()
    {
        if($this->gender == 'f'){
            $this->gender = 'female';
        }else{
            $this->gender = 'male';
        }
        return $this->gender;
    }
    public function setPassword($password)
    {
       $this->password = sha1($password);
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setEmail($email) //setter
    {
       $this->email = $email;
    }
    public function getEmail() //getter
    {
        return $this->email;
    }

}

$soaad = new user;
$soaad->setEmail('soaad@gmail.com');
$soaad->setPassword(123456789);
$soaad->setGender('f');
print_r($soaad->getGender());