<?php 

class ControllerItem extends Controller
{
    public function __construct()
    {
        $this->item = $this->model('Item');
        $this->category = $this->model('Category');
    }


    public function edit()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $error = array();

            $idReceived = filter_var($_POST['id'] , FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

            if(!isset($idReceived)){
                $error[] = [
                    'message' => 'The idReceived can not be empty.',
                    'code'    =>  1000
                ];        
            }
            
            if(empty($idReceived)){
                $error[] = [
                    'message' => 'The idReceived can not be empty.',
                    'code'    =>  1001
                ];        
            }

            $idReceived = (int) trim($idReceived);
            
            if($idReceived === 0){
                $error[] = [
                    'message' => 'The idReceived can not be in 0.',
                    'code'    =>  1003
                ];        
            }

            $itemsFounded = $this->item->getItem($idReceived);
            $categoriesFounded = $this->category->getCategories();

            $dates = [
                'items'       => $itemsFounded,
                'categories'  => $categoriesFounded
            ];

            $this->view('pages/updateItem', $dates);
        }
    }

    public function update()
    {
        $error = array();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if($_FILES['image']['name']) {

                $imageReceived = $_FILES['image']['tmp_name'];
                $nameImageReceived = $_FILES['image']['name'];
            
                $itemToAdd = [
                    'id'          => (int) $_POST['id'] ,
                    'price'       => filter_var($_POST['price'] , FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                    'idCategory'  => filter_var($_POST['category'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                    'description' => filter_var($_POST['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                    'image'       => saveImage($nameImageReceived, $imageReceived)            
                ];

                $ruteForDelete = RUTE_IMAGE . $_POST['imageSaved'];

                if (!file_exists($ruteForDelete)) {
                    $error[] = [
                        'message' => 'The file not exists.',
                        'code'    =>  1003
                    ];  
                }

                if(!unlink($ruteForDelete)){
                    $error[] = [
                        'message' => 'The file not can delete.',
                        'code'    =>  1004
                    ];
                }
                
                if(count($error)!=0){
                    return json_encode($error);
                }
                
            }else{
                $itemToAdd = [
                    'id'          => (int) $_POST['id'] ,
                    'price'       => filter_var($_POST['price'] , FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                    'idCategory'  => filter_var($_POST['category'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                    'description' => filter_var($_POST['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                    'image'       => $_POST['imageSaved']            
                ];

            }
            
            if(!isset($itemToAdd['id'])){
                $error[] = [
                    'message' => 'The itemToAdd[id] can not be empty.',
                    'code'    =>  1000
                ];        
            }
            
            if(empty($itemToAdd['id'])){
                $error[] = [
                    'message' => 'The itemToAdd[id] can not be empty.',
                    'code'    =>  1001
                ];        
            }
            
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

            if(empty($itemToAdd['idCategory'])){
                $error[] = [
                    'message' => 'The itemToAdd[idCategory] can not be empty.',
                    'code'    =>  1001
                ];        
            }
            
            if(!isset($itemToAdd['idCategory'])){
                $error[] = [
                    'message' => 'The itemToAdd[idCategory] can not be empty.',
                    'code'    =>  1000
                ];        
            }

            $itemToAdd['idCategory'] = trim($itemToAdd['idCategory']);

            if(strlen($itemToAdd['idCategory']) < 3 || strlen($itemToAdd['idCategory']) > 15){
                $error[] = [
                    'message' => 'The itemToAdd[idCategory] must have a length greater than 4 and less than 15.',
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
            
            if($this->item->updateItem($itemToAdd)){
                redirect('/pages/editItems');
            }
            else{
                die('Algo Salio mal');
            }
        }
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

            $itemToAdd = [
                'price'       => filter_var($_POST['price'] , FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                'idCategory'    => filter_var($_POST['category'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                'description' => filter_var($_POST['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
                'image'       => saveImage($nameImageReceived, $imageReceived)            
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

            if(empty($itemToAdd['idCategory'])){
                $error[] = [
                    'message' => 'The itemToAdd[idCategory] can not be empty.',
                    'code'    =>  1001
                ];        
            }
            
            if(!isset($itemToAdd['idCategory'])){
                $error[] = [
                    'message' => 'The itemToAdd[idCategory] can not be empty.',
                    'code'    =>  1000
                ];        
            }

            $itemToAdd['idCategory'] = trim($itemToAdd['idCategory']);

            if(strlen($itemToAdd['idCategory']) < 3 || strlen($itemToAdd['idCategory']) > 15){
                $error[] = [
                    'message' => 'The itemToAdd[idCategory] must have a length greater than 4 and less than 15.',
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

    public function delete()
    {
        if($_SERVER['REQUEST_METHOD']== 'POST'){

            $idReceived = filter_var($_POST['id'] , FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

            if(!isset($idReceived)){
                $error[] = [
                    'message' => 'The idReceived can not be empty.',
                    'code'    =>  1000
                ];        
            }
            
            if(empty($idReceived)){
                $error[] = [
                    'message' => 'The idReceived can not be empty.',
                    'code'    =>  1001
                ];        
            }

            $idReceived = (int) trim($idReceived);
            
            if($idReceived === 0){
                $error[] = [
                    'message' => 'The idReceived can not be in 0.',
                    'code'    =>  1003
                ];        
            }

            $idFounded = $this->item->getItem($idReceived);
            
            $idFounded = (int) $idFounded->id;

            if($idReceived === $idFounded) {
                
                if($this->item->deleteItem($idReceived)){
                    redirect('/pages/editItems');
                }
                else{
                    die("ERROR");
                }
            }
        }
    }
}