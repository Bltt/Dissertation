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
		<a href="/admin/userpass" class="btn btn-primary" role="button">Change Passwords</a>
		<a href="/admin/userdelete" class="btn btn-danger" role="button">Delete Account</a>
		<h3>Access Levels</h3>
		<p> 1 - Staff</p>
		<p>	3 - Editor</p>
		<p>	6 - Manager</p>
		<p>	8 - OC</p>
		<p>	9 - Admin</p>
		</div>
    </div>
	<h3>Create User</h3>