<?php include dirname(__FILE__)."/../core/admin_config.php";


$action = fRequest::getValid('a',array('login','logout'));

$tmpl->add('css','assets/css/bootstrap.min.css');
$tmpl->add('css','assets/css/style.css');
$tmpl->add('js','assets/js/jquery.min.js');
$tmpl->add('js','assets/js/bootstrap.min.js');
/*
* Обработка входа в систему
*/
if($action == 'login'){
	/*
	* Если пользователь уже залоггинен, то редиректим его на раздел управления страницами
	*/
	if(fAuthorization::checkLoggedIn())fURL::redirect("pages.php");

	/*
	* Поля формы
	*/
	$email = '';
	$password ='';

	if(fRequest::isPost()){
		/*
		* Считываем параметры запроса
		*/
		$email = fRequest::get('email','string');
		$password = fRequest::get('password','string');

		try{
	
			$user = new User(array('email'=>$email));

			if(fCryptography::checkPasswordHash($password,$user->getPassword())){
	      fAuthorization::setUserAuthLevel('admin');
	      fAuthorization::setUserToken($user->getId());
	      fMessaging::create('success','Вы успешно вошли в систему');
	      fURL::redirect(fAuthorization::getRequestedURL(TRUE, BASEURL));			
			}
			fMessaging::create('error','Неверный пароль');			

		}catch(fNotFoundException $e){
			fMessaging::create('error','Пользователя с указанным email не существует');	
		}

	}

	$tmpl->set('email',$email);
	$tmpl->set('password',$password);
	/*
	* Загружаем форму входа
	*/
	renderTemplate($tmpl,ADMINVIEWS."authLayout.php",ADMINVIEWS."login.php");
}


/*
* Обработка выхода из системы
*/
if($action == 'logout' && fAuthorization::checkLoggedIn()){
	fAuthorization::destroyUserInfo();
	fURL::redirect(BASEURL);
}