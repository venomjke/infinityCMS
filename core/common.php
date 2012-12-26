<?php
/**
 * Automatically includes classes
 * 
 * @throws Exception
 * 
 * @param  string $class  Name of the class to load
 * @return void
 */
function __autoload($class)
{
	$flourish_file = SYSPATH . 'flourish/' . $class . '.php';

	if (file_exists($flourish_file)) {
		return require $flourish_file;
	}
	
	$file = SYSPATH . 'classes/' . $class . '.php';
 
	if (file_exists($file)) {
		return require $file;
	}
	
	throw new Exception('The class ' . $class . ' could not be loaded');
}

/*
* Отображение шаблона
*/
function renderTemplate(&$tmpl,$layout,$view){
	//TODO: загружаемый $view может перезаписать параметры функции renderTemplate - это плохо, и это нужно как-то исправить.
	$content = '';
	ob_start();
	include $view;
	$content = ob_get_contents();
	ob_end_clean();
	$tmpl->set('content',$content);
	include $layout;
}