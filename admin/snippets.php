<?php // управление страницами
include dirname(__FILE__)."/../core/admin_init.php";

/*
* Разрешенные операции
*/
$action = fRequest::getValid('action', array('index','add','edit','delete'));
$layout = ADMINVIEWS . "adminLayout.php";
$tmpl->set('title', 'Админка - Сниппеты');
$tmpl->set('nav_current', 'snippets');
$tmpl->set('toolbar', 'snippets/toolbar.php');
//-------------------------------------//
if($action == 'index'){
	$tmpl->set('snippets', Snippet::findAll());
	renderTemplate($tmpl, $layout, ADMINVIEWS . "snippets/index.php");
}

//-------------------------------------//
if($action == 'add'){
	try{
		$snippet = new Snippet();
		$snippetContent = '';
		if(fRequest::isPost()){
			// Собираем форму и сохраняем её в базу.
			$snippet->populate();
			$snippet->store();
			fMessaging::create('success', 'Сниппет создан');
			// Создаем файл на жестком диске
			$snippetContent = fRequest::get('snippet_content','string','');
			fFile::create(Snippet::snippetPath() . $snippet->getFileName() . EXT, $snippetContent);
			// Переходим на страницу редактирования
			fURL::redirect(Snippet::makeActionUrl("edit",$snippet));
		}

	}catch(fExpectedException $e){
		fMessaging::create('error',$e->getMessage());
	}

	$tmpl->set('snippet', $snippet);
	$tmpl->set('snippetContent',$snippetContent);
	renderTemplate($tmpl,$layout,ADMINVIEWS . "snippets/form.php");
}

//------------------------------------//
if($action == 'edit'){
	$id = fRequest::get('id','integer');
	try{
		$snippet = new Snippet($id);
		$snippetFile = fFilesystem::createObject(CMS::snippetPath() . $snippet->getFileName() . EXT);
		$snippetContent = $snippetFile->read();

		if(fRequest::isPost()){
			$snippet->populate();
			$snippet->store();
			// обновляем содержимое страницы
			$snippetContent = fRequest::get('snippet_content','string','');
			if($snippetFile->getName() != $snippet->getFileName() . EXT){
				$snippetFile->rename($snippet->getFileName() . EXT, TRUE);
			}
			$snippetFile->write($snippetContent);
			fMessaging::create('success','Сниппет успешно отредактрован');
		}

	}catch(fNotFoundException $e){
		fURL::redirect(CMS::adminUrl("snippet.php"));
	}catch(fExpectedException $e){
		fMessaging::create('error',$e->getMessage());
	}

	$tmpl->set('snippet',$snippet);
	$tmpl->set('snippetContent',$snippetContent);
	renderTemplate($tmpl,$layout,ADMINVIEWS . "snippets/form.php");
}

//------------------------------------//
if($action == 'delete'){
	$id = fRequest::get('id','integer');

	try{
		// Удаляем страницу из базы
		$snippet = new Snippet($id);
		$snippet->delete();

		// Удаляем страницу с диска
		$snippetFile = fFilesystem::createObject(CMS::snippetPath() . $snippet->getFileName() . EXT);
		$snippetFile->delete();

	}catch(fExpectedException $e){
		fMessaging::create('error','Во время удаления произошел какой-то сбой');
	}
	fURL::redirect(CMS::adminUrl("snippet.php"));
}