<?php

class Item
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function getItems()
    {   
        $this->db->query('SELECT * FROM `shopping-car`.`items`');
        $itemFounded = $this->db->records();
        return $itemFounded;
    }

    public function addProduct($item)
    {
        $this->db->query('INSERT INTO `shopping-car`.`items` (price, description, category, image) VALUES (:price, :description, :category, :image); ');

        $this->db->bind(':price',$item['price']);
        $this->db->bind(':description',$item['description']);
        $this->db->bind(':category',$item['category']);
        $this->db->bind(':image',$item['image']);
        
        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}