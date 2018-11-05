<?
ini_set('xdebug.var_display_max_depth', 2);
ini_set('xdebug.var_display_max_data', 50);
ini_set('max_execution_time', 30000);
error_reporting(0);

$ods = array();
$idealArray = array();
$listMa = array('H2');
$listMaa = array_unique(array_column($dataSet, 'Molecule added atoms'));
$listMt = array_unique(array_column($dataSet, 'Multiplicity type'));
$listVdwc = array_unique(array_column($dataSet, 'VdW correction'));
#$listMaa = array(0, 1, 2, 3, 4, 5);
#$listMt = array('Alta', 'Baja');
#$listVdwc = array('Normal', 'VDW06', 'VDW10');

$i = 0;
foreach($listMa as $moleculeAdded) {
  foreach($listMaa as $moleculeAddedAtoms) {
    foreach($listMt as $multiplicityType) {
      foreach($listVdwc as $vdwCorrection) {
        $idealArray[$i]['Molecule name'] = $dataSet[0]['Molecule name'];
        $idealArray[$i]['Molecule added'] = $moleculeAdded;
        $idealArray[$i]['Molecule added atoms'] = $moleculeAddedAtoms;
        $idealArray[$i]['Multiplicity type'] = $multiplicityType;
        $idealArray[$i]['VdW correction'] = $vdwCorrection;
        $idealArray[$i]['Hurray'] = FALSE;
        $idealArray[$i]['Hurray error'] = TRUE;
        $idealArray[$i]['Input'] = FALSE;
        $i++;
      }
    }
  }
}


// ODS Magic
usort($dataSet, function($a, $b) {
  return $a['Molecule added atoms'] <=> $b['Molecule added atoms'];
});
usort($dataSet, function($a, $b) {
  return $a['Molecule added atoms'] <=> $b['Multiplicity type'];
});
usort($dataSet, function($a, $b) {
  return $a['Molecule added atoms'] <=> $b['VdW correction'];
});

for($i = 0; $i < count($idealArray); $i++) {
  foreach($dataSet as $uploadedArray) {
    if($idealArray[$i]['Molecule name'] == $uploadedArray['Molecule name'] && $idealArray[$i]['Molecule added atoms'] == $uploadedArray['Molecule added atoms'] && $idealArray[$i]['VdW correction'] == $uploadedArray['VdW correction'] && $idealArray[$i]['Multiplicity type'] == $uploadedArray['Multiplicity type']) {
      $idealArray[$i] = $uploadedArray;
    }
  }
}

for($i = 0, $j = 3; $i < count($idealArray)-3; $i++, $j++) {
  if($idealArray[$i]['Molecule name'] == $idealArray[$j]['Molecule name'] && $idealArray[$i]['Molecule added atoms'] == $idealArray[$j]['Molecule added atoms'] && $idealArray[$i]['VdW correction'] == $idealArray[$j]['VdW correction'] && $idealArray[$i]['Multiplicity type'] != $idealArray[$j]['Multiplicity type']) {
    if(!empty($idealArray[$i]['Total energy']['Eh'])) {
      if(!empty($idealArray[$j]['Total energy']['Eh'])) {
        if($idealArray[$i]['Total energy']['Eh'] < $idealArray[$j]['Total energy']['Eh']) {
          array_push($ods, $idealArray[$i]);
        } else {
          array_push($ods, $idealArray[$j]);
        }
      } else {
        array_push($ods, $idealArray[$i]);
      }
    } else {
      array_push($ods, $idealArray[$j]);
    }
  }
}

?>
<div class="col-12 py-2">
  <div class="d-none top-info mb-2">
    <h2 class="m-0 d-block d-md-inline-block">ODS</h2>
  </div>
  <div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col">VDW</th>
          <th scope="col">Input</th>
          <th scope="col">Geometría</th>
          <th scope="col">Homo-Alpha</th>
          <th scope="col">Lumo-Alpha</th>
          <th scope="col">Homo-Beta</th>
          <th scope="col">Lumo-Beta</th>
          <th scope="col">Homo</th>
          <th scope="col">Lumo</th>
          <th scope="col">Gap</th>
          <th scope="col">Energía</th>
          <th scope="col">VDW Corr?</th>
          <th scope="col">¿Frecuencias positivas?</th>
          <th scope="col">Carga</th>
          <th scope="col">Multiplicidad</th>
          <th scope="col">¿Mult?</th>
          <th scope="col">Ruta</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?= $ods[0]['Molecule added'] ?></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>-1.164924471</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <tr>
          <td>Normal</td>
          <td><?= $ods[0]['Molecule added'] ?>
          </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <? for($i = 0; $i < count($ods); $i++) {  ?>
          <tr class="<? tableClass($ods[$i]); ?>">
            <td><?= $ods[$i]['Molecule name'] ?></td>
            <td><?= $ods[$i]['Molecule added atoms'] ?></td>
            <td><?= tableVdwCorrection($ods[$i]['VdW correction']); ?></td>
            <td class="ofh"><?= $ods[$i]['Input'] ?></td>
            <td class="ofh"><? tableGeometry($ods[$i]); ?></td>
            <td><?= $ods[$i]['HOMO-LUMO']['HOMO alpha'] ?></td>
            <td><?= $ods[$i]['HOMO-LUMO']['LUMO alpha'] ?></td>
            <td><?= $ods[$i]['HOMO-LUMO']['HOMO beta'] ?></td>
            <td><?= $ods[$i]['HOMO-LUMO']['LUMO beta'] ?></td>
            <td><?= $ods[$i]['HOMO-LUMO']['HOMO'] ?></td>
            <td><?= $ods[$i]['HOMO-LUMO']['LUMO'] ?></td>
            <td><?= $ods[$i]['HOMO-LUMO']['Gap'] ?></td>
            <td><?= tableEnergy($ods[$i]); ?></td>
            <td><?= tableDispersionCorrection($ods[$i]['Dispersion correction']); ?></td>
            <td><?= tablePositiveVF($ods[$i]['Positive vibrational frequencies']); ?></td>
            <td><?= $ods[$i]['Charge'] ?></td>
            <td><?= $ods[$i]['Multiplicity'] ?></td>
            <td><?= $ods[$i]['Multiplicity type']; ?></td>
            <td class="ofh">/<?= $ods[$i]['Molecule name'] ?>/<?= $ods[$i]['Molecule name'] ?>/<?= $ods[$i]['Molecule added atoms'] . $ods[$i]['Molecule added'] ?>/<?= $ods[$i]['Multiplicity type'] ?>/<?= $ods[$i]['VdW correction'] ?></td>
          </tr>
        <? } ?>
        <tr>
          <td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <tr>
          <td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <tr>
          <td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>

        <!-- Gap -->
        <tr>
          <th scope="col">GAP</th>
          <th scope="col"></th>
          <th scope="col">S-VDW</th>
          <th scope="col">VDW06</th>
          <th scope="col">VDW10</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
        <? for($c = 0, $j = 0, $k = 3; $c < 6; $c++, $j += 3, $k += 3) { ?>
          <tr>
            <td><?= $ods[0]['Molecule name'] ?></td>
            <td><?= $c; ?></td>
            <? for($i = $j; $i < $k; $i++) {  ?>
              <td><?= tableGap($ods[$i]['HOMO-LUMO']['Gap']) ?></td>
            <? } ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        <? } ?>
        <tr>
          <td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <tr>
          <td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <tr>
          <td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>

        <!-- Binding energy  -->
        <tr>
          <th scope="col">Binding Energy</th>
          <th scope="col"></th>
          <th scope="col">S-VDW</th>
          <th scope="col">VDW06</th>
          <th scope="col">VDW10</th>
          <th scope="col">delta S-VDW</th>
          <th scope="col">delta VDW06</th>
          <th scope="col">delta VDW10</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
        <? for($c = 0, $j = 0, $k = 3; $c < 6; $c++, $j += 3, $k += 3) { ?>
          <tr>
            <td><?= $ods[0]['Molecule name'] ?></td>
            <td><?= $c; ?></td>
            <? for($i = $j; $i < $k; $i++) {  ?>
              <td><? if(!empty($ods[$i]['Final Single Point Energy']['Eh'])) { echo $ods[$i]['Final Single Point Energy']['Eh']; } elseif(!empty($ods[$i]['Total energy']['Eh'])) { echo $ods[$i]['Total energy']['Eh']; } else { echo 'N/A'; } ?></td>
            <? } ?>
            <? for($i = $j; $i < $k; $i++) {  ?>
              <td><? echo ($i > 2 ? tableDelta($ods, $i) : '---------------'); ?></td>
            <? } ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <? switch ($c) {
              case 2:
                echo "<td class=\"table-dark text-center\">{$lang['caption']}</td>";
              break;
              case 3:
                echo "<td class=\"table-danger\">{$lang['no_convergence']}</td>";
              break;
              case 4:
                echo "<td class=\"table-warning\">{$lang['scf_convergence']}</td>";
              break;
              case 5:
                echo "<td class=\"table-nvf\">{$lang['imaginary_frequencies']}</td>";
              break;
              default:
                echo "<td></td>";
              break;
            } ?>
          </tr>
        <? } ?>
      </tbody>
    </table>
  </div>
  <h4><?= $lang['graphs']; ?></h4>

  <div class="row">
    <div class="d-none col-12 col-lg-6 col-xl-4">
      <canvas id="chart" class="mb-4" width="400" height="300" data-aos="zoom-out" data-aos-delay="500"></canvas>
    </div>
    <div class="col-12 col-lg-6 col-xl-4">
      <canvas id="chart-be" class="mb-4" width="400" height="300" data-aos="zoom-out" data-aos-delay="500"></canvas>
    </div>
    <div class="col-12 col-lg-6 col-xl-4">
      <canvas id="chart-gap" class="mb-4" width="400" height="300" data-aos="zoom-out" data-aos-delay="500"></canvas>
    </div>
  </div>

  <script>
    var titleFontSize = 26, fontSize = 22, pointRadius = 6, pointHoverRadius = 12, lineTension = 0, fill = false;
    var ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
        data: {
          labels: [<? for($i = 0; $i < 6; $i++) { echo $i; if($i < $k) echo ', '; } ?>],
          datasets: [
          <? for($c = 0, $j = 0, $k = 16; $c < 3; $c++, $j++, $k++) { ?>
            {
              <? switch ($c) {
                case 0:
                  echo "label: 'E Normal', ";
                  echo "backgroundColor: 'rgba(55, 150, 250, 1)', ";
                  echo "borderColor: 'rgba(55, 150, 250, 1)', ";
                  echo "pointStyle: 'rectRot', ";
                break;
                case 1:
                  echo "label: 'E VDW06', ";
                  echo "backgroundColor: 'rgba(250, 100, 10, 1)', ";
                  echo "borderColor: 'rgba(250, 100, 10, 1)', ";
                  echo "pointStyle: 'rect', ";
                break;
                case 2:
                  echo "label: 'E VDW10', ";
                  echo "backgroundColor: 'rgba(70, 70, 70, 1)', ";
                  echo "borderColor: 'rgba(70, 70, 70, 1)', ";
                  echo "pointStyle: 'triangle', ";
                break;
              } ?>
              pointRadius: pointRadius,
              pointHoverRadius: pointHoverRadius,
              lineTension: lineTension,
              fill: fill,
              data: [<? for($i = $j; $i < $k; $i+=3) { echo chartGap($ods[$i]['Final Single Point Energy']['Eh']); if($i < $k) echo ', '; } ?>]
            },
          <? } ?>
        ]},
        options: {
          responsive: true,
          title: {
            display: true,
            fontSize: titleFontSize,
            text: 'Energies for <?= $ods[0]['Molecule name']; ?>'
          },
          tooltips: {
            mode: 'index',
            intersect: false,
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                fontSize: fontSize,
                fontStyle: 'bold',
                labelString: 'Number of H\u2082'
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                fontSize: fontSize,
                fontStyle: 'bold',
                labelString: 'Binding energy (Eh)'
              }
            }]
          }
        }
      }
    );

    var ctx = document.getElementById('chart-be').getContext('2d');

    new Chart(ctx, {
      type: 'line',
        data: {
          labels: [<? for($i = 1; $i <= 5; $i++) { echo $i; if($i < $k) echo ', '; } ?>],
          datasets: [
          <? for($c = 0, $j = 0, $k = 16; $c < 3; $c++, $j++, $k++) { ?>
            {
              <? switch ($c) {
                case 0:
                  echo "label: 'delta Normal', ";
                  echo "backgroundColor: 'rgba(55, 150, 250, 1)', ";
                  echo "borderColor: 'rgba(55, 150, 250, 1)', ";
                  echo "pointStyle: 'rectRot', ";
                break;
                case 1:
                  echo "label: 'delta VDW06', ";
                  echo "backgroundColor: 'rgba(250, 100, 10, 1)', ";
                  echo "borderColor: 'rgba(250, 100, 10, 1)', ";
                  echo "pointStyle: 'rect', ";
                break;
                case 2:
                  echo "label: 'delta VDW10', ";
                  echo "backgroundColor: 'rgba(70, 70, 70, 1)', ";
                  echo "borderColor: 'rgba(70, 70, 70, 1)', ";
                  echo "pointStyle: 'triangle', ";
                break;
              } ?>
              pointRadius: pointRadius,
              pointHoverRadius: pointHoverRadius,
              lineTension: lineTension,
              fill: fill,
              data: [<? for($i = $j+3; $i < $k; $i+=3) { echo tableDelta($ods, $i); if($i < $k) echo ', '; } ?>]
            },
          <? } ?>
        ]},
        options: {
          responsive: true,
          title: {
            display: true,
            fontSize: titleFontSize,
            text: 'Binding energies for <?= $ods[0]['Molecule name']; ?>'
          },
          tooltips: {
            mode: 'index',
            intersect: false,
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                fontSize: fontSize,
                fontStyle: 'bold',
                labelString: 'Number of H\u2082'
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                fontSize: fontSize,
                fontStyle: 'bold',
                labelString: 'Binding energy (Eh)'
              }
            }]
          }
        }
      }
    );

    var ctx = document.getElementById('chart-gap').getContext('2d');
    new Chart(ctx, {
      type: 'line',
        data: {
          labels: [<? for($i = 0; $i < 6; $i++) { echo $i; if($i < $k) echo ', '; } ?>],
          datasets: [
          <? for($c = 0, $j = 0, $k = 16; $c < 3; $c++, $j++, $k++) { ?>
            {
              <? switch ($c) {
                case 0:
                  echo "label: 'HL-GAP', ";
                  echo "backgroundColor: 'rgba(55, 150, 250, 1)', ";
                  echo "borderColor: 'rgba(55, 150, 250, 1)', ";
                  echo "pointStyle: 'rectRot', ";
                break;
                case 1:
                  echo "label: 'HL-GAP VDW06', ";
                  echo "backgroundColor: 'rgba(250, 100, 10, 1)', ";
                  echo "borderColor: 'rgba(250, 100, 10, 1)', ";
                  echo "pointStyle: 'rect', ";
                break;
                case 2:
                  echo "label: 'HL-GAP VDW10', ";
                  echo "backgroundColor: 'rgba(70, 70, 70, 1)', ";
                  echo "borderColor: 'rgba(70, 70, 70, 1)', ";
                  echo "pointStyle: 'triangle', ";
                break;
              } ?>
              pointRadius: pointRadius,
              pointHoverRadius: pointHoverRadius,
              lineTension: lineTension,
              fill: fill,
              data: [<? for($i = $j; $i < $k; $i+=3) { echo chartGap($ods[$i]['HOMO-LUMO']['Gap']); if($i < $k) echo ', '; } ?>]
            },
          <? } ?>
        ]},
        options: {
          responsive: true,
          title: {
            display: true,
            fontSize: titleFontSize,
            text: 'Homo-Lumo Gap for <?= $ods[0]['Molecule name']; ?>'
          },
          tooltips: {
            mode: 'index',
            intersect: false,
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                fontSize: fontSize,
                fontStyle: 'bold',
                labelString: 'Number of H\u2082'
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                fontSize: fontSize,
                fontStyle: 'bold',
                labelString: 'Homo Lumo Gap (eV)'
              }
            }]
          }
        }
      }
    );
  </script>
</div>
