<?php

class ModuleNews implements IModule{

	static function install()
	{
	}

	static function uninstall(){
	}

	static function info(){
		return array(
			'name' => 'Новости',
			'version' => '1.0'
		);
	}
}