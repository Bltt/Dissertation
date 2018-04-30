<div id="container">
<h1>Join Us!</h1>
    <div class="row">
		<div class="col-lg-10">
		<?php echo validation_errors(); ?>

		<?php echo form_open('pages/join'); ?>
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
				<label class="control-label col-sm-2" for="info">Age:</label>
				<?php 
				$options = array(
							'12'		=> '12',
							'13'		=> '13',
							'14'		=> '14',
							'15'		=> '15',
							'16'		=> '16',
							'17'		=> '17',
							'18'		=> '18',
					);
				$info = 'class="form-control"';
				echo form_dropdown('age', $options, '', $info);?>				
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="info">School Year:</label>
				<?php 
				$options = array(
							'8'			=> 'Year 8',
							'9'			=> 'Year 9',
							'10'		=> 'Year 10',
							'11'		=> 'Year 11',
							'12'		=> 'Year 12',
							'13'		=> 'Year 13',
							'Uni'		=> 'Uni Student',
							'Working'	=> 'Working',
					);
				$info = 'class="form-control"';
				echo form_dropdown('year', $options, '', $info);?>				
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
