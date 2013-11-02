<?php

?><table id="<?php echo $tableName; ?>" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th width="28">
				<input type="checkbox" onchange="toggleAllCheckBoxes('<?php echo $tableName; ?>', this);" />
			</th>
			<th>User name</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($usersList as $user) {
			$checked = (int)$user['GroupJoin']['group_id'];
		?>
		<tr>
			<td>
				<input type="checkbox" name="<?php echo $tableName.'['.$user['User']['id'].']'; ?>"<?php echo $checked ? ' checked="checked"' : ''; ?> />
			</td>
			<td><?php echo $user['User']['fullname']; ?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>