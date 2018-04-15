<div class="container">
    <h1>Leave of Absence's</h1>
</div>
<div id="container">
    <div id="body">
    <table class="table table-hover">
		<thead>
		<tr>
			<th>Name</th>
			<th>Date</th>
			<th>Reason</th>
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
		</tr>
		<?php endforeach; ?>
	</table>
    </div>
</div>
