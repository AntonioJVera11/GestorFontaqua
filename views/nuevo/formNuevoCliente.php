
<form method="POST" action="procesar.php" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="inputdescrip">Descripcion</label>
        <input type="text" class="form-control" name="descripcion" placeholder="">
    </div>
    <div class="form-group">
        <label for="inputprec">Precio Costo</label>
        <input type="number" min="0" step="0.01" class="form-control" name="precio_costo" placeholder="">
    </div>
    <div class="form-group">
        <label for="inputprev">Precio Venta</label>
        <input type="number" min="0" step="0.01" class="form-control" name="precio_venta" placeholder="">
    </div>
    <div class="form-group">
        <label for="inputund">Unidades</label>
        <input type="number" class="form-control" name="stock" placeholder="">
    </div>
    <div class="form-group">
        <label for="inputcat">Categoria</label>
        <input type="text" class="form-control" name="categoria_id" placeholder="">
    </div>
    <div class="form-group">
        <label for="inputFile">Imagen</label>
        <input type="file" name="inputFile">
    </div>				  				
    <!-- botones acción -->
    <a href="articulos" class="btn btn-secondary" role="button" aria-pressed="true">Cancelar</a>
	<button type="reset" class="btn btn-secondary">Reset</button>
    <button type="submit" class="btn btn-primary" formaction="addArticulo.php">Añadir</button>
    
</form>
    