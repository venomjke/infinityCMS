<div class="span4 login">
	<div class="well">
		<form action="<?php echo fURL::getWithQueryString(); ?>" method="POST">
			<fieldset>
				<legend> Вход </legend>
				<?php fMessaging::show('error'); ?>
				<label for="email"> Email </label> 
				<input class="input-block-level" type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $tmpl->prepare('email'); ?>" />
				<label for="password"> Пароль </label>
				<input class="input-block-level" type="password" name="password" id="password" placeholder="Пароль" value="<?php echo $tmpl->prepare('password');?>" /> 
				<br/>
				<button type="submit" class="btn btn-block">Войти</button>
			</fieldset>
		</form>
	</div>
</div>