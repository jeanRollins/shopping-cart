<?php 
    require RUTE_APP .'/views/includes/header.php';

    session_start();
    
?>
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <div class="center-block">
                <a href="">
                    <i style="font-size: 30px;" class="fas fa-shopping-bag ml-5">&nbsp Total productos:
                        <?php 
                            if(empty($_SESSION['item'])){
                                $_SESSION['item'] = array();
                                echo 0;
                            }else{
                                echo count($_SESSION['item']);
                            }
                        ?>
                    </i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($dates['items'] as $item) : ?>
            <div class="col-3 my-3">
                <div class="card">
                    <form action="<?php echo RUTE_URL;?>/pages/add/<?php echo $item->id; ?>" method="POST">
                        <img height="250"  src="data:image/jpg;base64,<?php echo base64_encode($item->image);?>" alt="" class="card-img-top p-4">
                        <div class="card-body">
                            <h5><?php echo "$".$item->price; ?></h5>
                            <p><?php echo $item->description; ?></p>
                            <p><span class="badge badge-primary badge-block">Category : <?php echo $item->category;?></span></p>
                            <button type="submit" class="btn btn-outline-primary btn-block" name="id" value="<?php echo $item->id; ?>" >Agregar Producto</button>
                        </div>  
                    </form>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>
<?php require RUTE_APP . '/views/includes/footer.php'; ?>