<?php

class Layout extends fActiveRecord{

	/**
	 * Путь до папки с макетами
	 *
	 * @return stirng
	 * @author alex
	 **/
	static function layoutPath()
	{
		return CMS::basePath() . "layouts/";
	}

	/**
	 * Returns all layouts on the system
	 * 
	 * @param  string  $sort_column  The column to sort by
	 * @param  string  $sort_dir     The direction to sort the column
	 * @return fRecordSet  An object containing all meetups
	 */
	static function findAll($sort_column='', $sort_dir='')
	{
		if (!in_array($sort_column, array('id', 'name'))) {
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
		$uri = 'layouts.php';
		switch($action){
			case 'edit':
				return CMS::adminUrl($uri, array('action'=>'edit', 'id'=>$page->getId()));
				break;
			case 'delete':
				return CMS::adminUrl($uri, array('action'=>'delete', 'id'=>$page->getId()));
				break;
			case 'add':
				return CMS::adminUrl($uri, array('action'=>'add'));
				break;
		}
	}

	/**
	 * Проверка файлов страниц. Если соотвествующие страницам файлы отсутствуют, то система создает их.
	 *
	 * @return void
	 * @author alex
	 **/
	static function checkLayoutsFiles()
	{
		$layouts = fRecordSet::build(__CLASS__);
		//TODO: Удалять файлы(мусор), которые не связаны со страницами в базе.
		foreach($layouts as $layout){
			if(!file_exists(Layout::layoutPath() . $layout->getFileName() . EXT)){
				fFile::create(Layout::layoutPath() . $layout->getFileName() . EXT,'');
			}
		}
	}

	protected function configure()
	{
		
	}

}