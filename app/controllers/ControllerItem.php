<?php 

class ControllerItem extends Controller
{
    public function __construct()
    {
        $this->item = $this->model('Item');
    }

    public function addItem()
    {
        $error = array();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $imageReceived = $_FILES['image']['tmp_name'];
            $nameImageReceived = $_FILES['image']['name'];

            if(empty($imageReceived)){
                $error[] = [
                    'message' => 'The imageReceived can not be empty.',
                    'code'    =>  1001
                ];        
            }
            
            if(!isset($imageReceived)){
                $error[] = [
                    'message' => 'The imageReceived can not be empty.',
                    'code'    =>  1000
                ];        
            }

            $rute = RUTE_IMAGE . $nameImageReceived;
    
            move_uploaded_file($imageReceived,$rute);

            $itemToAdd = [
                'price'       => filter_var($_POST['price'] , FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                'category'    => filter_var($_POST['category'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                'description' => filter_var($_POST['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                'image'       => $rute              
            ];
            
            if(!isset($itemToAdd['price'])){
                $error[] = [
                    'message' => 'The itemToAdd[price] can not be empty.',
                    'code'    =>  1000
                ];        
            }

            if(empty($itemToAdd['price'])){
                $error[] = [
                    'message' => 'The itemToAdd[price] can not be empty.',
                    'code'    =>  1001
                ];        
            }

            $itemToAdd['price'] = (int) trim($itemToAdd['price']);
            
            if($itemToAdd['price'] < 1000 || $itemToAdd['price'] > 1000000)
            {
                $error[] = [
                    'message' => 'The itemToAdd[price] must be greater than 1000 and less than 1000000.',
                    'code'    =>  1002
                ];
            }

            if(empty($itemToAdd['category'])){
                $error[] = [
                    'message' => 'The itemToAdd[category] can not be empty.',
                    'code'    =>  1001
                ];        
            }
            
            if(!isset($itemToAdd['category'])){
                $error[] = [
                    'message' => 'The itemToAdd[category] can not be empty.',
                    'code'    =>  1000
                ];        
            }

            $itemToAdd['category'] = trim($itemToAdd['category']);

            if(strlen($itemToAdd['category']) < 3 || strlen($itemToAdd['category']) > 15){
                $error[] = [
                    'message' => 'The itemToAdd[category] must have a length greater than 4 and less than 15.',
                    'code'    =>  1002
                ]; 
            }

            if(empty($itemToAdd['description'])){
                $error[] = [
                    'message' => 'The itemToAdd[description] can not be empty.',
                    'code'    =>  1001
                ];        
            }
            
            if(!isset($itemToAdd['description'])){
                $error[] = [
                    'message' => 'The itemToAdd[description] can not be empty.',
                    'code'    =>  1000
                ];        
            }

            if(strlen($itemToAdd['description']) < 10 || strlen($itemToAdd['description']) > 500){
                $error[] = [
                    'message' => 'The itemToAdd[description] must have a length greater than 10 and less than 500.',
                    'code'    =>  1002
                ]; 
            }

          

            if($this->item->addProduct($itemToAdd)){
                redirect('/pages');
            }
            else{
                die('Algo Salio mal');
            }

        }
        else{
            $itemToAdd = [
                'price'       =>  '',
                'category'    =>  '',
                'description' =>  '',
                'image'       =>  ''             
            ];

            $this->view('pages/additem');
        }
    }

}