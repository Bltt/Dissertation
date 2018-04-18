<div class="container">
    <h1>Progress Tracker</h1>
</div>
<div id="container">
<div id="container">
    <table class="table table-hover">
		<thead>
		<tr>
			<th>Name</th>
			<th>Badge</th>
			<th>Date Achieved</th>
			<th>Actions</th>
		</tr>
		</thead>
		<?php foreach ($db as $tracker): ?>
		<tr>
			<td>
				<?php echo $tracker['name']; ?>
			</td>
			<td>
				<?php echo $tracker['badge']; ?>
			</td>
			<td>
				<?php echo $tracker['level']; ?>
			</td>
			<td>
				<?php echo $tracker['date']; ?>
			</td>
			<td>
				<?php echo $tracker['reason']; ?>
			</td>
</div>
