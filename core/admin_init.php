<?php // загрузчик для admin панели
include dirname(__FILE__) . "/admin_config.php";

fAuthorization::requireAuthLevel('admin');

$user = new User(fAuthorization::getUserToken());

$tmpl->add('css','assets/css/bootstrap.min.css');
$tmpl->add('css','assets/css/style.css');
// $tmpl->add('css','assets/css/codemirror.css');
$tmpl->add('css','assets/codemirror/lib/codemirror.css');

$tmpl->add('js','assets/js/jquery.min.js');
$tmpl->add('js','assets/js/bootstrap.min.js');
$tmpl->add('js','assets/js/common.js');
// $tmpl->add('js','assets/js/codemirror.min.js');
$tmpl->add('js','assets/codemirror/lib/codemirror.js');
$tmpl->add('js','assets/codemirror/lib/util/matchbrackets.js');
$tmpl->add('js','assets/codemirror/mode/php/php.js');
$tmpl->add('js','assets/codemirror/mode/htmlmixed/htmlmixed.js');
$tmpl->add('js','assets/codemirror/mode/xml/xml.js');
$tmpl->add('js','assets/codemirror/mode/javascript/javascript.js');
$tmpl->add('js','assets/codemirror/mode/css/css.js');
$tmpl->add('js','assets/codemirror/mode/clike/clike.js');
$tmpl->set('navbar','common/navbar.php');

$tmpl->set('user',$user);
