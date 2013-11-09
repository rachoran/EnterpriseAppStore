<?php

?><table id="<?php echo $tableName; ?>" class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th width="28">
				<input type="checkbox" onchange="env.toggleAllCheckBoxes('<?php echo $tableName; ?>', this);" class="form-control" />
			</th>
			<th>Category name</th>
			<th width="46">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($categoriesList as $item) {
			$checked = (int)$item['ApplicationsJoin']['application_id'];
		?>
		<tr>
			<td>
				<input type="checkbox" name="category[<?php echo $item['Category']['id']; ?>]"<?php echo $checked ? ' checked="checked"' : ''; ?> class="form-control" />
			</td>
			<td><?= $item['Category']['name']; ?></td>
			<td class="center">
				<i class="fa <?= $item['Category']['icon']; ?>"></i>
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>