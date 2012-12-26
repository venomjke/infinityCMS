<?php

class Page extends fActiveRecord{
	/**
	 * Путь до папки со страницами
	 *
	 * @return string
	 * @author alex
	 **/
	static function pagePath()
	{
		return CMS::basePath() . 'pages/';
	}	

	/**
	 * Returns all meetups on the system
	 * 
	 * @param  string  $sort_column  The column to sort by
	 * @param  string  $sort_dir     The direction to sort the column
	 * @return fRecordSet  An object containing all meetups
	 */
	static function findAll($sort_column='', $sort_dir='')
	{
		if (!in_array($sort_column, array('id','title', 'name'))) {
			$sort_column = 'id';
		} 
		
		if (!in_array($sort_dir, array('asc', 'desc'))) {
			$sort_dir = 'asc';
		}
		
		return fRecordSet::build(
			__CLASS__,
			array(),
			array($sort_column => $sort_dir)
		);	
	}

	/**
	* Формирование Action Url
	*/
	static function makeActionUrl($action = 'edit',$page)
	{
		switch($action){
			case 'edit':
				return CMS::adminUrl("pages.php", array('action'=>'edit', 'id'=>$page->getId()));
				break;
			case 'delete':
				return CMS::adminUrl('pages.php', array('action'=>'delete', 'id'=>$page->getId()));
				break;
			case 'add':
				return CMS::adminUrl('pages.php', array('action'=>'add'));
				break;
		}
	}

	/**
	 * Формирование списка корневых страниц
	 *
	 * @return array
	 * @author alex
	 **/
	static function getRootPages()
	{
		return fRecordSet::build(
			__CLASS__,
			array('parent_id='=>array())
		);
	}

	/**
	 * Проверка файлов страниц. Если соотвествующие страницам файлы отсутствуют, то система создает их.
	 *
	 * @return void
	 * @author alex
	 **/
	static function checkPagesFiles()
	{
		$pages = fRecordSet::build(__CLASS__);
		//TODO: Удалять файлы(мусор), которые не связаны со страницами в базе.
		foreach($pages as $page){
			if(!file_exists(PAGEPATH . $page->getFileName() . EXT)){
				fFile::create(PAGEPATH . $page->getFileName() . EXT,'');
			}
		}
	}

	/**
	 * Выбор главной страницы из базы данных 
	 *
	 * @return object
	 * @author alex
	 **/
	static function getHomePageId()
	{
		$pages = fRecordSet::build(
			__CLASS__,
			array( 
				'status=' => 1,
				'main=' => 1
			),
			array('id' => 'asc'),
			1
		);
		if($pages->count()){
			return $pages->getRecord(0)->getId();
		}
		return 0;
	}

	/**
	 * Формирование url страницы по ключу
	 *
	 * @return string
	 * @author alex
	 **/
	static function pageUrl($key,$query='')
	{
		$page = '';
		$url = '';
		try{

			if(is_string($key)){
				$page = new Page(array('file_name'=>$key));
				$url = CMS::siteUrl('pages.php',array('name'=>$key));
			}else if(is_number($key)){
				$page = new Page($key);
				$url = CMS::siteUrl('pages.php',array('id'=>$key));
			}
			return $url;
		}catch(fNotFoundException $e){

		}
		return '';

	}

	protected function configure()
	{
		
	}
}