<?php echo validation_errors(); ?>

<div class="container">
    <h1>User Accounts</h1>
	<h3>Delete User</h3>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-10">      
		  <table class="table table-hover">
			<thead>
			<tr>
				<th>Name</th>
				<th>Level</th>
				<th>Last Login</th>
			</tr>
			</thead>
			<?php foreach ($db as $user_info): ?>
			<tr>
				<td>
				<?php echo $user_info['username']; ?>
				</td>
				<td>
				<?php echo $user_info['auth_level']; ?>
				</td>
				<td>
				<?php echo $user_info['last_login']; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		  </table>
		</div>	
		<div class="col-lg-2">
		<a href="/admin/users" class="btn btn-danger" role="button">Back</a>
		<h3>Access Levels</h3>
		<p> 1 - Staff</p>
		<p>	3 - Editor</p>
		<p>	6 - Manager</p>
		<p>	8 - OC</p>
		<p>	9 - Admin</p>
		</div>	
    </div>
	<div class="row">
		<div class="col-lg-10">
		<?php echo form_open('admin/userpass'); ?>
		  <form class="form-horizontal" action="#">
			<div class="form-group">
				<label class="control-label col-sm-2" for="username">Username:</label>
				<div class="col-sm-10">
					<select class="form-control" name="username" id="username">
					<?php
					foreach ($db as $user_info):
						echo "<option>";
						echo $user_info['username'];
						echo "</option>";
					endforeach;					
					?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="password">Password:</label>
				<div class="col-sm-10"> 
				<input type="password" class="form-control" name="password" placeholder="Enter password">
				</div>
			</div>
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Change Pass</button>
				</div>
			</div>
		  </form>	
		  <?php echo $result; ?>
		</div>
	</div>