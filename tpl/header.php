<!DOCTYPE html>
<html lang="<?=$lang['lang_code']?>" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="utf-8">
<title><?=$header['title']?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
<meta name="description" content="<?=$header['page-description']?>" />
<meta name="author" content="Derian André Castillo Franco">
<!-- OpenGraph -->
<meta property="og:title" content="<?=$header['page-name']?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=$settings['url']?>" />
<meta property="og:image" content="<?=$settings['url']?>assets/brand/icon-rectangle.png" />
<!-- General -->
<meta name="application-name" content="<?=$settings['app-name']?>" />
<meta name="theme-color" content="<?=$theme['primary-color-hex']?>" />
<!-- Microsoft  -->
<meta name="msapplication-tap-highlight" content="no" />
<meta name="msapplication-TileColor" content="<?=$theme['primary-color-hex']?>" />
<meta name="msapplication-TileImage" content="<?=$settings['url']?>assets/brand/mstile-144x144.png" />
<meta name="msapplication-config" content="<?=$settings['url']?>assets/brand/browserconfig.xml" />
<!-- Apple -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="<?=$theme['primary-color-hex']?>">
<meta name="apple-mobile-web-app-title" content="<?=$settings['app-name'] ?>" />
<link rel="apple-touch-icon" sizes="180x180" href="<?=$settings['url']?>assets/brand/apple-touch-icon.png" />
<link rel="mask-icon" href="<?=$settings['url']?>assets/brand/safari-pinned-tab.svg" color="<?=$theme['primary-color-hex']?>" />
<!-- Iconos -->
<link rel="icon" type="image/png" sizes="32x32" href="<?=$settings['url']?>assets/brand/favicon-32x32.png" />
<link rel="icon" type="image/png" sizes="192x192" href="<?=$settings['url']?>assets/brand/android-chrome-192x192.png" />
<link rel="icon" type="image/png" sizes="16x16" href="<?=$settings['url']?>assets/brand/favicon-16x16.png" />
<link rel="icon" type="image/png" href="<?=$settings['url']?>assets/brand/favicon.png" />
<!-- WebApp Manifest.json -->
<link rel="manifest" href="<?=$settings['url']?>assets/brand/manifest.json" />
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/bootstrap-fs-modal.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/animate.css" rel="stylesheet">
<link href="assets/css/aos.css" rel="stylesheet">
<!-- JavaScript -->
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
</head>
<body<? if(!$_POST) { echo ' class="page-full"'; } ?>>
