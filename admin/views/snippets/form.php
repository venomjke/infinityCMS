<script type="text/javascript">
	$(function(){
		var textArea = document.getElementById('snippet_content'); 
		var myCodeMirror = CodeMirror.fromTextArea(textArea);
	})
</script>
<div class="well">
	<form action="<?php echo fURL::getWithQueryString(); ?>" method="POST" id="formPage">
		<div class="row">
			<div class="span11">
				<h4> Основное </h4>
				<div>
					<label for="name">Наименование</label> 
					<input type="text" class="input-block-level" name="name" id="name" value="<?php echo $tmpl->get('snippet')->getName();?>"/>
				</div>
				<div>
					<label for="file_name">Имя файла</label>
					<input type="text" class="input-block-level" name="file_name" id="file_name" value="<?php echo $tmpl->get('snippet')->getFileName();?>" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span11">
				<h4>Содержимое</h4>
					<textarea id="snippet_content" name="snippet_content" class="input-block-level" rows="15"><?php echo $tmpl->encode('snippetContent');?></textarea>
				</div>
			</div>
		</div>
		<div>
			<button class="btn btn-primary" type="submit">Сохранить</button>
			<a href="<?php echo CMS::adminUrl('snippets.php'); ?>" class="btn">Отмена</a>
		</div>
	</form>
</div>