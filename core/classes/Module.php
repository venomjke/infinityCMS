<?php

class Module extends fActiveRecord{
	/**
	 * Путь до папки с модулями
	 *
	 * @return string
	 * @author alex
	 **/
	static function modulePath()
	{
		return CMS::basePath() . 'modules/';
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

		// Просматриваем все папки в директории "modules" 
		// сопоставляя имена с теми, которые записаны в базе
		// если какой-то модуль не установлен, то он будет создан как простой объект
		$modulesDir = fFilesystem::createObject(Module::modulePath());
		$modulesInfo = $modulesDir->scan();
		$modules = array();

		foreach($modulesInfo as $moduleInfo){
			if(is_dir($moduleInfo->getPath())){
				try{
					$module = new Module(array('path'=>$moduleInfo->getName()));
					array_push($modules,$module);
				}catch(fNotFoundException $e){
					// загружаем описание модуля
					$moduleFile = $moduleInfo->getPath() . "Module" . ucfirst($moduleInfo->getName()) . EXT;
					if(file_exists($moduleFile)){
						include $moduleFile;

						$moduleClass = "Module" . ucfirst($moduleInfo->getName());
						$info = $moduleClass::info();
						$module = new Module();
						$module->setName($info['name']);
						$module->setPath($moduleInfo->getName());
						$module->setStatus(0);
						array_push($modules,$module);
					}
				}	
			}
		}
		return $modules;
	}

	/**
	* Формирование Action Url
	*/
	static function makeActionUrl($action = 'edit',$module)
	{
		switch($action){
			case 'edit':
				return CMS::adminUrl("modules.php", array('action'=>'edit', 'id'=>$module->getId()));
				break;
			case 'uninstall':
				return CMS::adminUrl('modules.php', array('action'=>'uninstall', 'id'=>$module->getId()));
				break;
			case 'install':
				return CMS::adminUrl('modules.php', array('action'=>'install','path'=>$module->getPath(),'name'=>$module->getName()));
				break;
			case 'on':
				return CMS::adminUrl('modules.php', array('action'=>'on','id'=>$module->getId()));
				break;
			case 'off':
				return CMS::adminUrl('modules.php', array('action'=>'off','id'=>$module->getId()));
				break;	
		}
	}

	/**
	 * Установка модуля
	 *
	 * @return void
	 * @author alex
	 **/
	static function install($module)
	{
		$modulePath = $module->getPath();
		$moduleClass= "Module" . $module->getName();
		$moduleFile = Module::modulePath() . $module->getPath() . $moduleClass;
		
		if(file_exists($moduleFile)){
			include $moduleFile;
			$moduleClass::install();
		}
	}

	/**
	 * Удаление модуля
	 *
	 * @return void
	 * @author alex
	 **/
	static function uninstall($module)
	{
		$modulePath = $module->getPath();
		$moduleClass= "Module" . $module->getName();
		$moduleFile = Module::modulePath() . $module->getPath() . $moduleClass;
		
		if(file_exists($moduleFile)){
			include $moduleFile;
			$moduleClass::uninstall();
		}	
	}

	/**
	 * Загрузка модуля с вызовом определенного метода $action и передачей параметров $args
	 *
	 * @return string
	 * @author alex
	 **/
	static function loadModule($path,$action='index',$args=array())
	{
		try{
			$module = new Module(array('path'=>$path));
			$moduleClass = "Module" . ucfirst($module->getPath());	
			$moduleFile = Module::modulePath() . $module->getPath() . "/" . $moduleClass . EXT;
			include $moduleFile;
			$moduleObj = new $moduleClass(); 

			if(method_exists($moduleObj, $action)){
				return $moduleObj->$action($args);
			}else if(method_exists($moduleObj,'index')){
				return $moduleObj->index($args);
			};

		}catch(fNotFoundException $e){

		}catch(fExpectedException $e){

		}
		return '';
	}
}