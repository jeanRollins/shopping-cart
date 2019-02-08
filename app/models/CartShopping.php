<?php

class CartShopping
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function addToCart($itemToAdd):void
    {
        session_start();
        array_push($_SESSION['item'], $itemToAdd);
    }

}