<? $phpfile = __FILE__; include('config.php'); $msg = FALSE;

if($_POST) {
  $header['single'] = FALSE;
} else {
  $header['single'] = TRUE;
  $header['mini_logo'] = FALSE;
}

include(ROOT . '/tpl/header.php'); ?>
<? if(isset($header['single']) && $header['single']) { ?>
<div class="main text-center">
  <div class="main-container col-12 col-sm-12 col-md-10 col-lg-6 d-flex flex-column h-100 mx-auto p-5">
    <header class="masthead mb-auto">
      <div class="inner d-flex justify-content-between align-items-center">
        <? include(ROOT . '/tpl/navbar-single.php'); ?>
      </div>
    </header>
    <main role="main" class="inner">
      <h1 class="cover-heading"><?= $header['page-heading'] ?></h1>
      <p class="lead"><?= $header['page-lead']; ?></p>
      <div class="box mt-5">
        <form method="post" enctype="multipart/form-data" clasas="d-flex justify-content-center align-items-center">
          <input name="file" id="file" class="inputfile" data-multiple-caption="{count} archivos" multiple="" type="file">
          <label for="file" class=" btn btn-lg btn-outline-light btn-label"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Elegir...</span></label>
          <input type="submit" value="Ok" name="submit" class="btn btn-lg btn-outline-light btn-sumbit">
        </form>
      </div>
    </main>
    <footer class="mastfoot mt-auto">
      <div class="inner">
      </div>
    </footer>
  </div>
</div>
<? } ?>

<? if($_POST) {
  $fileName = $_FILES['file']['name'];
  $ext = explode(".", $fileName);
  $fileName = $ext[0];
  $ext = end($ext);
  $allowed =  array('mol', 'pdb', 'sdf', 'xyz');
  if(!in_array($ext, $allowed)) {
    $msg = $lang['no_file_ext_viewer'];
    if ($_FILES['file']['error'] > 0) {
      $msg = $lang['file_error'];
    }
  } else {
    $xyz = 'tmp/cc-' . $fileName . '-' . rand(999999, 99999999) . '.txt';
    $fileXYZ = new SplFileObject($xyz, 'w');
    $fileXYZ->fwrite(htmlspecialchars(file_get_contents($_FILES['file']['tmp_name'])));
  }

  if(!empty($msg)) {
    fileError($msg, $page);
  } else { ?>
    <div class="navbar-single m-3 d-flex align-items-center">
      <? $header['mini_logo'] = TRUE; include(ROOT . '/tpl/navbar-single.php'); ?>
    </div>
    <div id="molvwr" class="molvwr mol mol-left molvwr-full p-0 m-0" data-molvwr="<?= $xyz; ?>" <? if($ext != 'sdf') { ?>data-molvwr-format="<?= $ext; ?>"<? } ?>></div>
    <script>var CameraX = 0; var CameraY = 1.5; var CameraZ = 18;</script>
<? }
} else {
  deleteTmpFiles();
}
include(ROOT . '/tpl/footer.php'); ?>
