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

    public function getItemsPagination($indexInit, $articlesForPage)
    {
        $this->db->query('SELECT * FROM `shopping-car`.`categories` INNER JOIN `shopping-car`.`items` on categories.id_category = items.id_category LIMIT :indexInit, :articlesForPage');
        $this->db->bind(':indexInit',$indexInit);
        $this->db->bind(':articlesForPage',$articlesForPage);
        $itemFounded = $this->db->records();
        return $itemFounded;
    }    

    public function getItemsEdit()
    {
        $this->db->query('SELECT * FROM `shopping-car`.`categories` INNER JOIN `shopping-car`.`items` on categories.id_category = items.id_category');
        $itemFounded = $this->db->records();
        return $itemFounded;
    } 

    public function getItem($id)
    {   
        $this->db->query('SELECT * FROM `shopping-car`.`items` WHERE id=:id');
        $this->db->bind(':id',$id);
        $itemFounded = $this->db->registry();
        return $itemFounded;
    }

    public function getLargeItem()
    {
        $this->db->query('SELECT * FROM `shopping-car`.`categories` INNER JOIN `shopping-car`.`items` on categories.id_category = items.id_category');
        $largeItems = $this->db->rowCount();
        return $largeItems;
    } 

    
    public function updateItem($item)
    {
        $this->db->query('UPDATE `shopping-car`.`items` SET 
            price=:price,
            description =:description,
            id_category=:id_category,
            image= :image 
            WHERE id=:id');
        
        $this->db->bind(':id',$item['id']);
        $this->db->bind(':price',$item['price']);
        $this->db->bind(':description',$item['description']);
        $this->db->bind(':id_category',$item['idCategory']);
        $this->db->bind(':image',$item['image']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function deleteItem($id)
    {   
        $this->db->query('DELETE FROM `shopping-car`.`items` WHERE id=:id ');
        $this->db->bind(':id',$id);
        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function addProduct($item)
    {
        $this->db->query('INSERT INTO `shopping-car`.`items` (price, description, id_category, image) VALUES (:price, :description, :id_category, :image); ');

        $this->db->bind(':price',$item['price']);
        $this->db->bind(':description',$item['description']);
        $this->db->bind(':id_category',$item['idCategory']);
        $this->db->bind(':image',$item['image']);
        
        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}