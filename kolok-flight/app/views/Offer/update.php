<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <h1>Modifier la proposition</h1>
    <?php $submit_caption = "Modifier"; $url = "/offer/{$offer->id}/update"; include(__DIR__ . "/_form.php"); ?>
    
    <h2>Photos</h2>
    <?php foreach ($offer->images() as $image): ?>
      <div class="col-md-2 col-sm-3 col-xs-4">
        <div class="thumbnail image-item">
          <img class="img-responsive" src="<?= $image ?>" />
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
