<div id="container">
<h1>Contact Us!</h1>
    <div class="row">
		<div class="col-lg-10">
		<?php echo validation_errors(); ?>

		<?php echo form_open('pages/contact'); ?>
		  <form class="form-horizontal" action="#">
			<div class="form-group">
				<label class="control-label col-sm-2" for="username">Name:</label>
				<div class="col-10">
					<input type="text" class="form-control" name="name" placeholder="Enter name">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Email:</label>
				<div class="col-10">
					<input type="email" class="form-control" name="email" placeholder="Enter email">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="info">Information:</label>
				<?php 
				$data = array(
					'name'		=> 'info',
					'id'		=> 'info',
					'rows'		=> '5',
					'cols'		=> '10',
					'class'		=> 'form-control',
				);
				
				echo form_textarea($data); ?>
				
			</div>
			
			
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</div>
		  </form>
		</div>
		<div>
		<?php echo $result;?>
		</div>
	</div>
</div>
