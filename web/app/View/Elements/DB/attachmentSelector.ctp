<?php

?><table id="<?php echo $tableName; ?>" class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th width="28">
				<input type="checkbox" onchange="env.toggleAllCheckBoxes('<?php echo $tableName; ?>', this);" class="form-control" />
			</th>
			<th>Attachment</th>
			<th width="46">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($attachmentsList as $item) {
			//$checked = (int)$item['CategoryJoin']['group_id'];
			$checked = null;
		?>
		<tr>
			<td>
				<input type="checkbox" name="user[<?php echo $item['Attachment']['id']; ?>]"<?php echo $checked ? ' checked="checked"' : ''; ?> class="form-control" />
			</td>
			<td><?= $item['Attachment']['name']; ?></td>
			<td class="center">
				<i class="fa <?= $item['FiletypesJoin']['icon']; ?>"></i>
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>