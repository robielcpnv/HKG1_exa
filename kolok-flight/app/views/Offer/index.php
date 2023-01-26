<div class="row">
  <div class="col-md-12">
    <h1>Propositions actuelles</h1>
    <div class="row">
    <?php foreach ($offers as $offer): ?>
      <div class="col-md-3 col-sm-4 col-xs-6">
        <div class="thumbnail offer-item">
          <a href="/offer/<?= $offer->id ?>"><img class="img-responsive" src="<?= $offer->images()[0] ?>" /></a>
          <div class="caption text-center">
            <h3>Dès le <span class="available_date"><?= $offer->available_on ?></span></h3>
            <p><span class="user"><span class="glyphicon glyphicon-user"></span> <a href="/user/<?= $offer->author_id ?>/offer"><?= $offer->author()->username ?></a></span></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
</div>
