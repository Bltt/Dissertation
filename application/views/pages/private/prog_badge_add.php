<div class="container">
    <h1>Progress Tracker</h1>
	<h3>Add Cadet</h3>
</div>
<div id="container-fluid" class="row">
    <table class="table table-hover">
		<thead>
		<tr>
			<th>Name</th>
			<th>ID</th>
		</tr>
		</thead>
		<?php foreach ($db_badge as $badges): ?>
			<tr>
				<th>
				<?php echo $badges['Badge_Name'];?>
				</th>
				<th>
				<?php echo $badges['Badge_ID'];?>	
				</th>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
    <?php echo validation_errors(); ?>
<?php echo form_open('admin/progbadgeadd'); ?>
<div class="row">
		<div class="col-lg-10">
		  <form class="form-horizontal" action="#">
			<div class="form-group">
				<label class="control-label col-sm-2" for="badge">Badge name:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="badge" placeholder="Enter name">
				</div>
			</div>
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<a href="/admin/progtrack_edit" class="btn btn-primary" role="button">Back</a>
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</div>
		  </form>
		</div>
	</div>