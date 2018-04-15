
    <?php echo validation_errors(); ?>

	<?php echo form_open('admin/users'); ?>

<div class="row">
		<div class="col-lg-10">
		  <form class="form-horizontal" action="#">
			<div class="form-group">
				<label class="control-label col-sm-2" for="username">Username:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="username" placeholder="Enter username">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Email:</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" name="email" placeholder="Enter email">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="accesslevel">Access Level:</label>
				<div class="col-sm-10">
					<select class="form-control" name="auth_level">
						<option>1</option>
						<option>3</option>
						<option>6</option>
					</select>
				</div>	
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="passwd">Password:</label>
				<div class="col-sm-10"> 
					<input type="password" class="form-control" name="passwd" placeholder="Enter password">
				</div>
			</div>
			
			
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</div>
		  </form>
		</div>
	</div>