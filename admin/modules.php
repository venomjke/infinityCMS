<?php // управление страницами
include dirname(__FILE__)."/../core/admin_init.php";

/*
* Разрешенные операции
*/
$action = fRequest::getValid('action', array('index','install','off','on','uninstall'));
$layout = ADMINVIEWS . "adminLayout.php";
$tmpl->set('title', 'Админка - Модули');
$tmpl->set('nav_current', 'modules');
//-------------------------------------//
if($action == 'index'){
	$tmpl->set('modules', Module::findAll());
	renderTemplate($tmpl, $layout, ADMINVIEWS . "modules/index.php");
}

//-------------------------------------//
if($action == 'install'){
	try{
		$modulePath = fRequest::get('path','string','');
		$moduleName = fRequest::get('name','string','');
		if(!empty($modulePath) && !empty($moduleName)){
			$module = new Module();
			$module->setPath($modulePath);
			$module->setName($moduleName);
			$module->setStatus(1);
			$module->store();
			Module::install($module);
			fMessaging::create('success','Модуль ' . $module->getName() . ' успешно установлен!');
		}

	}catch(fExpectedException $e){
		fMessaging::create('error',$e->getMessage());
	}
	fURL::redirect(CMS::adminUrl("modules.php"));
}

//------------------------------------//
if($action == 'on'){
	// включаем модуль
	$id = fRequest::get('id','integer');
	try{
		$module = new Module($id);
		$module->setStatus(1);
		$module->store();
		fMessaging::create('success','Модуль ' . $module->getName() . ' включен!');
	}catch(fNotFoundException $e){
		fMessaging::create('error',$e->getMessage());
	}catch(fExpectedException $e){
		fMessaging::create('error',$e->getMessage());
	}
	fURL::redirect(CMS::adminUrl("modules.php"));
}

if($action == 'off'){  
	// включаем модуль
	$id = fRequest::get('id','integer');
	try{
		$module = new Module($id);
		$module->setStatus(0);
		$module->store();
		fMessaging::create('success','Модуль ' . $module->getName() . ' выключен!');
	}catch(fNotFoundException $e){
		fMessaging::create('error',$e->getMessage());
	}catch(fExpectedException $e){
		fMessaging::create('error',$e->getMessage());
	}
	fURL::redirect(CMS::adminUrl("modules.php"));
}

//------------------------------------//
if($action == 'uninstall'){
	$id = fRequest::get('id','integer');

	try{
		// Удаляем модуль из базы
		$module = new Module($id);
		Module::uninstall($module);
		$module->delete();
	}catch(fExpectedException $e){
		fMessaging::create('error','Во время удаления произошел какой-то сбой');
	}
	fURL::redirect(CMS::adminUrl("pages.php"));
}