<div class="container">
    <h1>Progress Tracker</h1>
</div>
<div id="container-fluid">
    <table class="table table-hover">
		<thead>
		<tr>
			<th>Rank</th>
			<th>Name</th>
			<th>Classification</th>
			<?php foreach ($db_badge as $badges): ?>
				<th>
				<?php echo $badges['Badge_Name'];?>
				</th>
			<?php endforeach; ?>
		</tr>
		</thead>
		<?php foreach ($db_cadets as $cadets): ?>
		<tr>
			<td>
				<?php echo $cadets['Rank'];?>
			</td>
			<td>
				<?php echo $cadets['Name'];?>
			</td>
			<td>
				<?php echo $cadets['Classification'];?>
			</td>
			<?php 
				$result = $this->db_model->get_achieved_specific($cadets['Name']);
				foreach ($result as $badge_achieved):
					$level = $badge_achieved['Level'];
					$colour = '';
					if($level == 'Bronze')
					{
						$colour = 'chocolate';
					} 
					else if ($level == 'Grey')
					{
						$colour = '';			
					}
					else
					{
						$colour = $level;
					}
					echo '<td style="background-color:'.$colour.';">';
					if ($level != 'Grey')
					{
						echo $badge_achieved['Date'];
					}
					echo '</td>';
				endforeach;
			?>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<div class="container">
	<a href="/admin/progtrack_edit" class="btn btn-primary" role="button">Edit Mode</a>
</div>
