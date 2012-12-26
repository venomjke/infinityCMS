<?php

class ModuleGallery implements IModule{

	static function install()
	{
	}

	static function uninstall(){
	}

	static function info(){
		return array(
			'name' => 'Галерея',
			'version' => '1.0'
		);
	}
}