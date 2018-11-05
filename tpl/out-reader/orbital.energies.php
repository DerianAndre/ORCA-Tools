<? if(!empty($dataSet[$i]['Orbital energies'])) { ?>
<div id="orbital-energies-<?= $i ?>" class="orbital-energies">
  <h4><?= $lang['orbital_energies'] ?></h4>
  <canvas id="chart-oe-<?= $i ?>" class="mb-4" width="400" height="300" data-aos="zoom-out" data-aos-delay="500"></canvas>
  <? $c = count($dataSet[$i]['Orbital energies'])-1; if($dataSet[$i]['Orbital energies']['Spin'] == FALSE) { ?>
    <div class="table-max-height" data-aos="fade-right">
      <table class="m-0 table table-oe table-sm table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">OCC</th>
            <th scope="col"><?= $lang['energy'] ?> (Eh)</th>
            <th scope="col"><?= $lang['energy'] ?> (eV)</th>
          </tr>
        </thead>
        <? for($j = 0; $j < $c; $j++) { ?>
          <tr>
            <th scope="row"><?= $dataSet[$i]['Orbital energies'][$j]['#'] ?></th>
            <td><?= $dataSet[$i]['Orbital energies'][$j]['OCC'] ?></td>
            <td><?= $dataSet[$i]['Orbital energies'][$j]['Energy (Eh)'] ?></td>
            <td><?= $dataSet[$i]['Orbital energies'][$j]['Energy (eV)'] ?></td>
          </tr>
        <? } ?>
      </table>
    </div>
  <? } else { ?>
    <div data-aos="fade-right">
      <ul class="nav nav-tabs nav-fill" id="orbital-energies" role="tablist">
        <li class="nav-item">
          <a class="nav-item nav-link active" id="oe-up-tab-<?= $i ?>" data-toggle="tab" href="#oe-up-<?= $i ?>" role="tab" aria-controls="oe-up-<?= $i ?>" aria-selected="true">Spin Up</a>
        </li>
        <li class="nav-item">
          <a class="nav-item nav-link" id="oe-down-tab-<?= $i ?>" data-toggle="tab" href="#oe-down-<?= $i ?>" role="tab" aria-controls="oe-down-<?= $i ?>" aria-selected="false">Spin Down</a>
        </li>
      </ul>

      <div class="tab-content tab-content-border text-center" id="orbital-energies-tab-content-<?= $i ?>">
        <div class="tab-pane fade show active" id="oe-up-<?= $i ?>" role="tabpanel" aria-labelledby="oe-up-tab-<?= $i ?>">
          <div class="table-max-height">
            <table class="m-0 table table-oe table-sm table-hover">
              <thead>
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">OCC</th>
                    <th scope="col"><?= $lang['energy'] ?> (Eh)</th>
                    <th scope="col"><?= $lang['energy'] ?> (eV)</th>
                  </tr>
                </thead>
              <? for($j = 0; $j < $c/2; $j++) { ?>
                <tr>
                  <th scope="row"><?= $dataSet[$i]['Orbital energies'][$j]['#'] ?></th>
                  <td><?= $dataSet[$i]['Orbital energies'][$j]['OCC'] ?></td>
                  <td><?= $dataSet[$i]['Orbital energies'][$j]['Energy (Eh)'] ?></td>
                  <td><?= $dataSet[$i]['Orbital energies'][$j]['Energy (eV)'] ?></td>
                </tr>
              <? } ?>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="oe-down-<?= $i ?>" role="tabpanel" aria-labelledby="oe-down-tab-<?= $i ?>">
          <div class="m-0 table-max-height">
            <table class="table table-oe table-sm table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">OCC</th>
                  <th scope="col"><?= $lang['energy'] ?> (Eh)</th>
                  <th scope="col"><?= $lang['energy'] ?> (eV)</th>
                </tr>
              </thead>
              <? for($j = $c/2; $j < $c; $j++) { ?>
                <tr>
                  <th scope="row"><?= $dataSet[$i]['Orbital energies'][$j]['#'] ?></th>
                  <td><?= $dataSet[$i]['Orbital energies'][$j]['OCC'] ?></td>
                  <td><?= $dataSet[$i]['Orbital energies'][$j]['Energy (Eh)'] ?></td>
                  <td><?= $dataSet[$i]['Orbital energies'][$j]['Energy (eV)'] ?></td>
                </tr>
              <? } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  <? } ?>
</div>
<? } ?>
