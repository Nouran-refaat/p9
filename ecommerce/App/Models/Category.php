<?php 

include_once "Connection/database.php";
include_once "Connection/operation.php";

class Category extends database implements operation {

    private $id;
    private $name;
    private $status;
    private $image;
    private $created_at;
    private $updated_at;
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

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
        return $this->runDQL("SELECT `categories`.`id`,`categories`.`name` FROM `categories` WHERE `categories`.`status` = 1 ORDER BY `categories`.`name` ASC");
    }

 

    public function searchOnCategory()
    {
        return $this->runDQL("SELECT `categories`.`id`
        FROM `categories` WHERE `categories`.`id` = $this->id AND `categories`.`status` = 1");    
    }

    public function productsByCat()
    {
        return $this->runDQL("SELECT
                                `categories`.`id` AS `category_id`,
                                `categories`.`name` AS `category_name`,
                                `products`.*
                            FROM
                                `categories`
                            JOIN `subcategories`
                            ON `categories`.`id` = `subcategories`.`category_id`
                            JOIN `products`
                            ON `products`.`subcategory_id` = `subcategories`.`id`
                            WHERE
                                `categories`.`id` = $this->id AND `categories`.`status` = 1");    
    }

    

    
}


?>