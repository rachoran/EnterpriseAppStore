<table id="<?php echo $tableName; ?>" class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th width="28">
				<input type="checkbox" onchange="env.toggleAllCheckBoxes('<?php echo $tableName; ?>', this);" class="form-control" />
			</th>
			<th>Group name</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($groupsList as $item) {
			$checked = (int)$item['ApplicationsJoin']['application_id'];
		?>
		<tr>
			<td>
				<input type="checkbox" name="group[<?php echo $item['Group']['id']; ?>]"<?php echo $checked ? ' checked="checked"' : ''; ?> class="form-control" value="1" />
			</td>
			<td><?= $item['Group']['name']; ?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>