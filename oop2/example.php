<?php

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
    public  function login()
    {
        echo "login from user";
    }
}


class admin extends user {
    public function login()
    {
        echo "login from admin";
    }
}




$admin = new admin;
$admin->login();

$user = new user;
$user->login();