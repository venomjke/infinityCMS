<?php fHtml::sendHeader();?><!DOCTYPE html><html>
<head>
	<meta charset="utf8" />
	<base href="<?php echo CMS::adminUrl(); ?>" />
	<title><?php echo $tmpl->prepare('title','No title'); ?></title>
	<?php echo $tmpl->place('css'); ?>
	<?php echo $tmpl->place('js');?>
</head>
<body>
		<div class="main container">
		 <?php echo $tmpl->prepare('content'); ?>
		</div>
</body>
</html>