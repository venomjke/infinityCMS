<?php include dirname(__FILE__) . "/core/site_init.php";

// параметры для загрузки страницы
$pageId = fRequest::get('id','integer',0);
$pageName = fRequest::get('name','string','');

//мини-диспетчер, по переданным параметрам определяет каким образом загрузить страницу
//если параметры не указаны, то загружается главная страница
if(!empty($pageId)){
	loadPageById($pageId);
}else if(!empty($pageName)){
	loadPageByName($pageName);
}else{
	loadPageById(Page::getHomePageId());
}

function loadPageById($pageId){
	try{
		$page = new Page($pageId);
		loadPage($page);
	}catch(fNotFoundException $e){
		CMS::load404Page();
	}
}

function loadPageByName($pageName){
	try{
		$page = new Page(array('file_name'=>$pageName));
		loadPage($page);
	}catch(fNotFoundException $e){
		CMS::load404Page();
	}
}

function loadPage($page)
{
	$tmplLayout = $page->createLayout();
	$tmpl = new fTemplating(CMS::basePath());
	$tmpl->set('page',$page);
	if($tmplLayout->exists()){
		renderTemplate($tmpl,CMS::layoutPath() . $tmplLayout->getFileName() . EXT, CMS::pagePath() . $page->getFileName() . EXT);
		return;
	}
	include CMS::pagePath() . $page->getFileName() . EXT;
}