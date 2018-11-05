<? if(!empty($dataSet[$i]['ORCA Information']) || !empty($dataSet[$i]['ORCA Warnings'])) { ?>
  <div id="warnings-info-<?= $i ?>">
    <? if(!empty($dataSet[$i]['ORCA Information'])) { ?>
      <h4><?= $lang['information'] ?></h4>
      <pre id="info-<?= $i ?>" class="mb-0 p-3 bg-info text-white" data-aos="fade-in">INFO: <?= $dataSet[$i]['ORCA Information'] ?></pre>
    <? } ?>
    <? if(!empty($dataSet[$i]['ORCA Warnings'])) { ?>
      <h4><?= $lang['warnings'] ?></h4>
      <pre id="warnings-<?= $i ?>" class="mb-0 p-3 bg-warning text-dark" data-aos="fade-in"><?= $dataSet[$i]['ORCA Warnings']; ?></pre>
    <? } ?>
  </div>
<? } ?>
