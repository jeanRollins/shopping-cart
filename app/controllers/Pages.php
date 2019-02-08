<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->itemModel = $this->model('Item');
        $this->cart = $this->model('CartShopping');
    }

    public function index(){

        $items = $this->itemModel->getItems();

        $dates = [
            'items'  => $items
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
        
        redirect('/');

    }
   
}