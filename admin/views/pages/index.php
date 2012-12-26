<div class="well">
	<?php $pages = $tmpl->get('pages',array()); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th> # </th>
				<th> Заголовок </th>
				<th> Имя файла </th>
				<th> Родитель </th>
				<th> Дата публикации </th>
				<th> Статус </th>
				<th> &nbsp; </th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($pages as $page): ?>
			<tr>
				<td> <?php echo $page->getId(); ?> </td>
				<td>
					<?php echo $page->getTitle(); ?>
				</td>
				<td>
					<?php echo $page->getFileName(); ?>
				</td>
				<td>
					<?php 
							$pageParent = $page->createPage(); 
							if($pageParent->exists()){
								echo $pageParent->getTitle();
							}
					?>
				</td>
				<td>
					<?php echo $page->getPubDate()->format('Y/m/d H:i:s');?>
				</td>
				<td>
					<?php echo $page->getMain()?'<span class="label label-info">Главная</span> | ':'';?>
					<?php echo $page->getStatus()?'<span class="label label-success">Включен</span>':'<span class="label label-important">Выключен</span>';?>
				</td>
				<td>
					<a href="<?php echo Page::makeActionUrl('edit',$page); ?>" class="btn btn-info btn-mini">Изменить</a>
					<a href="<?php echo Page::makeActionUrl('delete',$page);?>" class="btn btn-danger btn-mini">Удалить</a>
				</td>
				<td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>