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
                <?php var_dump($dates);?>
                <?php foreach ($dates as $item) : ?>
                    <tr>
                        <th scope="row" class="border-left"><?php echo $item['items']->id; ?></th>
                        <td class="border-left"><?php echo "$".$item['items']->price; ?></td>
                        <td class="border-left"><?php echo $item['items']->description; ?></td>
                        <td class="border-left"><?php echo $item->category; ?></td>
                        <td class="border-left"><img src="<?php echo RUTE_URL .'/public/img/' . $item->image;?>"  width="50" height="35"></td>
                        <td class="border-left">
                            <form action="<?php echo RUTE_URL;?>/controllerItem/edit" method="POST">
                                <button type="submit" class="btn btn-primary" name="id" value="<?php echo $item->id; ?>">Editar</button>
                            </form>
                        </td>
                        <td class="border-left border-right">
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
</div>
<?php require RUTE_APP . '/views/includes/footer.php'; ?>