<table id="userTable" class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th width="28">
				<input type="checkbox" onchange="env.toggleAllCheckBoxes('userTable', this);" class="form-control" />
			</th>
			<th>User name</th>
			<th width="46">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($usersList as $user) {
			$idUser = $user['User']['id'];
			$checked = isset($selectedUsers[$idUser]);
		?>
		<tr>
			<td>
				<input type="checkbox" name="data[User][User][]"<?= $checked ? ' checked="checked"' : ''; ?> id="UserUser<?= $idUser; ?>" class="form-control" value="<?= $idUser; ?>" />
			</td>
			<td><?= $user['User']['lastname'].', '.$user['User']['firstname'].' <small>('.$user['User']['username'].')</small>'; ?></td>
			<td class="center">
				<img src="<?= $user['User']['gravatar_url']; ?>?s=68" alt="<?= $user['User']['lastname'].', '.$user['User']['firstname']; ?>" class="icon" />
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>