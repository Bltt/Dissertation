<div id="container">
    <div id="body">
    <table>
		<tr>
			<th>Name</th>
			<th>Date</th>
			<th>Reason</th>
		</tr>
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
		</tr>
		<?php endforeach; ?>
    </div>
</div>
