<?
define('DEBUG',   TRUE);
define('ROOT',    $_SERVER['DOCUMENT_ROOT'].'/orca/');
define('ORCAToolsVersion',    '1.5');

require_once(ROOT.'inc/functions.php');
displayErrors();

$settings['url'] = '/orca/';
$settings['app-name'] = "ORCA Tools";
$theme['primary-color-hex'] = "#333333";

$_SESSION = false;
session_start();
if(!empty($_GET['lang'])) {
  $session['language'] = $_GET['lang'];
  if($session['language'] && $session['language'] != $_GET['lang']) {
    echo "<script type='text/javascript'>location.reload();</script>";
  }
} else {
  $session['language'] = "es";
}

require_once(ROOT."lang/{$session['language']}.php");

if(isset($phpfile)) {
  if(!isset($header['base'])) $header['base'] = false;
  $header['page'] = basename($phpfile, '.php');
  $header['page-name'] = (isset($lang['page_' . $header['page']])) ? $lang['page_' . $header['page']] : '';
  $header['page-heading'] = (isset($lang['page_' . $header['page'] . '_heading'])) ? $lang['page_' . $header['page'] . '_heading'] : '';
  $header['page-lead'] = (isset($lang['page_' . $header['page'] . '_lead'])) ? $lang['page_' . $header['page'] . '_lead'] : '';
  $header['page-description'] = (isset($lang['page_' . $header['page'] . '_description'])) ? $lang['page_' . $header['page'] . '_description'] : '';
  $header['title'] = $header['page-name'];
} else {
  echo "Error no php file";
}
