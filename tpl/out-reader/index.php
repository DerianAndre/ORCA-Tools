<? $header['mini_logo'] = TRUE; $msg = FALSE;
ini_set('post_max_size', '999M');
ini_set('upload_max_filesize', '999M');
ini_set('max_file_uploads', 100);
include(ROOT . '/tpl/header.php');

if(empty($_FILES['file']['size'][0])) {
  $msg = $lang['no_file'];
}

if(!empty($_FILES) && !empty($_FILES['file']['size'][0])) {
  $noFiles = count($_FILES['file']['name']);
  for($i = 0; $i < $noFiles; $i++) {
    $fileName[$i] = $_FILES['file']['name'][$i];
    $ext = explode(".", $fileName[$i]);
    $fileName[$i] = $ext[0];
    $ext[$i] = end($ext);
    if($ext[$i] != 'out') {
      $msg = $lang['no_file_out'];
    } else {
      $msg = FALSE;
      $source[$i] = htmlspecialchars(file_get_contents($_FILES['file']['tmp_name'][$i]));
      $dataSet[$i] = arrayOutData($fileName[$i], $source[$i]);
      $_SESSION['outArray'][$i] = $dataSet[$i];
    }
  }
}
?>

<? if(!empty($msg)) {
    echo fileError($msg, 'index');
  } else { ?>
    <? include(ROOT . '/tpl/navbar.php'); ?>
    <div class="container-fluid">
      <div class="row">
        <? if($noFiles >= 2) { ?>
          <ul id="tab-files" class="col-12 px-3 mt-3 nav nav-tabs" role="tablist">
            <? for($i = 0; $i < $noFiles; $i++) { ?>
              <li class="nav-item">
                <a data-interval="3000" class="nav-link <? if($i == 0) { echo 'active'; }  ?>" id="file-<?= $i; ?>" data-toggle="pill" href="#tabs-file-<?= $i; ?>" role="tab" aria-controls="tabs-file-<?= $i; ?>-tab" aria-selected="true">
                  <?= fileTitle($dataSet[$i]['File name']); ?>
                </a>
              </li>
            <? } ?>
          </ul>
        <? } ?>
      <div id="tab-files-content" class="tab-content col-12 py-4">
        <? for($i = 0; $i < $noFiles; $i++) { ?>
          <div class="tab-pane fade <? if($i == 0) { echo 'show active'; } ?>" id="tabs-file-<?= $i; ?>" role="tabpanel" aria-labelledby="tabs-file-<?= $i; ?>-tab">
            <div class="file-content row m-0">
              <? include('content.php'); ?>
              <? if(isset($dataSet[$i]['Orbital energies'])) include('charts.php'); ?>
              <script>var CameraX = 0; var CameraY = 1.5; var CameraZ = 12;</script>
            </div>
          </div>
        <? } ?>
    </div>
  <? } ?>
<? include(ROOT . '/tpl/footer.php'); ?>
