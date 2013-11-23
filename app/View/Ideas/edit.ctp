<?php

// Breadcrumbs
$this->Html->addCrumb('Ideas', '/ideas');
$this->Html->addCrumb('New idea', null);


?><div class="widget">
	<div class="widget-content-white glossed">
		<div class="padded">
			<form action="<?php echo $this->Html->url(array('controller' => 'ideas', 'action' => 'edit')); ?>" method="post" role="form" class="form-horizontal">
				<h3 class="form-title form-title-first"><i class="icon-comment"></i> Do you have an idea for improvement?</h3>
				<div class="form-group">
					<label class="col-md-4 control-label">Full Name</label>
					<div class="col-md-8">
						<input type="text" name="idea[name]" class="form-control" placeholder="John Doe" value="<?php echo $idea['name']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Email</label>
					<div class="col-md-8">
						<input type="text" name="idea[email]" class="form-control" placeholder="john.doe@example.com" value="<?php echo $idea['email']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Area of suggestions</label>
					<div class="col-md-8">
						<?php
						$options = array(1=>'Usability improvement', 2=>'HTML & CSS', 3=>'PHP', 4=>'Other');
						echo $this->Form->input('idea[area]', array('name'=>'idea[area]', 'label' => false, 'options' => $options, 'class'=>'form-control', 'empty' => '(choose one)', 'value'=>(int)$idea['area']));
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Message</label>
					<div class="col-md-8">
						<textarea type="text" name="idea[message]" class="form-control description large" placeholder="It would be great if this site could make me a coffee"><?php echo $idea['message']; ?></textarea>
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