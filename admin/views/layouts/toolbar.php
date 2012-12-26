<?php $layout = $this->get('layout');?>
<ul class="inline">
	<li><a href="<?php echo CMS::adminUrl('layouts.php');?>" class="btn"><i class="icon-list"></i>Список</a></li>
	<li><a href="<?php echo Layout::makeActionUrl('add',$layout);?>" class="btn btn-info"><i class="icon-plus"></i> Добавить</a></li>
</ul>