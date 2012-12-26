<?php // управление страницами
include dirname(__FILE__)."/../core/admin_init.php";

/*
* Разрешенные операции
*/
$action = fRequest::getValid('action', array('index','add','edit','delete'));
$layout = ADMINVIEWS . "adminLayout.php";
$tmpl->set('title', 'Админка - Страницы');
$tmpl->set('nav_current', 'pages');
$tmpl->set('toolbar', 'pages/toolbar.php');
//-------------------------------------//
if($action == 'index'){
	$tmpl->set('pages', Page::findAll());
	renderTemplate($tmpl, $layout, ADMINVIEWS . "pages/index.php");
}

//-------------------------------------//
if($action == 'add'){
	try{
		$page = new Page();
		$pageContent = '';
		if(fRequest::isPost()){
			// Собираем форму и сохраняем её в базу.
			$page->populate();
			$page->setPubDate(new fTimestamp());
			$page->store();
			fMessaging::create('success', 'Страница создана');
			// Создаем файл на жестком диске
			$pageContent = fRequest::get('page_content','string','');
			fFile::create(CMS::pagePath() . $page->getFileName() . EXT, $pageContent);
			// Переходим на страницу редактирования
			fURL::redirect(Page::makeActionUrl("edit",$page));
		}

	}catch(fExpectedException $e){
		fMessaging::create('error',$e->getMessage());
	}

	$tmpl->set('page', $page);
	$tmpl->set('pageContent',$pageContent);
	renderTemplate($tmpl,$layout,ADMINVIEWS . "pages/form.php");
}

//------------------------------------//
if($action == 'edit'){
	$id = fRequest::get('id','integer');
	try{
		$page = new Page($id);
		$pageFile = fFilesystem::createObject(CMS::pagePath() . $page->getFileName() . EXT);
		$pageContent = $pageFile->read();

		if(fRequest::isPost()){
			$page->populate();
			$page->store();
			// обновляем содержимое страницы
			$pageContent = fRequest::get('page_content','string','');
			if($pageFile->getName() != $page->getFileName() . EXT){
				$pageFile->rename($page->getFileName() . EXT, TRUE);
			}
			$pageFile->write($pageContent);
			fMessaging::create('success','Сниппет успешно отредактирован');
		}

	}catch(fNotFoundException $e){
		fURL::redirect(CMS::adminUrl("pages.php"));
	}catch(fExpectedException $e){
		fMessaging::create('error',$e->getMessage());
	}

	$tmpl->set('page',$page);
	$tmpl->set('pageContent',$pageContent);
	renderTemplate($tmpl,$layout,ADMINVIEWS . "pages/form.php");
}

//------------------------------------//
if($action == 'delete'){
	$id = fRequest::get('id','integer');

	try{
		// Удаляем страницу из базы
		$page = new Page($id);
		$page->delete();

		// Удаляем страницу с диска
		$filePage = fFilesystem::createObject(CMS::pagePath() . $page->getFileName() . EXT);
		$filePage->delete();

	}catch(fExpectedException $e){
		fMessaging::create('error','Во время удаления произошел какой-то сбой');
	}
	fURL::redirect(CMS::adminUrl("pages.php"));
}