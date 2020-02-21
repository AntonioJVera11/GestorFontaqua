<form method="POST" action="<?php echo URL; ?>nuevo/registrarCliente">
    <div class="form-group">
        <label for="">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" required="required" title="Apellidos" autofocus>
    </div>

    <div class="form-group">
        <label for="">Nombre</label>
        <input type="text" name="nombre" class="form-control" required="required" title="Nombre"  >
    </div>
    
    <div class="form-group">
        <label for="">Ciudad</label>
        <input type="text" name="ciudad" class="form-control" required="required" title="Nivel"  >
    </div>

    <div class="form-group">
        <label for="">Teléfono</label>
        <input type="tel" name="telefono" class="form-control" required="required" title="Teléfono"  >
    </div>

    <div class="form-group">
        <label for="">DNI</label>
        <input type="text" name="dni" class="form-control" required="required" title="DNI"  >
    </div>

    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control" required="required" title="Email" >
    </div>

    <!-- botones acción -->
    <a href="<?php echo URL; ?>index" class="btn btn-secondary" role="button" aria-pressed="true">Cancelar</a>
	<button type="reset" class="btn btn-secondary">Reset</button>
	<button type="submit" class="btn btn-primary">Añadir</button>
</form>
    