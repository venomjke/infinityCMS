<?php // конфигурация админки
include dirname(__FILE__)."/base_config.php";

/*
* Путь до панели админа
*/
define('ADMINPATH',BASEPATH . 'admin/');
/*
* Url до панели админа
*/
define('ADMINURL', BASEURL . "admin/");
/*
* Путь до отображений панели админа
*/
define('ADMINVIEWS',ADMINPATH . 'views/');


/*
* Аутентификация
*/
fAuthorization::setLoginPage(ADMINURL . 'auth.php?a=login');
fAuthorization::setAuthLevels(
	array(
		'admin' => 10,
		'guest' => 1
	)
);

$tmpl = new fTemplating(ADMINVIEWS);
