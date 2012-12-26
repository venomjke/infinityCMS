<?php // управление страницами
include dirname(__FILE__)."/../core/admin_init.php";

/*
* Разрешенные операции
*/
$action = fRequest::getValid('action', array('index'));
$layout = ADMINVIEWS . "adminLayout.php";
$tmpl->set('title', 'Админка - Пользователь');
$tmpl->set('nav_current', 'users');
//-------------------------------------//
if($action == 'index'){
	// $tmpl->set('settings', Module::findAll());
	renderTemplate($tmpl, $layout, ADMINVIEWS . "users/index.php");
}