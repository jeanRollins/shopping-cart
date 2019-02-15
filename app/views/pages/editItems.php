<?php require RUTE_APP .'/views/includes/header.php';?>
<div class="container mt-4">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-5">
            <h2>Editar Productos</h2>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-11">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="border-left">Codigo Producto</th>
                        <th scope="col" class="border-left">Precio</th>
                        <th scope="col" class="border-left">Descripcion</th>
                        <th scope="col" class="border-left">Categoria</th>
                        <th scope="col" class="border-left">Imagen</th>
                        <th scope="col" class="border-left">Editar</th>
                        <th scope="col" class="border-right border-left">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dates['items'] as $item) : ?>
                        <tr>
                            <th scope="row" class="border-bottom border-left"><?php echo $item->id; ?></th>
                            <td class="border-left border-bottom"><?php echo "$".$item->price; ?></td>
                            <td class="border-left border-bottom"><?php echo $item->description; ?></td>
                            <td class="border-left border-bottom"><?php echo $item->name_category; ?></td>
                            <td class="border-left border-bottom"><img src="<?php echo RUTE_URL .'/public/img/' . $item->image;?>"  width="50" height="35"></td>
                            <td class="border-left border-bottom">
                                <form action="<?php echo RUTE_URL;?>/controllerItem/edit" method="POST">
                                    <button type="submit" class="btn btn-primary" name="id" value="<?php echo $item->id; ?>">Editar</button>
                                </form>
                            </td>
                            <td class="border-left border-right border-bottom">
                                <form action="<?php echo RUTE_URL;?>/controllerItem/delete" method="POST">
                                    <button type="submit" class="btn btn-danger" name="id" value="<?php echo $item->id; ?>">Borrar</button>    
                                </form>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
    <div class="col-4"></div>
    <div class="col">
        <ul class="pagination">
            <li class="page-item <?php echo $dates['pageCurrent'] <= 1 ? 'disabled' : '' ;?>">
                <a class="page-link" href="<?php echo RUTE_URL . '/pages/editItems/'. ($dates['pageCurrent'] - 1);?>">&laquo;</a>
            </li>
            <?php for($i = 0 ; $i < $dates['pages'] ; $i++): ?>
                <li class="page-item <?php echo $dates['pageCurrent'] == ($i + 1) ? 'active' : '' ;?>">
                    <a class="page-link " href="<?php echo RUTE_URL . '/pages/editItems/'.($i + 1) ;?>">
                        <?php echo ($i + 1);?>
                    </a>
                </li>
            <?php endfor?>
            <li class="page-item <?php echo $dates['pageCurrent'] >= $dates['pages'] ? 'disabled' : '' ;?>">
                <a class="page-link" href="<?php echo RUTE_URL . '/pages/editItems/'. ($dates['pageCurrent'] + 1);?>">&raquo;</a>
            </li>
        </ul>
    </div>
    
    </div>
   
</div>
<?php require RUTE_APP . '/views/includes/footer.php'; ?>