<h5 class="table-title"><?= $lang['general_data'] ?></h5>
<div class="table-responsive mb-2">
  <table class="mb-0 table table-sm th-50">
    <tbody>
      <tr>
        <th scope="row"><?= $lang['orca_version']; ?></th>
        <td><?= $dataSet[$i]['ORCA Version'] ?></td>
      </tr>
      <? if(!empty($dataSet[$i]['Total run time'])) { ?>
        <tr>
          <th scope="row"><?= $lang['total_run_time']; ?></th>
          <td><?= runTimeReadable($dataSet[$i]['Total run time']); ?></td>
        </tr>
      <? } ?>
      <? if(!empty($dataSet[$i]['Total energy']['Eh'])) { ?>
        <tr>
          <th scope="row" rowspan="2" style="vertical-align: middle;"><?= $lang['total_energy'] ?> (E<sub>T</sub>)</th>
          <td><?= $dataSet[$i]['Total energy']['Eh'] ?> Eh</td>
        </tr>
      <? } ?>
      <? if(!empty($dataSet[$i]['Total energy']['eV'])) { ?>
        <tr>
          <td><?= $dataSet[$i]['Total energy']['eV'] ?> eV</td>
        </tr>
      <? } ?>
      <? if(!empty($dataSet[$i]['Final Single Point Energy']['Eh']) ) { ?>
        <tr>
          <th scope="row" rowspan="2" style="vertical-align: middle;"><?= $lang['final_single_point_energy'] ?></th>
          <td><?= $dataSet[$i]['Final Single Point Energy']['Eh'] ?> Eh</td>
        </tr>
      <? } ?>
      <? if(!empty($dataSet[$i]['Final Single Point Energy']['eV'])) { ?>
        <tr>
          <td><?= $dataSet[$i]['Final Single Point Energy']['eV'] ?> eV</td>
        </tr>
      <? } ?>
      <? if(!empty($dataSet[$i]['Dispersion correction'])) { ?>
        <tr>
          <th scope="row" rowspan="2" style="vertical-align: middle;"><?= $lang['dispersion_correction'] ?></th>
          <td><?= $dataSet[$i]['VdW correction'] ?></td>
        </tr>
        <tr>
          <td><?= $dataSet[$i]['Dispersion correction'] ?></td>
        </tr>
      <? } ?>
      <? if(isset($dataSet[$i]['Charge'])) { ?>
        <tr>
          <th scope="row"><?= $lang['charge'] ?></th>
          <td><?= $dataSet[$i]['Charge'] ?></td>
        </tr>
      <? } ?>
      <? if(!empty($dataSet[$i]['Multiplicity'])) { ?>
        <tr>
          <th scope="row"><?= $lang['multiplicity'] ?></th>
          <td><?= $dataSet[$i]['Multiplicity'] ?></td>
        </tr>
      <? } ?>
      <? if(!empty($dataSet[$i]['Number of atoms'])) { ?>
        <tr>
          <th scope="row"><?= $lang['number_of_atoms'] ?></th>
          <td><?= $dataSet[$i]['Number of atoms'] ?></td>
        </tr>
      <? } ?>
      <? if(!empty($dataSet[$i]['Number of degrees of freedom'])) { ?>
        <tr>
          <th scope="row"><?= $lang['number_of_degrees_of_freedom'] ?></th>
          <td><?= $dataSet[$i]['Number of degrees of freedom'] ?></td>
        </tr>
      <? } ?>
    </tbody>
  </table>
</div>
