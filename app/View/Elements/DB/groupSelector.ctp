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
		if (!empty($groups)) foreach ($groups as $idGroup=>$name) {
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
	    else {
	    ?>
		<tr>
			<td colspan="3" height="60" valign="middle" align="center">
				<p style="margin-top:15px;">No groups were found. Create one <a href="<?= $this->Html->url(array("controller" => 'groups', 'action' => 'edit', 'new')); ?>" title="">here</a> first.</p>
			</td>
		</tr>
	    <?php } ?>
	</tbody>
</table>
