<?php

class database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'nti_ecommerce';
    private $con;
    // database connection
    function __construct()
    {
        $this->con = new mysqli($this->host,$this->username,$this->password,$this->database);
        if($this->con->connect_error){
            die("Connection Failed:".$this->con->connect_error);
        }
        // else{
        //     die('ok');
        // }
    }

    // insert-update-delete , return TRUE , FALSE
    public function runDML($query)
    {
        $result = $this->con->query($query);
        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    // selects, return [] , Empty []
    public function runDQL($query)
    {
        $result = $this->con->query($query);
        if($result->num_rows > 0) {
            return $result;
        }else{
            return [];
        }
    }

}

?>