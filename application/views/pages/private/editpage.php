<?php echo validation_errors(); ?>


<div id="container">
    <h1>Edit Site</h1>
	<h3>Edit Page - <?php echo $name;?></h3>
	<?php echo form_open('admin/editpage');?>
		<?php echo form_hidden('name', $name);?>
		<div class="form-group">
		<label class="control-label col-sm-2" for="page">Content:</label>
			<div class="col-sm-10">
				<?php 
				$data = array(
					'name'		=> 'contenteditor',
					'id'		=> 'contenteditor',
					'value'		=> $content,
					'rows'		=> '5',
					'cols'		=> '10',
					'class'		=> 'form-control',
				);
				
				echo form_textarea($data); ?>
			</div>	
		</div>
		<div class="form-group"> 
			<div class="col-sm-offset-2 col-sm-10">
				<a href="/admin/editsite" class="btn btn-danger" role="button">Back</a>
				<button type="submit" class="btn btn-primary float-right">Submit</button>
			</div>
		</div>
	</form>
</div>
