<form action="<?= URL ?>user/validate_changepass" method="post">
  <legend class="border-bottom">Cambiar Contraseña</legend>

  <fieldset>
    <div class="form-group">
      <label for="">Contraseña Actual</label>
      <input type="password" class="form-control" name="password_antigua" id="" placeholder=""
      value="<?= (isset($_POST['password_antigua'])) ? $_POST['password_antigua'] : null ?>">
      <small id="helpId" class="form-text text-muted">Introduce tu contraseña actual</small>
      <small id="helpId" class="form-text text-danger">
        <?= (isset($this->errores['password_antigua'])) ? $this->errores['password_antigua'] : null ?>
      </small>
    </div>
  </fieldset>

  <fieldset>
    <div class="form-group">
      <label for="">Nueva Contraseña</label>
      <input type="password" class="form-control" name="password" id="" placeholder=""
      value="<?= (isset($_POST['password'])) ? $_POST['password'] : null ?>">
      <small id="helpId" class="form-text text-muted">Introduce una nueva contraseña entre 5 y 60 caracteres</small>
      <small id="helpId" class="form-text text-danger">
        <?= (isset($this->errores['password'])) ? $this->errores['password'] : null ?>
      </small>
    </div>
  </fieldset>
  <fieldset>
    <div class="form-group">
      <label for="">Repetir Contraseña</label>
      <input type="password" class="form-control" name="password2" id="" placeholder="">
      <small id="helpId" class="form-text text-muted">Repetir contraseña</small>
    </div>
  </fieldset>

  <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
  <a name="" id="" class="btn btn-danger" href="<?= URL ?>partido" role="button">Cancelar</a>
</form>
