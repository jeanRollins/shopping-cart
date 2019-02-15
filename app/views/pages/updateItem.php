<?php require RUTE_APP .'/views/includes/header.php';?>
<div class="container mt-4">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-5">
            <div class="card border-light mb-3">
                <div class="card-header"><h2 >Actualizar Producto</h2></div>
                <div class="card-body">
                    <form action="<?php echo RUTE_URL;?>/controllerItem/update" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label for="category">Seleccionar Categoria</label>
                                <select class="form-control" id="category" name="category">
                                    <?php foreach ($dates['categories'] as $item) : ?>
                                        <option value="<?php echo $item->id_category;?>"
                                            <?php 
                                                if($item->id_category == $dates['items']->id_category){
                                                    echo "selected";    
                                                }
                                            ?>
                                        >
                                        <?php echo $item->name_category;?></option>
                                    <?php endforeach;?>  
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Precio</label>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" class="form-control"  value="<?php echo $dates['items']->price;?>" name="price" aria-label="Amount (to the nearest dollar)" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripcion :</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $dates['items']->description;?></textarea>
                                </div>
                            </div>
                            <input type="text" style="display:none;" value="<?php echo $dates['items']->image;?>" name="imageSaved">
                            <div class="form-group">
                                <?php if(empty($dates['items']->image)){
                                        echo "<p class='text-danger'>No tienes cargada ninguna imagen del producto, agrega una imagen.</p>";                                    
                                    }
                                    else{
                                        echo "<p class='text-success'>Ya tienes cargada una imagen.</p>";
                                    }
                                ?>
                                <label for="image" >Actualizar Imagen</label>
                                <input type="file" name="image" class="form-control-file" accept="image/png, image/jpeg">
                                <small id="fileHelp" class="form-text text-muted">Debe agregar una imagen deportiva.</small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="id" value="<?php echo $dates['items']->id;?>">Actualizar Item</button>
                        </fieldset>
                    </form>
                </div>
            </div>
           
        </div>
        <div class="col-5">
            <img src="<?php echo RUTE_URL;?>/public/img/buy-add.jpg" width="600" height="570" class="rounded img-add-item" alt="">
        </div>
    </div>
</div>

<?php require RUTE_APP . '/views/includes/footer.php'; ?>