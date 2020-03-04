<form action="<?= URL ?>user/validar_registro" method="post">
  <fieldset>
      <div class="form-group">
        <label for="">Nombre</label>
        <input type="text"
          class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="Nombre entre 5 y 50 caracteres"
          value="<?= (isset($_POST['nombre'])) ? $_POST['nombre'] : null ?>">
      </div>
  </fieldset>
  <fieldset>
    <div class="form-group">
      <label for="">Correo Electronico</label>
      <input type="email" class="form-control" name="email" id="" aria-describedby="emailHelpId" placeholder="example@example.es"
      value="<?= (isset($_POST['email'])) ? $_POST['email'] : null ?>">
      <small id="helpId" class="form-text text-danger">
        <?= (isset($this->errores['email'])) ? $this->errores['email'] : null ?>
      </small>
      
    </div>
  </fieldset>
  <fieldset>
    <div class="form-group">
      <label for="">Contraseña</label>
      <input type="password" class="form-control" name="password" id="" placeholder="Contraseña entre 5 y 50 caracteres"
      value="<?= (isset($_POST['password'])) ? $_POST['password'] : null ?>">
      <small id="helpId" class="form-text text-danger">
        <?= (isset($this->errores['password'])) ? $this->errores['password'] : null ?>
      </small>
    </div>
  </fieldset>
  <fieldset>
    <div class="form-group">
      <label for="">Repetir Contraseña</label>
      <input type="password" class="form-control" name="password2" id="" placeholder="Repite la contraseña anterior">
    </div>
  </fieldset>

  <button type="submit" class="btn btn-primary">Registrarse</button>
  <a name="" id="" class="btn btn-secondary" href="<?= URL ?>user" role="button">Volver</a>
</form>
