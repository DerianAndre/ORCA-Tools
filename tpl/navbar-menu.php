<?
$items = array(
  'index',
  'ods',
  'xyz'
);

foreach($items as $item) { ?>
  <a class="nav-link <? if($header['page'] == $item) echo 'active'; ?>" href="<?= $item; ?>.php"><?= $lang['page_' . $item]; ?></a>
<? } ?>
