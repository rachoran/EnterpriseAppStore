<?php

?><table id="<?php echo $tableName; ?>" class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th width="28">
				<input type="checkbox" onchange="env.toggleAllCheckBoxes('<?php echo $tableName; ?>', this);" class="form-control" />
			</th>
			<th>User name</th>
			<th width="46">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($usersList as $user) {
			$checked = (int)$user['GroupJoin']['group_id'];
		?>
		<tr>
			<td>
				<input type="checkbox" name="user[<?php echo $user['User']['id']; ?>]"<?php echo $checked ? ' checked="checked"' : ''; ?> class="form-control" />
			</td>
			<td><?php echo (empty($user['User']['fullname']) ? $user['User']['username'] : $user['User']['fullname'].' <small>('.$user['User']['username'].')</small>'); ?></td>
			<td class="center">
				<img src="<?php echo $user['User']['gravatar_url']; ?>?s=68" alt="<?php echo $user['User']['fullname']; ?>" class="icon" />
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>