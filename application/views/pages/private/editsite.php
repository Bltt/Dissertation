<?php echo validation_errors(); ?>


<?php echo form_open('admin/editsite'); ?>

<div id="container">
    <h1>Edit Site</h1>
	<h3>Choose a page to edit</h3>
	<form class="form-horizontal" action="#">
		<div class="form-group">
		<label class="control-label col-sm-2" for="page">Page:</label>
			<div class="col-sm-10">
				<select class="form-control" name="page">
				<?php foreach ($db as $pages): ?>
					<option>
					<?php 
					if ($pages['PageName'] != 'public')
					{
					echo $pages['PageName']; 
					}
					?>
					</option>
				<?php endforeach; ?>
				</select>
			</div>	
		</div>
		<div class="form-group"> 
			<div class="col-sm-offset-2 col-sm-10">
				<a href="/admin/editsitedefault" class="btn btn-primary" role="button">Revert page to default</a>
				<a href="/admin/upload" class="btn btn-primary" role="button">Upload Image</a>
				<button type="submit" class="btn btn-default">Select</button>
			</div>
		</div>
	</form>
</div>
