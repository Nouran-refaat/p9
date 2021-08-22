<?php 
class registerRequest {
    private $email ;
    private $password;
    private $confirmPassword;
    

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
     * Get the value of Password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of confirmPassword
     */ 
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * Set the value of confirmPassword
     *
     * @return  self
     */ 
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    /**
     * @return array || empty Array
     * @param password
     * @param confrimPassword
     * / */
    public function passwordValidation()
    {
        $errors = [];
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        if(empty($this->password)){
            $errors['password-required'] = "<div class='alert alert-danger'> Password Is Required </div>";
        }
        if(empty($this->confirmPassword)){
            $errors['confirmPassword-required'] = "<div class='alert alert-danger'> Confirm Password Is Required </div>";
        }

        if(empty($errors)){
            if($this->password != $this->confirmPassword){
                $errors['password-confrim'] = "<div class='alert alert-danger'> Confirm Password Dosen't Match Your Password </div>";
            }

            if(!preg_match($pattern,$this->password)){
                $errors['password-pattern'] = "<div class='alert alert-danger'> Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character </div>";
            }
        }
        return $errors;
    }
    public function emailValidation()
    {
        $errors = [];
        $pattern = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
        if(empty($this->email)){
            $errors['email-required'] = "<div class='alert alert-danger'> Email Is Required </div>";
        }
        if(empty($errors)){
            if(!preg_match($pattern,$this->email)){
                $errors['email-patter'] = "<div class='alert alert-danger'> Wrong Email Format </div>";
            }
        }
        return $errors;
    }
}
?>