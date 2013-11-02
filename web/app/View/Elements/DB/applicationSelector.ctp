<?php

?><table id="<?php echo $tableName; ?>" class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th width="28">
				<input type="checkbox" onchange="toggleAllCheckBoxes('<?php echo $tableName; ?>', this);" />
			</th>
			<th>Application name</th>
			<th width="46">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($applicationsList as $user) {
			$checked = (int)$user['GroupJoin']['group_id'];
		?>
		<tr>
			<td>
				<input type="checkbox" name="<?php echo $tableName.'['.$user['Application']['id'].']'; ?>"<?php echo $checked ? ' checked="checked"' : ''; ?> />
			</td>
			<td><?php echo $user['Application']['name']; ?> <small>(<?php echo $user['Application']['version']; ?>)</small></td>
			<td class="center">
				<img src="http://www.apps.ie/assets/images/developer_images/lemonsplat/CPLjobs_Android_app_icon.png" alt="<?php echo $user['Application']['name']; ?> application icon" class="icon" />
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>