<?php $snippet = $this->get('snippet');?>
<ul class="inline">
	<li><a href="<?php echo CMS::adminUrl('snippets.php');?>" class="btn"><i class="icon-list"></i>Список</a></li>
	<li><a href="<?php echo Snippet::makeActionUrl('add',$snippet);?>" class="btn btn-info"><i class="icon-plus"></i> Добавить</a></li>
</ul>