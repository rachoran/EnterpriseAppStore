<div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<form action="<?php echo $this->Html->url(array("controller" => "settings", "action" => "index")); ?>" method="post" role="form" class="form-horizontal">
				<h3 class="form-title form-title-first"><i class="icon-list-ul"></i> Create shit</h3>
				<div class="form-group">
					<label class="col-md-4 control-label">Name</label>
					<div class="col-md-8">
						<input type="text" name="name" class="form-control" placeholder="Category name" value="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Description</label>
					<div class="col-md-8">
						<textarea type="text" name="description" class="form-control description" placeholder="Category description"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Icon</label>
					<div class="col-md-8">
						<input type="text" name="icon" class="form-control icon pull-right" placeholder="icon-camera-retro" value="" />
						<i class="fa icon-user pull-left icon-preview"></i>
						<small><a href="http://fontawesome.io/3.2.1/icons/" target="_blank">Font Awesome icon list</a></small>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<a href="<?php echo $this->Html->url('/settings', true); ?>" class="btn btn-default">Cancel</a>
						<button type="submit" name="save" class="btn btn-primary pull-right">Save &amp; close</button>
						<button type="submit" name="apply" class="btn btn-primary pull-right">Apply</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>