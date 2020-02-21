<?php require 'views/template/header-cdn.php'; ?>

<div class="container">

    <!-- Cabecera -->
    <div class="jumbotron">
            <h1 class="display-4">Bienvenido a Gesbank</h1>
            <p class="lead">Añadir Nuevo Cliente</p>
    </div>
    <!-- Menú Desactivado -->
    <?php  require 'views/template/mainmenu.php'; ?>
    <!-- Mensajes -->
    <?php if (!empty($this->mensaje)) {
        require 'views/template/mensajes.php';
    }
    
    ?>
    
    <div class="card">
        <div class="card-header">
            Añadir Cliente
        </div>
        <div class="card-body">
            <h5 class="card-title">Formulario Cliente</h5>
            
            <?php require 'views/nuevo/formNuevoClienteProv.php' ?>

        </div>
    </div>
    <?php require 'views/template/pie.php'; ?>
</div>
<?php require 'views/template/footer-cdn.php'; ?>