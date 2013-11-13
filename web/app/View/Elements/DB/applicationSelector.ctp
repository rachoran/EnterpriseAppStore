<table id="applicationTable" class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th width="28">
				<input type="checkbox" onchange="env.toggleAllCheckBoxes('applicationTable', this);" class="form-control" />
			</th>
			<th>Application name</th>
			<th width="46">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($applicationsList as $app) {
			$checked = isset($selectedApplications[$app['Application']['id']]);
		?>
		<tr>
			<td>
				<input type="checkbox" name="data[Application][Application][]"<?= $checked ? ' checked="checked"' : ''; ?> id="ApplicationApplication<?= $app['Application']['id']; ?>" class="form-control" value="<?= $app['Application']['id']; ?>" />
			</td>
			<td><?php echo $app['Application']['name']; ?> <small>(<?php echo $app['Application']['version']; ?>)</small></td>
			<td class="center">
				<img src="<?= Storage::urlForIconForAppWithId($app[0]['id'], $app[0]['location']).'?t='.time(); ?>" alt="<?= $app[0]['name']; ?>" class="icon" />
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>


