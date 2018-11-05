<div class="nav-geometry nav nav-pills nav-fill m-3 justify-content-center" id="g-i-<?= $i ?>" role="tablist">
  <a class="nav-item nav-link active" id="g-i-cc-ag-tab-<?= $i ?>" data-toggle="pill" href="#g-i-cc-ag-<?= $i ?>" role="tab" aria-controls="g-i-cc-ag-<?= $i ?>" aria-selected="true">
    <?= $lang['cartesian_coordinates_angstroem'] ?>
  </a>
  <a class="nav-item nav-link" id="g-i-cc-au-tab-<?= $i ?>" data-toggle="pill" href="#g-i-cc-au-<?= $i ?>" role="tab" aria-controls="g-i-cc-au-<?= $i ?>" aria-selected="false">
    <?= $lang['cartesian_coordinates_au'] ?>
  </a>
  <a class="nav-item nav-link" id="g-i-ic-ag-tab-<?= $i ?>" data-toggle="pill" href="#g-i-ic-ag-<?= $i ?>" role="tab" aria-controls="g-i-ic-ag-<?= $i ?>" aria-selected="false">
    <?= $lang['cartesian_coordinates_internal_angstroem'] ?>
  </a>
  <a class="nav-item nav-link" id="g-i-ic-au-tab-<?= $i ?>" data-toggle="pill" href="#g-i-ic-au-<?= $i ?>" role="tab" aria-controls="g-i-ic-au-<?= $i ?>" aria-selected="false">
    <?= $lang['cartesian_coordinates_internal_au'] ?>
  </a>
</div>
<div class="tab-content" id="g-i-tab-content">
  <div class="tab-pane fade show active" id="g-i-cc-ag-<?= $i ?>" role="tabpanel" aria-labelledby="g-i-cc-ag-tab-<?= $i ?>">
    <div class="table-max-height">
      <table class="m-0 table table-oe table-sm table-hover">
        <thead>
          <tr>
            <th scope="col"><?= $lang['element'] ?></th>
            <th scope="col">x</th>
            <th scope="col">y</th>
            <th scope="col">z</th>
          </tr>
        </thead>
        <tbody>
          <? for($j = 0; $j < count($dataSet[$i]['Geometry']['Initial']['Cartesian']['Angstroem']); $j++) { ?>
            <tr>
              <th scope="row"><?=$dataSet[$i]['Geometry']['Initial']['Cartesian']['Angstroem'][$j]['Element'] ?></th>
              <td><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['Angstroem'][$j]['x'] ?></td>
              <td><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['Angstroem'][$j]['y'] ?></td>
              <td><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['Angstroem'][$j]['z'] ?></td>
            </tr>
          <? } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="tab-pane fade" id="g-i-cc-au-<?= $i ?>" role="tabpanel" aria-labelledby="g-i-cc-au-tab-<?= $i ?>">
    <div class="table-max-height">
      <table class="m-0 table table-oe table-sm table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">LB</th>
            <th scope="col">ZA</th>
            <th scope="col">FRAG</th>
            <th scope="col"><?= $lang['mass'] ?></th>
            <th scope="col">x</th>
            <th scope="col">y</th>
            <th scope="col">z</th>
          </tr>
        </thead>
        <tbody>
          <? for($j = 0; $j < count($dataSet[$i]['Geometry']['Initial']['Cartesian']['A.U.']); $j++) { ?>
            <tr>
              <th scope="row"><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['A.U.'][$j]['#'] ?></th>
              <td><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['A.U.'][$j]['LB'] ?></td>
              <td><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['A.U.'][$j]['ZA'] ?></td>
              <td><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['A.U.'][$j]['Frag'] ?></td>
              <td><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['A.U.'][$j]['Mass'] ?></td>
              <td><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['A.U.'][$j]['x'] ?></td>
              <td><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['A.U.'][$j]['y'] ?></td>
              <td><?= $dataSet[$i]['Geometry']['Initial']['Cartesian']['A.U.'][$j]['z'] ?></td>
            </tr>
          <? } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="tab-pane fade" id="g-i-ic-ag-<?= $i ?>" role="tabpanel" aria-labelledby="g-i-ic-ag-tab-<?= $i ?>">
    <table class="m-0 table table-oe table-sm table-hover">
      <thead>
        <tr>
          <th scope="col"><?= $lang['element'] ?></th>
          <th scope="col">i</th>
          <th scope="col">j</th>
          <th scope="col">k</th>
          <th scope="col">x</th>
          <th scope="col">y</th>
          <th scope="col">z</th>
        </tr>
      </thead>
      <tbody>
        <? for($j = 0; $j < count($dataSet[$i]['Geometry']['Initial']['Internal']['Angstroem']); $j++) { ?>
          <tr>
            <th scope="row"><?= $dataSet[$i]['Geometry']['Initial']['Internal']['Angstroem'][$j]['Element'] ?></th>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['Angstroem'][$j]['i'] ?></td>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['Angstroem'][$j]['j'] ?></td>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['Angstroem'][$j]['k'] ?></td>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['Angstroem'][$j]['x'] ?></td>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['Angstroem'][$j]['y'] ?></td>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['Angstroem'][$j]['z'] ?></td>
          </tr>
        <? } ?>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="g-i-ic-au-<?= $i ?>" role="tabpanel" aria-labelledby="g-i-ic-au-tab-<?= $i ?>">
    <table class="m-0 table table-oe table-sm table-hover">
      <thead>
        <tr>
          <th scope="col"><?= $lang['element'] ?></th>
          <th scope="col">i</th>
          <th scope="col">j</th>
          <th scope="col">k</th>
          <th scope="col">x</th>
          <th scope="col">y</th>
          <th scope="col">z</th>
        </tr>
      </thead>
      <tbody>
        <? for($j = 0; $j < count($dataSet[$i]['Geometry']['Initial']['Internal']['A.U.']); $j++) { ?>
          <tr>
            <th scope="row"><?= $dataSet[$i]['Geometry']['Initial']['Internal']['A.U.'][$j]['Element'] ?></th>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['A.U.'][$j]['i'] ?></td>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['A.U.'][$j]['j'] ?></td>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['A.U.'][$j]['k'] ?></td>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['A.U.'][$j]['x'] ?></td>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['A.U.'][$j]['y'] ?></td>
            <td><?= $dataSet[$i]['Geometry']['Initial']['Internal']['A.U.'][$j]['z'] ?></td>
          </tr>
        <? } ?>
      </tbody>
    </table>
  </div>
</div>
