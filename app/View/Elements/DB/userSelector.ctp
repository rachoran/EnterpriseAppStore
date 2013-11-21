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
		$x = 0;
		foreach ($usersList as $user) {
			$idUser = $user['User']['id'];
			$checked = isset($selectedUsers[$idUser]);
			$ok = true;
			if (isset($userOnly)) {
				$r = $user['User']['role'];
				if ($r == 'admin' || $r == 'owner') $ok = false;
			}
			if ($ok) {
				$x++;
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
		}
	    if ($x == 0) {
	    ?>
		<tr>
			<td colspan="3" height="60" valign="middle" align="center">
				<p style="margin-top:15px;">No users were found. Create one <a href="<?= $this->Html->url(array("controller" => 'users', 'action' => 'edit', 'new')); ?>" title="">here</a> first.</p>
			</td>
		</tr>
	    <?php } ?>
	</tbody>
</table>