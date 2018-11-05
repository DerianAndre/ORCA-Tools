<?
$atoms[$i] = array_unique(array_column($dataSet[$i]['Geometry']['Initial']['Cartesian']['Angstroem'], 'Element'));
$atoms[$i] = array_intersect_key($dataSet[$i]['Geometry']['Initial']['Cartesian']['Angstroem'], $atoms[$i]);

if($dataSet[$i]['Hurray error'] == FALSE) { ?>
  <!-- 3D Model  -->
  <h4><?= $lang['3D_model'] ?></h4>
  <div id="molvwr" class="molvwr molvwr-model-<?= $i ?> mb-3 mol mol-left" data-aos="zoom-out" data-aos-delay="500" data-molvwr="<?= tempXYZ($i, $dataSet[$i]); ?>" data-molvwr-format="xyz" data-molvwr-view="">
    <div class="atoms-legend d-flex flex-column align-items-center">
      <a class="m-4 btn btn-dark" data-toggle="collapse" href="#legend" role="button" aria-expanded="false" aria-controls="collapseExample">Leyenda</a>
      <div class="collapse show" id="legend">
        <div>
          <? foreach($atoms[$i] as $atom) {   ?>
            <div class="atom atom-<?= $atom['Element'] ?>"><?= $atom['Element'] ?></div>
          <? } ?>
        </div>
      </div>
    </div>
  </div>
<? } ?>
