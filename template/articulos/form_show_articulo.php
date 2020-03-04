<form method="POST" action="<?= URL ?>articulos/updatearticulo" enctype="multipart/form-data">
<div class="form-group">
        <label for="inputid">Id</label>
        <input disabled type="number" value="<?= $this->articulo['id'] ?>" class="form-control" name="id" placeholder=""
            require>
        <small id="nameHelp"
            class="form-text text-danger"><?= (isset($this->errores['id']))? $this->errores['id']:null?></small>
    </div>
    <div class="form-group">
        <label for="inputnombre">Nombre</label>
        <input disabled type="text" value="<?= $this->articulo['nombre'] ?>" class="form-control" name="nombre" placeholder=""
            require>
        <small id="nameHelp"
            class="form-text text-danger"><?= (isset($this->errores['nombre']))? $this->errores['nombre']:null?></small>
    </div>
    <div class="form-group">
        <label for="inputprec">Precio</label>
        <input disabled type="number" value="<?= $this->articulo['precio'] ?>" min="0" step="0.01" class="form-control"
            name="precio" require>
        <small id="nameHelp"
            class="form-text text-danger"><?= (isset($this->errores['precio']))? $this->errores['precio']:null?></small>
    </div>
    <div class="form-group">
        <label for="inputmod">Fecha</label>
        <input disabled type="text" value="<?= $this->articulo['modificado'] ?>"class="form-control"
            name="modificado" require>
        <small id="nameHelp"
            class="form-text text-danger"><?= (isset($this->errores['modificado']))? $this->errores['modificado']:null?></small>
    </div>
    <input disabled type="hidden" name="MAX_FILE_SIZE" value="2097152" />
    <div class="form-group">
        <label for="inputFile">Imagen</label>
        <input disabled type="file" class="form-control-file" name="imagen">
    </div>
    <small id="nameHelp"
        class="form-text text-danger"><?= (isset($this->errores['imagen']))? $this->errores['imagen']:null?></small>

    <!-- botones acción -->
    <hr>
    <a href="<?= URL ?>articulos" class="btn btn-secondary" role="button" aria-pressed="true">Volver</a>

</form>