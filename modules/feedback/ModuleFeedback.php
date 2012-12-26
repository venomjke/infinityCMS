<?php

class ModuleFeedback implements IModule{

	static function install(){		
	}

	static function uninstall(){
	}

	static function info(){
		return array(
			'name' => 'Обратная связь',
			'version' => '1.0'
		);
	}

	/*
	* Базовый метод
	*/
	public function index($args=array())
	{
		return 'Модуль feedbacka';
	}

	/*
	* Форма
	*/
	public function form($args=array())
	{
		$emailTo = '';
		$emailFrom = '';

		// Считываем параметры
		if(!empty($args['emailTo'])){
			$emailTo = $args['emailTo'];
		}
		if(!empty($args['emailFrom'])){
			$emailFrom = $args['emailFrom'];
		}

		// Если post запрос, значит отправляем форму
	  if(fRequest::isPost() && $emailTo && $emailFrom){
	  	$fieldName = fRequest::get('field_name','string');
	  	$fieldSubject = fRequest::get('field_subject','string');
	  	$fieldText = fRequest::get('field_text','string');

	  	$email = new fEmail();
	  	$email->addRecipient($emailTo,$fieldName);
	  	$email->setFromEmail($emailFrom);
	  	$email->setSubject($fieldSubject);
	  	$email->setBody($fieldText);
	  	$email->send();
	  }
	  return CMS::loadSnippet('feedbackForm');
	}
}