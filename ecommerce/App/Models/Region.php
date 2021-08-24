<?php 

include_once "Connection/database.php";
include_once "Connection/operation.php";

class Region extends database implements operation {

    private $id;
    private $name;
    private $status;
    private $latitude;
    private $longitude;
    private $distance;
    private $city_id;
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
    public function setCity_id($city_id)
    {
        $this->city_id = $city_id;

        return $this;
    }

    
    /**
     * Get the value of updated_at
     */ 
    public function getCity_id()
    {
        return $this->city_id;
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
        return $this->runDQL("SELECT `regions`.`id`,`regions`.`name` FROM `regions` ORDER BY `regions`.`name` ASC");
    }

    public function selectRegionsByCity()
    {
        return $this->runDQL("SELECT `regions`.`id`,`regions`.`name` FROM `regions` WHERE `regions`.`city_id` = $this->city_id ORDER BY `regions`.`name` ASC");
    }

    
}


?>