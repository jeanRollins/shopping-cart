<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->itemModel = $this->model('Item');
        $this->cart = $this->model('CartShopping');
        $this->category = $this->model('Category');
    }

    public function index()
    {
        $itemsFounded = $this->itemModel->getItems();

        $dates = [
            'items'  => $itemsFounded
        ];
        $this->view('pages/start', $dates);
    }

    public function add()
    {
        session_start();
        $itemToAdd = (int) $_POST['id'];
        
        if(is_null($itemToAdd)){
            $error = [
                'message' => 'The item can not be null.'
            ];        
        }
        
        if(isset($itemToAdd)){
            $error = [
                'message' => 'The item can not be empty.'
            ];        
        }
        $this->cart->addToCart($itemToAdd);
        //unset($_SESSION['item']);
        
        redirect('/pages');

    }

    public function addItem()
    {
        $categoriesFounded = $this->category->getCategories();

        $dates =[
            'items' => $categoriesFounded
        ];
        
        $this->view('pages/additem', $dates);
    }

    public function editItems()
    {   
        $itemsFounded = $this->itemModel->getItems();
        $categoriesFounded = $this->category->getCategories();

        $dates =[
            'items'         => $itemsFounded,
            'categories'    => $categoriesFounded
        ];
        
        $this->view('pages/editItems', $dates);
    }


   
}