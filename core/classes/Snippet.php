<?php

class Snippet extends fActiveRecord{
	
	/**
	 * Путь до папки со страницами
	 *
	 * @return string
	 * @author alex
	 **/
	static function snippetPath()
	{
		return CMS::basePath() . 'snippets/';
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
	static function makeActionUrl($action = 'edit',$snippet)
	{
		switch($action){
			case 'edit':
				return CMS::adminUrl("snippets.php", array('action'=>'edit', 'id'=>$snippet->getId()));
				break;
			case 'delete':
				return CMS::adminUrl('snippets.php', array('action'=>'delete', 'id'=>$snippet->getId()));
				break;
			case 'add':
				return CMS::adminUrl('snippets.php', array('action'=>'add'));
				break;
		}
	}

	/**
	 * Проверка файлов страниц. Если соотвествующие страницам файлы отсутствуют, то система создает их.
	 *
	 * @return void
	 * @author alex
	 **/
	static function checkSnippetsFiles()
	{
		$snippets = fRecordSet::build(__CLASS__);
		//TODO: Удалять файлы(мусор), которые не связаны со страницами в базе.
		foreach($snippets as $snippet){
			if(!file_exists(Snippet::snippetPath() . $snippet->getFileName() . EXT)){
				fFile::create(Snippet::snippetPath() . $snippet->getFileName() . EXT,'');
			}
		}
	}

	/**
	 * Загрузка сниппет
	 *
	 * @return string
	 * @author alex
	 **/
	static function loadSnippet($key)
	{
		$snippet;
		$snippetContent = '';
		try{
			// загрузка по наименованию
			if(is_string($key)){
				$snippet = new Snippet(array('file_name'=>$key));
			// загрузка по идентификатору
			}else if(is_number($key)){
				$snippet = new Snippet($key);
			}	
			$snippetContent = CMS::loadFile(Snippet::snippetPath() . $snippet->getFileName() . EXT);
		}catch(fNotFoundException $e){
			return '';
		}
		return $snippetContent;
	}

	protected function configure()
	{
		
	}
}