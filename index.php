<?php

session_start(); 

$minPHPVersion = '8.2'; 
if(phpversion() < $minPHPVersion)
    die("Potřebujete minimálně verzi php $minPHPVersion na spuštění této aplikace");

define('DS', DIRECTORY_SEPARATOR);
define('ROOTPATH', __DIR__.DS);

require 'config.php';
require 'app'.DS.'core'.DS.'init.php'; 

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$ACTIONS                = [];
$FILTERS                = [];
$APP['URL']             = split_url($_GET['url'] ?? 'home');
$APP['permissions']     = [];
$USER_DATA              = [];

/** načítaní pluginů */
$PLUGINS = get_plugin_folders();
if(!load_plugins($PLUGINS))
   die("<center><h1 style='font-family:tahoma;'>Nejsou k dispozici žádné pluginy. Vložte prosím alespoň jeden plugin do složky plugins.</h1></center>"); 

$APP['permissions'] = do_filter('permissions', $APP['permissions']);
/** načítání aplikace */
$app = new \Core\App();
$app->index();