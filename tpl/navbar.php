<nav class="px-4 navbar navbar-expand-md navbar-dark bg-dark">
  <a href="index.php" class="masthead-brand mx-2">
    <img src="<?=$settings['url'];?>assets/img/logo-w-35.png" <? if(isset($header['mini_logo']) && $header['mini_logo'] == TRUE) { echo 'height="25px"'; } ?>>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <? include(ROOT . '/tpl/navbar-menu.php'); ?>
    </div>
  </div>
</nav>
