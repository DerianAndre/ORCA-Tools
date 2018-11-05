<? if(!empty($dataSet[$i]['HOMO-LUMO'])) { ?>
  <h5 class="table-title">HOMO & LUMO</h5>
  <table class="mb-4 table table-sm th-50">
    <thead>
      <tr>
        <th scope="col"><?= $lang['orbital'] ?></th>
        <th scope="col"><?= $lang['energy'] ?> (eV)</th>
      </tr>
    </thead>
  <? foreach ($dataSet[$i]['HOMO-LUMO'] as $data => $value) { ?>
    <tr>
      <th scope="row"><?= $data ?></th>
      <td><?= $value ?></td>
    </tr>
  <? } ?>
  </table>
<? } ?>
