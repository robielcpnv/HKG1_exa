<div class="row">
  <div class="col-md-6">
    <h1><?= $offer->available_on ?></h1>
    <div class="stars">
      <span id="stars"><?= \App\Star::getTotalCountForOffer($offer->id) ?> ★</span>
      <?php if (Flight::get('current_user')): ?>
        <div class="rating">
          <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
          <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
          <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
          <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
          <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
        </div>
      <?php endif; ?>
    </div>
    <div class="panel panel-default">
      <div class="panel-body infos">
        <span><span class="glyphicon glyphicon-map-marker"></span> <?= htmlspecialchars($offer->address) ?></span>
        <span class="pull-right"><span class="glyphicon glyphicon-user"></span> <a href="/user/<?= $offer->author_id ?>/offer"><?= $offer->author()->username ?></a></span>
      </div>
    </div>
    <p class="description lead bg-info alert"><?= nl2br(htmlspecialchars($offer->description)) ?></p>
  </div>
  <div class="col-md-6">
    <h2>Contacter l'auteur</h2>
    <form class="" action="" method="POST">
      <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
      <div class="form-group">
        <textarea class="form-control" rows="8" placeholder="Votre message" name="msg"></textarea>
      </div>
      <input type="hidden" name="id" value="<?= $offer->id ?>">
      <p>N'oubliez pas d'indiquer vos coordonnées dans le message</p>
      <button type="submit" class="btn btn-default btn-primary" disabled>Envoyer</button>
    </form>
  </div>
</div>
<div class="row">
  <?php foreach ($offer->images() as $image): ?>
    <a href="<?= $image ?>" data-toggle="lightbox" data-gallery="offer-gallery" class="col-md-2 col-sm-3 col-xs-4">
      <img class="img-responsive img-thumbnail" src="<?= $image ?>" />
    </a>
  <?php endforeach; ?>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var values = [<?= join(",", \App\Star::getCountsForOffer($offer->id)) ?>];
        var stars = "";
        for (var i=0; i<values.length; i++) {
            for (var j=0; j<values[i]; j++) {
                stars += "★";
            }
            stars += "<br>";
        }
        $('#stars').popover({html: true, content: stars, placement: 'bottom'});
        
        $('.rating input').change(function () {
            $.post("/offer/<?= $offer->id ?>/star/" + $(this).val());
        });
    }, false);
</script>
