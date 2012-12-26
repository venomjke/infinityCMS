<?php 
/*
* Путь до корневой директории системы
*/
define('BASEPATH', realpath(dirname(__FILE__) . '/../') . "/");
/*
* Путь до системной директории
*/
define('SYSPATH', BASEPATH . "core/");
/*
* Корневой url системы
*/
$base_url = '';
if (isset($_SERVER['HTTP_HOST']))
{
	// делаем "чистый uri" для правильного формирования baseurl
	$script_name = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
	$script_name = preg_replace('@admin/|modules/@', '', $script_name);
	$base_url = ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') ? 'https' : 'http';
	$base_url .= '://'.$_SERVER['HTTP_HOST'].$script_name;
}
else
{
	$base_url = 'http://localhost/';
}
define('BASEURL', $base_url);
/*
* Путь до директории модулей системы
*/
define('MODPATH', BASEPATH . "modules/");
/*
* Путь до папки со страницами
*/
define('PAGEPATH', BASEPATH . "pages/");
/*
* Путь до папки с макетами
*/
define('LAYOUTPATH', BASEPATH . "layouts/");
/*
* Путь до папки со сниппетами
*/
define('SNIPPETPATH',BASEPATH . "snippets/");
/*
* Расширение файлов
*/
define('EXT','.php');

include  SYSPATH . 'common.php';
include  SYSPATH . 'constructor_functions.php';
include  SYSPATH . 'database.php';

// Инициализация системы
CMS::init();
/*
* Режим работы
*/
// TODO: Добавить параметр для разделения среды на development и production
error_reporting(E_STRICT | E_ALL);

fCore::enableErrorHandling('html');
fCore::enableExceptionHandling('html');
fCore::disableContext();


// This prevents cross-site session transfer
fSession::setPath(SYSPATH . 'data/session/');

fTimestamp::setDefaultTimezone('Europe/Moscow');
