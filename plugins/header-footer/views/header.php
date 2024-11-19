<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(page())?> | <?=APP_NAME?></title>

    <!-- Fonts -->
    <link  href="<?= plugin_http_path('assets/fonts/Open_Sans/plugins/basic-admin/assets/fonts/Open_Sans/OpenSans-VariableFont_wdth,wght.ttf') ?>">
    <link  href="<?= plugin_http_path('assets/fonts/Open_Sans/plugins/basic-admin/assets/fonts/Open_Sans/plugins/basic-admin/assets/fonts/Open_Sans/OpenSans-Italic-VariableFont_wdth,wght.ttf') ?>">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?=ROOT?>/assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=ROOT?>/assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=ROOT?>/assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?=ROOT?>/assets/images/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?=ROOT?>/assets/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="<?=ROOT?>/assets/images/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#cffafe">
    <meta name="msapplication-config" content="<?=ROOT?>/assets/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Code for Google Analytics -->
     <!-- Code for Online chat -->
</head>
<body>

<?php do_action(plugin_id(). '_main_menu',['links'=>$links]) ?>
