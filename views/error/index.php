<!doctype html>
<html lang="es"> 

<?php require_once("template/partials/head.php") ?>
<style>
    .alert {
        background-color: red;
        color: white;
    }
</style>
<body>
    <?php require_once("template/partials/menu.php") ?>
    
    <!-- Page Content -->
    <div class="container">
	<br><br><br><br>

		<?php require_once("template/partials/mensaje.php") ?>
		

		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				MVC - Error
			</div>
			<div class="card-body">
				<div class= "jumbotron">
                    <h1 class ="display-4">Error 404 - NOT FOUND</h1>
                    <p class="lead"><?= $this->mensaje?></p>
                    <hr>
                </div>
			</div>
		</div>


    </div>

    <!-- /.container -->
    
    <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
	
</body>

</html>