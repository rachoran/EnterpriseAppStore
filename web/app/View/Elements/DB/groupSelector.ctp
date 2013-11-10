<table id="groupTable" class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th width="28">
				<input type="checkbox" onchange="env.toggleAllCheckBoxes('groupTable', this);" class="form-control" />
			</th>
			<th>Group name</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($groups as $idGroup=>$name) {
			$checked = isset($selectedGroups[$idGroup]);
		?>
		<tr>
			<td>
				<input type="checkbox" name="data[Group][Group][]"<?php echo $checked ? ' checked="checked"' : ''; ?> id="GroupGroup<?= $idGroup; ?>" class="form-control" value="<?= $idGroup; ?>" />
			</td>
			<td><?= $name; ?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
