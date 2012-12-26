<?php // управление страницами
include dirname(__FILE__)."/../core/admin_init.php";

/*
* Разрешенные операции
*/
$action = fRequest::getValid('action', array('index','add','edit','delete'));
$tmplLayout = ADMINVIEWS . "adminLayout.php";
$tmpl->set('title', 'Админка - Макеты');
$tmpl->set('nav_current', 'layouts');
$tmpl->set('toolbar', 'layouts/toolbar.php');
//-------------------------------------//
if($action == 'index'){
	$tmpl->set('layouts', Layout::findAll());
	renderTemplate($tmpl, $tmplLayout, ADMINVIEWS . "layouts/index.php");
}

//-------------------------------------//
if($action == 'add'){
	try{
		$layout = new Layout();
		$layoutContent = '';
		if(fRequest::isPost()){
			// Собираем форму и сохраняем её в базу.
			$layout->populate();
			$layout->store();
			fMessaging::create('success', 'Макет создан');
			// Создаем файл на жестком диске
			$layoutContent = fRequest::get('layout_content','string','');
			fFile::create(CMS::layoutPath() . $layout->getFileName() . EXT, $layoutContent);
			// Переходим на страницу редактирования
			fURL::redirect(Layout::makeActionUrl("edit",$layout));
		}
	}catch(fExpectedException $e){
		fMessaging::create('error',$e->getMessage());
	}

	$tmpl->set('layout', $layout);
	$tmpl->set('layoutContent',$layoutContent);
	renderTemplate($tmpl,$tmplLayout,ADMINVIEWS . "layouts/form.php");
}

//------------------------------------//
if($action == 'edit'){
	$id = fRequest::get('id','integer');
	try{
		$layout = new Layout($id);
		$layoutFile = fFilesystem::createObject(LAYOUTPATH . $layout->getFileName() . EXT);
		$layoutContent = $layoutFile->read();

		if(fRequest::isPost()){
			$layout->populate();
			$layout->store();
			// обновляем содержимое страницы
			$layoutContent = fRequest::get('layout_content','string','');
			// если изменилось назование файла, то переименовываем его
			if($layoutFile->getName() != $layout->getFileName() . EXT){
				$layoutFile->rename($layout->getFileName() . EXT,true);
			}
			$layoutFile->write($layoutContent);
			fMessaging::create('success','Макет успешно отредактирован');
		}

	}catch(fNotFoundException $e){
		fURL::redirect(CMS::adminUrl('layouts.php'));
	}catch(fExpectedException $e){
		fMessaging::create('error',$e->getMessage());
	}

	$tmpl->set('layout',$layout);
	$tmpl->set('layoutContent',$layoutContent);
	renderTemplate($tmpl,$tmplLayout,ADMINVIEWS . "layouts/form.php");
}

//------------------------------------//
if($action == 'delete'){
	$id = fRequest::get('id','integer');

	try{
		// Удаляем страницу из базы
		$layout = new Layout($id);
		$layout->delete();

		// Удаляем страницу с диска
		$layoutFile = fFilesystem::createObject(LAYOUTPATH . $layout->getFileName() . EXT);
		$layoutFile->delete();

	}catch(fExpectedException $e){
		fMessaging::create('error','Во время удаления произошел какой-то сбой');
	}
	fURL::redirect(CMS::adminUrl('layouts.php'));
}
