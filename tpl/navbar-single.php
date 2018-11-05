<a href="index.php" class="masthead-brand">
  <img src="<?=$settings['url'];?>assets/img/logo-w-35.png" <? if(isset($header['mini_logo']) && $header['mini_logo'] == TRUE) { echo 'class="mx-3" height="25px"'; } ?>>
</a>
<nav class="nav <? if(isset($header['single']) == TRUE) echo 'nav-masthead'; ?> justify-content-center">
  <? include(ROOT . '/tpl/navbar-menu.php'); ?>
</nav>
