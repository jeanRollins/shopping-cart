<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->itemModel = $this->model('Item');
        $this->session = $this->model('Session');
    }

    public function index(){

        $items = $this->itemModel->getItems();
        
        $this->session->init();
        

        $dates = [
            'items'  => $items
        ];
        $this->view('pages/start', $dates);
    }

    
    public function add()
    {
        $itemReceived['item'] = array();

        if(is_null($itemReceived['item'])){
            $error = [
                'message' => 'The item can not be null.'
            ];        
        }
        
        if(isset($itemReceived['item'])){
            $error = [
                'message' => 'The item can not be empty.'
            ];        
        }
        
        if(!isset($_SESSION['item'])){

            array_push($itemReceived['item'], (int) $_POST['id']); 

            $_SESSION['item'] = $itemReceived['item'];
            
            $this->view('pages/start', $_SESSION['item']);
        }
        else{
            array_push($_SESSION['item'], (int) $itemReceived['item']);

            $this->view('pages/start', $_SESSION['item']);
        }
    }
   
}