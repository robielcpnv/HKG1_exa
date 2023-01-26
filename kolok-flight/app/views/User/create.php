<div class="col-md-4 col-md-offset-4">
<form class="form-horizontal" role="form" method="post">
  <h1 class="text-center">Enregistrement</h1>
  <div class="form-group <?php echo isset($username_error) ? 'has-error' : '' ?>">
    <label for="username" class="control-label">Identifiant</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Identifiant" value='<?= isset($username) ? htmlspecialchars($username, ENT_COMPAT) : '' ?>'>
    <?php if (isset($username_error)): ?>
      <span class="help-block"><?= $username_error ?></span>
    <?php endif; ?>
  </div>
  <div class="form-group <?php echo isset($name_error) ? 'has-error' : '' ?>">
    <label for="username" class="control-label">Nom complet</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Nom complet" value='<?= isset($name) ? htmlspecialchars($name, ENT_COMPAT) : '' ?>'>
    <?php if (isset($name_error)): ?>
      <span class="help-block"><?= $name_error ?></span>
    <?php endif; ?>
  </div>
  <div class="form-group <?php echo isset($email_error) ? 'has-error' : '' ?>">
    <label for="email" class="control-label">Email</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value='<?= isset($email) ? htmlspecialchars($email, ENT_COMPAT) : '' ?>'>
    <?php if (isset($email_error)): ?>
      <span class="help-block"><?= $email_error ?></span>
    <?php endif; ?>
  </div>
  <div class="form-group <?php echo isset($password_error) ? 'has-error' : '' ?>">
    <label for="password" class="control-label">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
    <?php if (isset($password_error)): ?>
      <span class="help-block"><?= $password_error ?></span>
    <?php endif; ?>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-lg btn-success btn-block">Enregistrement</button>
  </div>
</form>
</div>
