<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= $url ?>">
<input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
  <div class="form-group <?= isset($available_on_error) ? 'has-error' : '' ?>">
    <label for="available_on" class="col-sm-2 control-label">Disponible dès le </label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="available_on" name="available_on" placeholder="" value="<?= $offer->available_on ?>">
      <?php if (isset($available_on_error)): ?>
        <span class="help-block"><?= $available_on_error ?></span>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group <?= isset($address_error) ? 'has-error' : '' ?>">
    <label for="address" class="col-sm-2 control-label">Localisation</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="address" name="address" placeholder="Adresse du bien" value='<?= htmlspecialchars($offer->address) ?>'>
      <?php if (isset($address_error)): ?>
        <span class="help-block"><?= $address_error ?></span>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group <?= isset($description_error) ? 'has-error' : '' ?>">
    <label for="description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($offer->description) ?></textarea>
      <?php if (isset($description_error)): ?>
        <span class="help-block"><?= $description_error ?></span>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group <?= isset($images_error) ? 'has-error' : '' ?>">
    <label for="images" class="col-sm-2 control-label">Ajout de photos</label>
    <div class="col-sm-10">
      <input type="file" id="images" name="images[]" multiple="multiple">
      <?php if (isset($images_error)): ?>
        <span class="help-block"><?= $images_error ?></span>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default btn-primary"><?= $submit_caption ?></button>
    </div>
  </div>
</form>
