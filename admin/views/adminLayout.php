<?php fHtml::sendHeader();?><!DOCTYPE html><html>
<head>
	<meta charset="utf8" />
	<base href="<?php echo CMS::adminUrl(); ?>" />
	<title><?php echo $tmpl->prepare('title','No title'); ?></title>
	<?php echo $tmpl->place('css'); ?>
	<?php echo $tmpl->place('js');?>

	<script type="text/javascript">
		function hideAlert(options){
			var defOptions = {
				timeout:3000
			};
			options = $.extend({},defOptions,options);
			setTimeout(function(){$('.alert').alert('close');}, options.timeout);
		}
	</script>
</head>
<body>
		 <div class="main container">
		 <?php echo $tmpl->place('navbar'); ?>
		 	<div class="row">
				<div class="span12">
					<?php echo $tmpl->place('toolbar');?>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<!--
					<ul class="breadcrumb">
					  <li><a href="#">Home</a> <span class="divider">/</span></li>
					  <li><a href="#">Library</a> <span class="divider">/</span></li>
					  <li class="active">Data</li>
					</ul>
				-->
					<?php if(fMessaging::check('success')):?>
					<div class="alert alert-success">
						<a class="close" data-dismiss="alert" href="#">&times;</a>
						<?php fMessaging::show('success');?>
					</div>
					<script type="text/javascript">hideAlert();</script>
					<?php endif; ?>

					<?php if(fMessaging::check('error')):?>
					<div class="alert alert-error">
						<a class="close" data-dismiss="alert" href="#">&times;</a>
						<?php fMessaging::show('error');?>
					</div>
						<script type="text/javascript">hideAlert();</script>
					<?php endif; ?>

				 	<?php echo $tmpl->get('content'); ?>
				 </div>
		 </div>
</body>
</html>