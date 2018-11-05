<? // REDUNDANT INTERNAL COORDINATES ?>
<? #  include(ROOT . '/tpl/out-reader/geometry-ric.php'); ?>
<? if(!empty($dataSet[$i]['Geometry'])) { ?>
  <h4><?= $lang['geometry'] ?></h4>
  <ul class="nav nav-tabs nav-fill" id="geometry" role="tablist" data-aos="fade-in">
    <li class="nav-item">
      <a class="nav-item nav-link active" id="g-f-tab-<?= $i ?>" data-toggle="tab" href="#g-f-<?= $i ?>" role="tab" aria-controls="g-f-<?= $i ?>" aria-selected="true"><?= $lang['final'] ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-item nav-link" id="g-i-tab-<?= $i ?>" data-toggle="tab" href="#g-i-<?= $i ?>" role="tab" aria-controls="g-i-<?= $i ?>" aria-selected="false"><?= $lang['initial'] ?></a>
    </li>
  </ul>

  <div class="tab-content tab-content-border text-center" id="geometry-tab-content-<?= $i ?>" data-aos="fade-in">
    <div class="tab-pane fade show active" id="g-f-<?= $i ?>" role="tabpanel" aria-labelledby="g-f-tab-<?= $i ?>">
      <? include(ROOT . '/tpl/out-reader/geometry.final.php') ?>
    </div>
    <div class="tab-pane fade" id="g-i-<?= $i ?>" role="tabpanel" aria-labelledby="g-i-tab-<?= $i ?>">
      <? include(ROOT . '/tpl/out-reader/geometry.initial.php') ?>
    </div>
  </div>
<? } ?>
