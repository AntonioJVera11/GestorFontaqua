<form method="POST" action="<?= URL ?>articulos/registrar" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="inputdescrip">Descripcion</label>
        <input type="text" value = "<?= $this->articulo['descripcion'] ?>" class="form-control" name="descripcion" placeholder="" require>
        <small id="nameHelp" class="form-text text-danger"><?= (isset($this->errores['descripcion']))? $this->errores['descripcion']:null?></small>
    </div>
    <div class="form-group">
        <label for="inputprec">Precio Costo</label>
        <input type="number" value = "<?= $this->articulo['precio_costo'] ?>" min="0" step="0.01" class="form-control" name="precio_costo" require>
        <small id="nameHelp" class="form-text text-danger"><?= (isset($this->errores['precio_costo']))? $this->errores['precio_costo']:null?></small>
    </div>
    <div class="form-group">
        <label for="inputprev">Precio Venta</label>
        <input type="number" value = "<?= $this->articulo['precio_venta'] ?>" min="0" step="0.01" class="form-control" name="precio_venta" require>
        <small id="nameHelp" class="form-text text-danger"><?= (isset($this->errores['precio_venta']))? $this->errores['precio_venta']:null?></small>
    </div>
    <div class="form-group">
        <label for="inputund">Unidades</label>
        <input type="number" value = "<?= $this->articulo['stock'] ?>"class="form-control" name="stock" value="0">
        <small id="nameHelp" class="form-text text-danger"><?= (isset($this->errores['stock']))? $this->errores['stock']:null?></small>
    </div>
    
    <div class="form-group">
      <label for="">Categoría</label>
      <select class="form-control" name="categoria_id" id="">
      <?php while($categoria = $this->categorias->fetch()): ?>
        <option value="<?= $categoria->id ?>" <?= ($this->articulo['categoria_id'] == $categoria->id) ? 'selected': null ?> ><?= $categoria->nombre ?></option>
      <?php endwhile; ?>
      </select>
      <small id="nameHelp" class="form-text text-danger"><?= (isset($this->errores['categoria_id']))? $this->errores['categoria_id']:null?></small>
    </div>

    <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
    <div class="form-group">
        <label for="inputFile">Imagen</label>
        <input type="file" class="form-control-file" name="imagen">
    </div>
    <small id="nameHelp" class="form-text text-danger"><?= (isset($this->errores['imagen']))? $this->errores['imagen']:null?></small>	
    			  				
    <!-- botones acción -->
    <hr>
    <a href="<?= URL ?>articulos" class="btn btn-secondary" role="button" aria-pressed="true">Cancelar</a>
	<button type="reset" class="btn btn-secondary">Reset</button>
    <button type="submit" class="btn btn-primary" >Añadir</button>
    
</form>