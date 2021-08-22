<?php 

include_once "Connection/database.php";
include_once "Connection/operation.php";

class Cart extends database implements operation {

    private $user_id;
    private $quanity;
    private $product_id;
    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * Get the value of product_id
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */ 
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of quanity
     */ 
    public function getQuanity()
    {
        return $this->quanity;
    }

    /**
     * Set the value of quanity
     *
     * @return  self
     */ 
    public function setQuanity($quanity)
    {
        $this->quanity = $quanity;

        return $this;
    }


    public function insertData()
    {
        # code...
    }
    public function updateData()
    {
        # code...
    }
    public function deleteData()
    {
        # code...
    }
    public function selectData()
    {
        # code...
    }

}


?>