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
      $source[$i] = htmlspecialchars(file_get_contents($_FILES['file']['tmp_name'][$i]));
      $dataSet[$i] = arrayOutData($fileName[$i], $source[$i]);
    }
  }
}
?>

<? if(!empty($msg) || $noFiles == 0) {
    echo fileError($msg, 'ods');
  } else { ?>
    <? include(ROOT . '/tpl/navbar.php'); ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 bg-white py-3">
          <? include('content.php'); ?>
        </div>
    <? } ?>
  </div>
</div>

<? include(ROOT . '/tpl/footer.php'); ?>
