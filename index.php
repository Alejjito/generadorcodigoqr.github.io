<?php

error_reporting(E_ALL ^ E_NOTICE);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require dirname(__FILE__)."/config.php";

session_name($_CONFIG['session_name']);
session_start();

if (isset($_GET['reset'])) {
    unset($_SESSION['logo']);
}

global $_ERROR;

if (isset($_SESSION['error'])) {
    $_ERROR = $_SESSION['error'];
    unset($_SESSION['error']);
}

require dirname(__FILE__)."/include/functions.php";

$browserDetect = array_key_exists('detect_browser_lang', $_CONFIG) ? $_CONFIG['detect_browser_lang'] : true;
$defaultlang = array_key_exists('lang', $_CONFIG) ? $_CONFIG['lang'] : 'es';
$color_primary = array_key_exists('color_primary', $_CONFIG) ? $_CONFIG['color_primary'] : false;

$lang = getLang($defaultlang, $browserDetect);

if (file_exists(dirname(__FILE__)."/translations/".$lang.".php")) {
    include dirname(__FILE__)."/translations/".$lang.".php";
}

require dirname(__FILE__)."/include/head.php";
require dirname(__FILE__)."/lib/countrycodes.php";

?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title>Código Qr</title>
        <meta name="description" content="<?php echo getString('description'); ?>">
        <meta name="keywords" content="<?php echo getString('tags'); ?>">

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/96/96977.png" type="image/x-icon" />

        <!--[if lt IE 9]>
            <script src="js/ie8.js"></script>
        <![endif]-->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="js/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">

        <link href="style.css" rel="stylesheet">

        <script src="js/jquery-3.2.1.min.js"></script>
        <?php echo setMainColor($color_primary); ?>
    </head>
    <body class="bg-light">
        
        <?php
        if (file_exists(dirname(__FILE__).'/template/header.php')) {
            include dirname(__FILE__).'/template/header.php';
        }
        if (file_exists(dirname(__FILE__).'/include/generator.php')) {
            include dirname(__FILE__).'/include/generator.php';
        }
        if (file_exists(dirname(__FILE__).'/template/footer.php')) {
            include dirname(__FILE__).'/template/footer.php';
        }
        ?>
        <script src="js/popper.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="js/all.js?v=3"></script>
        
    </body>
</html>