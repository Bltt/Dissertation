<div id="container">
	<h1>Image Upload</h1>
	
	<?php echo $error;?>

	<?php echo form_open_multipart('upload/do_upload');?>


	
	<div class="custom-file">
		<input type="file" name="userfile" class="custom-file-input" id="customFile">
		<label class="custom-file-label" for="customFile">Choose file</label>
	</div>
	<div class="form-group">
		<a href="/admin/editsite" class="btn btn-primary" role="button">Back</a>
		<input class="btn btn-default" type="submit" value="Upload">
	</div>
	
	</form>

</div>
