<div class="container">
    <h1>Progress Tracker</h1>
</div>
<div id="container">
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
				$sql = 'SELECT * FROM progress_achieved WHERE Name='.$this->db->escape($cadets['Name']).' ORDER BY Badge_Name;';
				$query = $this->db->query($sql);
				$result = $query->result_array();
				foreach ($result as $badge_achieved):
					echo '<td>';
					echo $badge_achieved['Date'];
					echo '<br>';
					echo $badge_achieved['Level'];
					echo '</td>';
				endforeach;
			?>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
