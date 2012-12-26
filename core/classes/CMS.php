<?php

/**
 * Интерфейс управления системой
 *
 * @author alex
 **/
class CMS
{

	/*
	* Экземпляр базы данных
	*/
	private static $db;	

	/**
	 * Инициализация системы
	 *
	 * @return void
	 * @author alex
	 **/
	static function init()
	{
		/*
		* Проверка целостности файлов
		*/
		Page::checkPagesFiles();
		Layout::checkLayoutsFiles();
		Snippet::checkSnippetsFiles();
	}

	/**
	 * Базовый путь
	 *
	 * @return string
	 * @author alex
	 **/
	static function basePath()
	{
		return BASEPATH;
	}

	/**
	 * Системный путь
	 *
	 * @return string
	 * @author alex
	 **/
	static function systemPath()
	{
		return SYSPATH;
	}

	/**
	 * Путь до папки с макетами
	 *
	 * @return string
	 * @author alex
	 **/
	static function layoutPath()
	{
		return Layout::layoutPath();
	}

	/**
	 * путь до папки с страницми
	 *
	 * @return string
	 * @author alex
	 **/
	static function pagePath()
	{
		return Page::pagePath();
	}

	/**
	 * путь до папки со сниппетами
	 *
	 * @return string
	 * @author alex
	 **/
	static function snippetPath()
	{
		return Snippet::snippetPath();
	}

	/**
	 * путь до папки с модулями
	 *
	 * @return string
	 * @author alex
	 **/
	static function modulePath()
	{
		return Module::modulePath();
	}

	/**
	* Формирование url относительно корня сайта
	*/
	static function siteUrl($uri='',$query='')
	{
		if(empty($query)){
			return BASEURL . $uri;
		}

		if(!empty($query)){

			if(is_string($query)){
				return BASEURL . $uri . "?" . $query;
			}else{
				return BASEURL . $uri . "?" . http_build_query($query);
			}
		}
	}

	/**
	* Формирование базового url
	*/
	static function baseUrl()
	{
		return BASEURL;
	}

	/**
	 * Формирование url относительно админ-панели
	 *
	 * @return string
	 * @author alex
	 **/
	static function adminUrl($uri='', $query='')
	{
		return CMS::siteUrl("admin/" . $uri, $query);
	}

	/**
	 * Загрузки страницы "Не найдено"
	 *
	 * @return void
	 * @author alex
	 **/
	static function load404Page()
	{
		//TODO: Добавить возможность создавать эту страницу в ручную, или отмечать её в конфиге БД.
		include SYSPATH . "page404.php";
	}

	/**
	 * Загрузка сниппета. 
	 *
	 * @return void
	 * @author 
	 **/
	static function loadSnippet($key)
	{
		return Snippet::loadSnippet($key);
	}

	/**
	 * Include файла с последующим буферированием содержимого
	 *
	 * @return string
	 * @author alex
	 **/
	static function loadFile($_file)
	{
		$_content = '';
		if(file_exists($_file)){
			ob_start();
			include $_file;
			$_content = ob_get_contents();
			ob_end_clean();
			return $_content;
		}
		//TODO: Заместо пустой строки нужно генерировать исключение
		return '';
	}

	/**
	 * Формирование url страницы сайта
	 *
	 * @return string
	 * @author alex
	 **/
	static function pageUrl($key,$query='')
	{
		return Page::pageUrl($key,$query);
	}

	/**
	 * Интерфейс базы данных
	 *
	 * @return object
	 * @author alex
	 **/
	static function getDb()
	{
		return CMS::$db;
	}

	/**
	 * Интерфейс для загрузки модуля системы
	 *
	 * @return string
	 * @author alex
	 **/
	static function loadModule($module,$method='index',$args=array())
	{
		return Module::loadModule($module,$method,$args);
	}
	/*
	* Только для использования как статического класса
	*/
	private function __construct(){}
} // END class CMS