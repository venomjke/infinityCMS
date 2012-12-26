<?php $modules = $tmpl->get('modules');?>
<div class="well">
	<table class="table table-striped">
		<thead>
			<tr>
				<th> Наименование </th>
				<th> Статус </th>
				<th> &nbsp; </th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($modules as $module): ?>
			<tr>
				<td>
					<?php echo $module->getName(); ?>
				</td>
				<td>
					<?php if($module->exists()): ?>
						<?php echo $module->getStatus()?'<span class="label label-success">Активен</span>':'<span class="label label-important">Неактивен</span>';?>
					<?php else: ?>
						<span class="label label-success">Не установлен</span>
					<?php endif ?>
				</td>
				<td>
					<?php if($module->exists()): ?>
						<a href="<?php echo Module::makeActionUrl('uninstall',$module); ?>" class="btn btn-info btn-mini">Удалить</a>
						<?php if($module->getStatus()): ?>
							<a href="<?php echo Module::makeActionUrl('off',$module);?>" class="btn btn-danger btn-mini">Отключить</a>
						<?php else: ?>
							<a href="<?php echo Module::makeActionUrl('on',$module);?>" class="btn btn-danger btn-mini">Включить</a>
						<?php endif;?>
					<?php else: ?>
						<a href="<?php echo Module::makeActionUrl('install',$module);?>" class="btn btn-info btn-mini">Установить</a>
					<?php endif; ?>
				</td>
				<td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>