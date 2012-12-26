<div class="well">
	<?php $snippets= $tmpl->get('snippets',array()); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th> # </th>
				<th> Наименование </th>
				<th> Имя файла </th>
				<th> &nbsp; </th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($snippets as $snippet): ?>
			<tr>
				<td> <?php echo $snippet->getId(); ?> </td>
				<td>
					<?php echo $snippet->getName(); ?>
				</td>
				<td>
					<?php echo $snippet->getFileName(); ?>
				</td>
				<td>
					<a href="<?php echo Snippet::makeActionUrl('edit',$snippet); ?>" class="btn btn-info btn-mini">Изменить</a>
					<a href="<?php echo Snippet::makeActionUrl('delete',$snippet);?>" class="btn btn-danger btn-mini">Удалить</a>
				</td>
				<td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>