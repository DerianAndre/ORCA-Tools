<? $phpfile = __FILE__; include('config.php'); ini_set('post_max_size', '999M'); ini_set('upload_max_filesize', '999M');
if($_GET && $_SESSION) {
  if(isset($_GET['zip'])) {
    arrayExportZIP($_SESSION['outArray']);
  } elseif(isset($_GET['id'])) {
    $id = $_GET['id'];
    echo arrayExportJSON($_SESSION['outArray'][$id]);
  }
} else {
  echo 'Error';
}
