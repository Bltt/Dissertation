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
		  <table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Date</th>
					<th>Level</th>
				</tr>
			</thead>
			<?php foreach ($badges_latest as $badges): 
			if ($badges['Level'] != 'Grey')
			{
				$level = $badges['Level'];
				$colour = '';
				if($level == 'Bronze')
				{
					$colour = 'chocolate';
				}
				else
				{
					$colour = $level;
				}
				
				
				echo '<tr>';
					echo '<td>';
						echo $badges['Name'];
					echo '</td>';
					echo '<td>';
						echo $badges['Date'];
					echo '</td>';
					echo '<td style="background-color:'.$colour.';">';
						echo $badges['Level'];
					echo '</td>';
				echo '</tr>';
			}
			endforeach; ?>
		  </table>
		</div>
	</div>
	
</div>