<div class="col-md-4 col-md-offset-4">
<form class="form-horizontal" role="form" method="post">
  <h1 class="text-center">Connexion</h1>
  <div class="form-group <?php echo isset($username_error) ? 'has-error' : '' ?>">
    <label for="username" class="control-label">Identifiant</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Identifiant">
    <?php if (isset($username_error)): ?>
      <span class="help-block"><?= $username_error ?></span>
    <?php endif; ?>
  </div>
  <div class="form-group <?php echo isset($password_error) ? 'has-error' : '' ?>">
    <label for="password" class="control-label">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
    <?php if (isset($password_error)): ?>
      <span class="help-block"><?= $password_error ?></span>
    <?php endif; ?>
  </div>
  <?php if (isset($login_error)): ?>
    <div class="form-group has-error">
      <span class="help-block"><?= $login_error ?></span>
    </div>
  <?php endif; ?>
  <div class="form-group">
    <button type="submit" class="btn btn-lg btn-success btn-block">Connexion</button>
  </div>
</form>
</div>
