<?php

/**
 * Konstansok
 */
define('DS', DIRECTORY_SEPARATOR);
define('APP_PATH', realpath(__DIR__));
define('CONTROLLER_DIR', __DIR__ . DS . 'Controller' . DS);
define('RESOURCES_DIR', __DIR__ . DS . 'Resources' . DS);
define('VIEWS_DIR', __DIR__ . DS . 'View' . DS);
define('SESSION_TIMEOUT', 60*30);
define('START_FILE', 'index.php');
define('DEFAULT_PAGE', 'home');
define('DEFAULT_ACTION', 'index');

/**
 * Karakterkeszlet
 */
ini_set('default_charset', 'UTF-8');

/**
 * Hiba uzenetek kiiratasa
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Datum lokalizacio
 * 
 * Ha nincs magyar, akkor telepites:
 * sudo locale-gen hu_HU.utf8
 * sudo dpkg-reconfigure locales
 * sudo service apache2 restart
 */
setlocale(LC_ALL, 'hu_HU.utf8');

/**
 * Autoload
 */
require 'autoloader.php';

spl_autoload_register('autoload');

/**
 * Inicializalas
 */

System\Request::init();
System\Session::init();
System\Database::init('db.ini');
System\View::init(VIEWS_DIR);