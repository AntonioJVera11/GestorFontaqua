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
                                    <?php foreach ($this->cabecera as $key => $valor): ?>
                                    <th><?=$valor?></th>
                                    <?php endforeach;?>
                                    <?php if (!empty($_SESSION['id'])): ?>
                                    <th>
                                        Acciones
                                    </th>
                                    <?php endif ?>
                                </tr>
                            </thead>	
                            <tbody>
                                    <?php foreach ($this->articulos as $registro => $value):?>
                                        <tr>
                                            <td><?=$value->id?></td>
                                            <td><?=$value->nombre?></td>
                                            <td><?=$value->precio?> €</td>
                                            <?php if (!empty($_SESSION['id'])): ?>
                                            <td style="display: block; white-space: nowrap; width: 31%; overflow: hidden"><?=$value->modificado?></td>
                                            <?php endif ?>
                                            <?php if (empty($_SESSION['id'])): ?>
                                            <td style="display: block; white-space: nowrap; width: 28%; overflow: hidden"><?=$value->modificado?></td>
                                            <?php endif ?>
                                            <td><img src="imagenes/<?=$value->imagen?>" width="40px" height="40px"></td>
                                            <?php if (!empty($_SESSION['id'])): ?>
                                            <td>
                                                <a href="<?= URL ?>articulos/show/<?=$value->id?>" title="Visualizar"><i class="material-icons">visibility</i></a>
                                                <a href="<?= URL ?>articulos/edit/<?=$value->id?>" title="Editar"><i class="material-icons">edit</i></a>
                                                <a href="<?= URL ?>articulos/delete/<?=$value->id?>"><i class="material-icons">clear</i></a>
                                            </td>
                                            <?php endif ?>
                                        </tr>
                                    <?php endforeach;?>
                            </tbody>			
                        </table>
                        <h6>El número de artículos es: <?= count($this->articulos);?></h6>
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