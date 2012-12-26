<?php

/**
 * Интерфейс модуля CMS
 *
 * @author alex
 **/
interface IModule
{
	static function install();

	static function uninstall();

	static function info();
} // END interface IModule