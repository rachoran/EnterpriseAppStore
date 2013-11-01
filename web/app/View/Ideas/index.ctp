<?php
// TODO: Pre-fill data from logged in user
?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<form action="<?php echo $this->Html->url(array("controller" => "ideas", "action" => "index")); ?>" method="post" role="form" class="form-horizontal">
				<h3 class="form-title form-title-first"><i class="icon-comment"></i> Do you have an idea for improvement?</h3>
				<div class="form-group">
					<label class="col-md-4 control-label">Full Name</label>
					<div class="col-md-8">
						<input type="text" name="idea[fullname]" class="form-control" placeholder="John Doe" value="<?php //echo $user['User']['fullname']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Email</label>
					<div class="col-md-8">
						<input type="text" name="idea[email]" class="form-control" placeholder="john.doe@example.com" value="<?php //echo $user['User']['email']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Area of suggestions</label>
					<div class="col-md-8">
						<select class="form-control" name="idea[area]">
							<option value="0">Usability improvement</option>
							<option value="1">HTML &amp; CSS</option>
							<option value="2">PHP</option>
							<option value="3">Other</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Description</label>
					<div class="col-md-8">
						<textarea type="text" name="idea[message]" class="form-control description large" placeholder="It would be great if this site could make me a coffee"><?php //echo $group['Group']['description']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-4 col-md-8">
						<button type="submit" class="btn btn-primary pull-right">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>