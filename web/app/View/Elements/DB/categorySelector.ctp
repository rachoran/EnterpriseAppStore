<table id="categoriesTable" class="table table-striped table-bordered table-hover selector-table">
	<thead>
		<tr>
			<th width="28">
				<input type="checkbox" onchange="env.toggleAllCheckBoxes('categoriesTable', this);" class="form-control" />
			</th>
			<th>Category name</th>
			<th width="46">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($categoriesList as $item) {
			$idCat = (int)$item['Category']['id'];
			$checked = isset($selectedGroups[$idCat]);
		?>
		<tr>
			<td>
				<input type="checkbox" name="data[Category][Category][]"<?php echo $checked ? ' checked="checked"' : ''; ?> id="CategoryCategory<?= $idCat; ?>" value="<?= $idCat; ?>" class="form-control" />
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