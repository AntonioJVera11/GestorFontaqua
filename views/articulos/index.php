<?php

    require_once "models/articulosModel.php";
	$nuevo = new articulosModel();
	$articulos = $nuevo->get();
	$cabecera = $nuevo->cabeceraTabla();

?>
<!doctype html>
<html lang="es"> 

<?php require_once("template/partials/head.php") ?>

<body>
    <?php require_once("template/partials/menu.php") ?>
    
    <!-- Page Content -->
    <div class="container">
	<br><br><br><br>

		<?php require_once("template/partials/mensaje.php") ?>
		

		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				MVC - Sección Artículos
			</div>
			<div class="card-body">
			<section>
                    <article>
                        <?php require_once("template/articulos/menubar.php")?>
                        <br>
                        <table class ="table">
                            <thead>
                                <tr>
                                    <?php foreach ($cabecera as $key => $valor): ?>
                                    <th><?=$valor?></th>
                                    <?php endforeach;?>
                                    <th>
                                        Acciones
                                    </th>
                                </tr>
                            </thead>	
                            <tbody>
                                    <?php foreach ($articulos as $registro => $value):?>
                                        <tr>
                                            <td><?=$value->id?></td>
                                            <td><?=$value->descripcion?></td>
                                            <td><?=$value->precio_costo?></td>
                                            <td><?=$value->precio_venta?></td>
                                            <td><?=$value->categoria_id?></td>
                                            <td><?=$value->stock?></td>
                                            <td><img src="imagenes/<?=$value->imagen?>" width="40px" height="40px"></td>
                                            <td>
                                                <a href="#" title="Visualizar"><i class="material-icons">visibility</i></a>
                                                <a href="#" title="Editar"><i class="material-icons">edit</i></a>
                                                <a href="#" title="Eliminar"><i class="material-icons">clear</i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                            </tbody>			
                        </table>
                        <h5>El número de artículos es: <?= count($articulos);?></h4>
                    </article>
                </section>

			</div>
		</div>
    </div>

    <!-- /.container -->
    
    <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
	
</body>

</html>