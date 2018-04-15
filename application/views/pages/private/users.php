<div class="container">
    <h1>User Accounts</h1>
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
				<th>Actions</th>
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
				<td>
					<div class="row">
						<div class="col-xs-3">
							<button type="button" class="btn btn-sm btn-danger">Access Level</button>
						</div>
						<div class="col-xs-1"><p> | </p></div>
						<div class="col-xs-3">
							<button type="button" class="btn btn-sm btn-danger">Delete Account</button>
						</div>
					</div>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>	
		</div>	
		<div class="col-lg-2">
		<h3>Access Levels</h3>
		<p> Blah blah shit here</p>
		</div>
    </div>
	<h3>Create User</h3>