<? if(!empty($dataSet[$i]['Vibrational frequencies'])) { ?>
<div id="vibrational-frequencies-<?= $i ?>" class="vibrational-frequencies">
  <h4><?= $lang['vibrational_frequencies'] ?></h4>
  <canvas id="chart-vf-<?= $i ?>" class="mb-4" width="400" height="200" data-aos="zoom-out" data-aos-delay="500"></canvas>
  <div class="table-max-height">
    <table class="m-0 table table-vq table-sm table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"><?= $lang['frequency'] ?> (cm<sup>-1</sup>)</th>
        </tr>
      </thead>
      <? for($j = 0; $j < count($dataSet[$i]['Vibrational frequencies']); $j++) { ?>
        <? if($dataSet[$i]['Vibrational frequencies'][$j] < 0) $class = ' class="bg-danger text-white"'; else $class = false; ?>
        <tr<?= $class; ?>>
          <th scope="row"><?= $j ?></th>
          <td><?= $dataSet[$i]['Vibrational frequencies'][$j] ?></td>
        </tr>
      <? } ?>
    </table>
  </div>
</div>
<? } ?>
