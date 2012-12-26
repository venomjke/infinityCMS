<?php $page = $this->get('page');?>
<ul class="inline">
	<li><a href="<?php echo CMS::adminUrl('pages.php');?>" class="btn"><i class="icon-list"></i>Список</a></li>
	<li><a href="<?php echo Page::makeActionUrl('add',$page);?>" class="btn btn-info"><i class="icon-plus"></i> Добавить</a></li>
</ul>