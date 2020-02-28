<?php

    require_once "models/articulosModel.php";
	$nuevo = new articulosModel();
	$articulos = $nuevo->get();
    $cabecera = $nuevo->cabeceraTabla();
    // var_dump($cabecera);
    // exit(0);

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
				Artículos registrados
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
                                            <td><?=$value->nombre?></td>
                                            <td><?=$value->precio?> €</td>
                                            <td><?=$value->modificado?></td>
                                            <td><img src="imagenes/<?=$value->imagen?>" width="40px" height="40px"></td>
                                            <td>
                                                <a href="<?= URL ?>articulos/show/<?=$value->id?>" title="Visualizar"><i class="material-icons">visibility</i></a>
                                                <a href="<?= URL ?>articulos/edit/<?=$value->id?>" title="Editar"><i class="material-icons">edit</i></a>
                                                <a href="<?= URL ?>articulos/delete/<?=$value->id?>"><i class="material-icons">clear</i></a>
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