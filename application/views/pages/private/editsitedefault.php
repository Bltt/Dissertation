<?php echo validation_errors(); ?>


<?php echo form_open('admin/editsitedefault'); ?>

<div id="container">
    <h1>Edit Site</h1>
	<h3>Choose a page to revert to default</h3>
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
				<a href="/admin/editsite" class="btn btn-primary" role="button">Back</a>
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>
	</form>
	<?php echo $result; ?>
</div>
