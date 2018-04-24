<div id="container">
<h1>Dashboard</h1>
    <div class="row">
		<div class="col-6">
		<h3>Today's LOA's</h3>
		  <table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Date</th>
					<th>Reason</th>
				</tr>
			</thead>
			<?php foreach ($loa as $loa_item): ?>
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
		<div class="col-6">
		<h3>Latest Badges</h3>
		ye
		</div>
	</div>
	
</div>