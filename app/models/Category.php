<?php

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function getCategories()
    {
        $this->db->query("SELECT * FROM `shopping-car`.`categories`");
        $categoriesFounded = $this->db->records();
        return $categoriesFounded;
    }
}