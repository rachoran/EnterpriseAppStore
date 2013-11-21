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
		if (!empty($categoriesList)) foreach ($categoriesList as $item) {
			$idCat = (int)$item['Category']['id'];
			$checked = isset($selectedCategories[$idCat]);
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
	    else {
	    ?>
		<tr>
			<td colspan="3" height="60" valign="middle" align="center">
				<p style="margin-top:15px;">No categories were found. Create one <a href="<?= $this->Html->url(array("controller" => 'categories', 'action' => 'edit', 'new')); ?>" title="">here</a> first.</p>
			</td>
		</tr>
	    <?php } ?>
	</tbody>
</table>