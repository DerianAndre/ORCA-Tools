<? // var_dump($dataSet[$i]); ?>
<? // var_dump($dataSet[$i]['Mult']); ?>
<div class="col-12" data-aos="zoom-in">
  <div class="top-info mb-0 d-md-flex justify-content-between align-items-center">
    <div class="d-md-flex align-items-center text-center text-md-left">
      <h2 class="m-0 d-block d-md-inline-block"><?= fileTitle($dataSet[$i]['File name']); ?></h2>
    </div>
    <div class="text-center text-md-left">
      <? if(!empty($_SESSION['outArray'][$i])) { ?><a class="m-1 btn-rounded btn btn-primary" href="download.php?zip=all" data-toggle="tooltip" title="<?= $lang['download_json_zip'] ?>"><i class="fas fa-file-archive"></i></a><? } ?>
      <? if(!empty($_SESSION['outArray'][$i])) { ?><a class="m-1 btn-rounded btn btn-success" href="download.php?id=<?= $i ?>" data-toggle="tooltip" title="<?= $lang['download_json'] ?>"><i class="fas fa-arrow-down"></i></a><? } ?>
      <span class="m-1 d-inline-block" tabindex="0" data-toggle="tooltip" title="Ver archivo original"><button type="button" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#RAW-<?= $i ?>"><i class="fas fa-file-alt"></i></button></span>
      <? if(isset($dataSet[$i]['ORCA Warnings'])) { ?><a class="m-1 btn-rounded btn btn-warning" href="#warnings-<?= $i ?>" data-toggle="tooltip" title="<?= $lang['warnings'] ?>"><i class="fas fa-exclamation"></i></a><? } ?>
      <? if(isset($dataSet[$i]['ORCA Information'])) { ?><a class="m-1 btn btn-rounded btn-info" href="#info-<?= $i ?>" data-toggle="tooltip" title="<?= $lang['information'] ?>"><i class="fas fa-info"></i></a><? } ?>
    </div>
  </div>
</div>

<div class="col-sm-12 col-md-6 col-lg-9">
  <div class="row">
    <!-- Sidebar left -->
    <div id="sidebar-left" class="col-md-12 col-lg-3" data-aos="fade-right">
      <? include(ROOT . '/tpl/out-reader/results.php'); ?>
      <? include(ROOT . '/tpl/out-reader/general.php'); ?>
      <? include(ROOT . '/tpl/out-reader/homo.lumo.php'); ?>
 
      <? if(!empty($dataSet[$i]['Input'])) { ?>
        <h4><?= $lang['input'] ?></h4>
        <pre class="mb-0 p-3 bg-light text-dark" data-aos="zoom-out" data-aos-delay="500"><?= $dataSet[$i]['Input'] ?></pre>
      <? } ?>
    </div>

    <!-- Content middle  -->
    <div id="content-middle" class="cold-md-12 col-lg-9" data-aos="fade-down">
      <? include(ROOT . '/tpl/out-reader/3d.model.php'); ?>
      <? include(ROOT . '/tpl/out-reader/geometry.php'); ?>
      <? include(ROOT . '/tpl/out-reader/warning.info.php'); ?>
    </div>
  </div>
</div>

<!-- Sidebar right -->
<div id="sidebar-right" class="col-sm-12 col-md-6 col-lg-3" data-aos="fade-left">
  <? include(ROOT . '/tpl/out-reader/orbital.energies.php'); ?>
  <? include(ROOT . '/tpl/out-reader/vibrational.frequencies.php'); ?>
</div>

<!-- Modal -->
<div class="modal fade" id="RAW-<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="RAW-Title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RAW-Title"><?= $lang['raw_file'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <pre class="raw"><?= $dataSet[$i]['File RAW'] ?></pre>
      </div>
    </div>
  </div>
</div>
