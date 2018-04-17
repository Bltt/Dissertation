<?php echo validation_errors(); ?>


<?php echo form_open('admin/editpage'); ?>

<div id="container">
    <h1>Edit Site</h1>
	<h3>Edit Page</h3>
	<form class="form-horizontal" action="#">
		<div class="form-group">
		<label class="control-label col-sm-2" for="page">Content:</label>
			<div class="col-sm-10">
				<textarea class="form-control" id="contenteditor" rows="5">
				
					<?php echo $content; ?>
					
				</textarea>
			</div>	
		</div>
		<div class="form-group"> 
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>
	</form>
</div>
