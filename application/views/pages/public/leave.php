<div id="container">
    <div id="body">
    <?php echo validation_errors(); ?>

	<?php echo form_open('pages/leave'); ?>
	<h1>Submit Leave</h1>
    <label for="name">Name</label>
	<input type="text" class="form-control" name="name" placeholder="Name"><br />
	
	<label for="reason">Reason</label>
    <input type="text" class="form-control" name="reason" placeholder="Reason"><br />
	
	<label for="reason">Date</label>
    <input type="date" class="form-control" name="date"><br />

    <input type="submit" class="btn btn-default" name="submit" value="Submit" />

</form>

    </div>
</div>
