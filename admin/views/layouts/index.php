<div class="well">
	<?php $layouts = $tmpl->get('layouts',array()); ?>
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
		<?php foreach($layouts as $l): ?>
			<tr>
				<td> <?php echo $l->getId(); ?> </td>
				<td>
					<?php echo $l->getName(); ?>
				</td>
				<td>
					<?php echo $l->getFileName(); ?>
				</td>
				<td>
					<a href="<?php echo Layout::makeActionUrl('edit',$l); ?>" class="btn btn-info btn-mini">Изменить</a>
					<a href="<?php echo Layout::makeActionUrl('delete',$l);?>" class="btn btn-danger btn-mini">Удалить</a>
				</td>
				<td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>