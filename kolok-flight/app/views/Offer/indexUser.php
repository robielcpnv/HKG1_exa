<?php
  $current_user = Flight::get('current_user');
  $is_owner = $current_user && ($user->id == $current_user->id);
?>
<div class="row">
  <div class="col-md-12">
    <h1>Propositions de <?= htmlspecialchars($user->name) ?></h1>
    <div class="row">
    <?php foreach ($offers as $offer): ?>
      <div class="col-md-3 col-sm-4 col-xs-6">
        <div class="thumbnail offer-item">
          <a href="<?= $is_owner ? "/offer/{$offer->id}/update" : "/offer/{$offer->id}" ?>"><img class="img-responsive" src="<?= $offer->images()[0] ?>" /></a>
          <div class="caption text-center">
            <h3>Dès le <span class="available_date"><?= $offer->available_on ?></span></h3>
            <?php if ($is_owner): ?>
              <form action="/offer/<?= $offer->id ?>/destroy" method="POST">
              <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
              <button type="submit" class="btn btn-danger">Supprimer</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
</div>
