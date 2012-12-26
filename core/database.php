<?php 
/*
* Подключаем БД
*/
$scheme   = 'mysql';
$database = 'cms';
$login 	  = 'alex';
$password = '';
$server   = '';

fORMDatabase::attach(
	new fDatabase($scheme,$database,$login,$server)
);

