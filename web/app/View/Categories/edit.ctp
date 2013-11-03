<?php

// Breadcrumbs
$this->Html->addCrumb('Categories', '/categories');
$this->Html->addCrumb('Editing '.$category['Category']['name'].' Category', '/categories/edit/'.$category['Category']['id'].'/'.$category['Category']['name']);

if (!isset($category['Category'])) $category['Category'] = array('id'=>0, 'name'=>'', 'description'=>'', 'icon'=>'');
$id = (int)$category['Category']['id'];

?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<form action="<?php echo $this->Html->url(array("controller" => "categories", "action" => "edit", $category['Category']['id'], $category['Category']['name'])); ?>" method="post" role="form" class="form-horizontal">
				<h3 class="form-title form-title-first"><i class="icon-list-ul"></i> <?php echo $id ? 'Edit category "'.$category['Category']['name'].'"' : 'Create category'; ?></h3>
				<div class="form-group">
					<label class="col-md-4 control-label">Name</label>
					<div class="col-md-8">
						<input type="text" name="name" class="form-control" placeholder="Category name" value="<?php echo $category['Category']['name']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Description</label>
					<div class="col-md-8">
						<textarea type="text" name="description" class="form-control description" placeholder="Category description"><?php echo $category['Category']['description']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Icon</label>
					<div class="col-md-8">
						<input type="text" name="icon" class="form-control icon pull-right" placeholder="icon-camera-retro" value="<?php echo $category['Category']['icon']; ?>" />
						<i class="fa <?php echo $category['Category']['icon']; ?> pull-left icon-preview"></i>
						<small><a href="http://fontawesome.io/3.2.1/icons/" target="_blank">Font Awesome icon list</a></small>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<a href="<?php echo $this->Html->url('/categories', true); ?>" class="btn btn-default">Cancel</a>
						<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
						<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>