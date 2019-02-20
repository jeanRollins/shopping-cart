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
        $itemsFounded = $this->itemModel-> getItemsEdit();

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

    public function editItems($pageCurrent)
    {   
        $pageCurrent = (int) $pageCurrent;
        $rute = '/pages/editItems/1';

        if($pageCurrent < 1){
            redirect($rute);
        }
        
        $articulesForPage = 4;

        $largeItemsFounded =  $this->itemModel->getLargeItem();
        
        $pages = $largeItemsFounded/3;
        $pages = ceil($pages);
        
        if($pageCurrent > $pages){
            redirect($rute);
        }
        
        $indexInit = ($pageCurrent-1) * $articulesForPage;
        
        $itemsFounded = $this->itemModel->getItemsPagination($indexInit, $articulesForPage);       

        $dates =[
            'items'        =>   $itemsFounded,
            'pages'        =>   $pages,
            'pageCurrent'  =>   (int) $pageCurrent
        ];
        
        $this->view('pages/editItems', $dates);
    }
   
}