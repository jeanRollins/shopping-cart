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

}