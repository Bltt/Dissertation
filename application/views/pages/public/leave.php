<div id="container">
    <div id="body">
    <?php echo validation_errors(); ?>

	<?php echo form_open('pages/leave'); ?>

    <label for="name">Name</label>
    <textarea name="name"></textarea><br />
	
	<label for="reason">Reason</label>
    <textarea name="reason"></textarea><br />

    <input type="submit" name="submit" value="Submit" />

</form>

    </div>
</div>
