<div class="container">
    <h1>Leave of Absence's</h1>
</div>
<div id="container">
    <div id="body">
	<?php echo validation_errors(); ?>

	<?php echo form_open('admin/loa'); ?>
    <table class="table table-hover">
		<thead>
		<tr>
			<th>Name</th>
			<th>Date</th>
			<th>Reason</th>
			<th>Actions</th>
		</tr>
		</thead>
		<?php foreach ($db as $loa_item): ?>
		<tr>
			<td>
				<?php echo $loa_item['name']; ?>
			</td>
			<td>
				<?php echo $loa_item['date']; ?>
			</td>
			<td>
				<?php echo $loa_item['reason']; ?>
			</td>
			<td>
				<?php echo form_hidden('ID', $loa_item['id']);?>
				<button type="submit" id="ID" value="<?php echo $loa_item['id'];?>" class="btn btn-danger">Archive</button>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	</form>
	<a href="/admin/archivedloa" class="btn btn-primary" role="button">View Archived</a>
    </div>
</div>
