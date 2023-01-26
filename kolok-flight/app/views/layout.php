<!DOCTYPE html>
<?php $current_user = Flight::get('current_user'); ?>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
    if (isset($meta)) {
      foreach ($meta as $name => $content) {
        echo "<meta name='$name' content='$content'>\n";
      }
    }
  ?>
  <title><?= isset($title) ? $title : '' ?></title>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/custom.css" rel="stylesheet">
  <link href="/css/ekko-lightbox.min.css" rel="stylesheet">
</head>
<body>
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><img alt="Kolok" src="/images/logo.png"></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="/offer"><span class="glyphicon glyphicon-list"></span> Toutes les propositions</a></li>
          <?php if ($current_user): ?>
            <li><a href="/user/<?= $current_user->id ?>/offer"><span class="glyphicon glyphicon-star"></span> Mes propositions</a></li>
            <li><a href="/offer/create"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter une proposition</a></li>
          <?php endif; ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php if ($current_user): ?>
            <li><div class="navbar-text"><span class="glyphicon glyphicon-user"></span> <?= htmlspecialchars($current_user->name) ?></div></li>
            <form method="post" action="/logout">
              <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
              <li><button type="submit" formaction="/logout" class="btn"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</button></li>
            </form>
          <?php else: ?>
            <li><a href="/register" class="btn"><span class="glyphicon glyphicon-user"></span> S'enregistrer</a></li>
            <li><a href="/login" class="btn"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
          <?php endif; ?>
        </ul>
      </div><!--/.navbar-collapse -->
    </div>
  </div>
  
  <div class="container">
    <div id="content">
      <?= $action_content ?>
    </div><!-- content -->
  </div>
  
  <!-- Bootstrap core JavaScript -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/ekko-lightbox.min.js"></script>
  <script>
    $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox();
      });
    });
  </script>
</body>
</html>
