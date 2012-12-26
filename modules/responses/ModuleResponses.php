<?php

class ModuleResponses implements IModule{

	static function install(){
	}

	static function uninstall(){
	}

	static function info(){
		return array(
			'name' => 'Отзывы',
			'version' => '1.0'
		);
	}
}