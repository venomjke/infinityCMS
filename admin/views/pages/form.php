<?php $page = $tmpl->get('page'); ?>
<script type="text/javascript">
	$(function(){
		var textArea = document.getElementById('page_content'); 
		var myCodeMirror = CodeMirror.fromTextArea(textArea);
	})
</script>
<div class="well">
	<form action="<?php echo fURL::getWithQueryString(); ?>" method="POST" id="formPage">
		<div class="row">
			<div class="span6">
				<h4> Основное </h4>
				<div>
					<label for="title">Заголовок </label> 
					<input type="text" class="input-block-level" name="title" id="title" value="<?php echo $page->getTitle();?>"/>
				</div>
				<div >
					<label for="file_name">Имя файла </label>
					<input type="text" class="input-block-level" name="file_name" id="file_name" value="<?php echo $page->getFileName();?>" />
				</div>
				<h4> Настройки </h4>
				<div>
					<label class="checkbox inline" for="main">
						<input type="hidden" name="main" value="0" />
					  <input type="checkbox" id="main" name="main" value="1" <?php echo $page->getMain()?'checked="checked"':'';?>>
						Главная
					</label>
				</div>
				<div>
					<label for="status">Статус</label>
					<select class="input-block-level" name="status" id="status">
						<option value="1" <?php echo $page->getStatus()?'selected="selected"':'';?>>Включен</option>
						<option value="0" <?php echo !$page->getStatus()?'selected="selected"':'';?>>Выключен</option>
					</select>
				</div>
				<div>
					<label for="parent_id">Родитель</label>
					<select class="input-block-level" name="parent_id" id="parent_id">
						<option value=""> - Не задано - </option>
						<?php
							$rootPages = Page::getRootPages();
							foreach($rootPages as $rootPage):
								if($rootPage->getId() != $page->getId()):
						?>
						<option value="<?php echo $rootPage->getId();?>" <?php echo $rootPage->getId() == $page->getParentId()?'selected="selected"':''; ?>><?php echo $rootPage->getTitle(); ?></option>
								<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
				<div>
					<label for="layout_id"> Макет </label>
					<select class="input-block-level" name="layout_id" id="layout_id">
						<option value=""> - Не задано - </option>
						<?php 
							$layouts = Layout::findAll();
							foreach($layouts as $layoutObj):
						?>
						<option value="<?php echo $layoutObj->getId();?>" <?php echo $layoutObj->getId() == $page->getLayoutId()?'selected="selected"':''; ?>> <?php echo $layoutObj->getName(); ?> </option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="span5">
				<h4>SEO</h4>
		  	<div>
					<label for="keywords"> Keywords </label>
					<textarea class="input-block-level" name="keywords" id="keywords" rows="5"><?php echo $page->getKeywords();?></textarea>
				</div>
				<div>
					<label for="description"> Description</label>
					<textarea class="input-block-level" name="description" id="description" rows="6"><?php echo $page->getDescription(); ?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span11">
				<h4>Содержимое</h4>
				<div>
					<textarea name="page_content" class="input-block-level" rows="15" id="page_content"><?php echo $tmpl->get('pageContent');?></textarea>
				</div>
			</div>
		</div>
		<div>
			<button class="btn btn-primary" type="submit">Сохранить</button>
			<a href="<?php echo ADMINURL . "pages.php"; ?>" class="btn">Отмена</a>
		</div>
	</form>
</div>