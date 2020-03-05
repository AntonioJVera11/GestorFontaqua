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
				Mostrar Artículo
			</div>
			<div class="card-body">
                <?php require_once("template/articulos/form_show_articulo.php")?>
			</div>
		</div>

    </div>

    <!-- /.container -->
    
    <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
	
</body>

</html>