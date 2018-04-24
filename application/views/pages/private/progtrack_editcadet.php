<div class="container">
    <h1>Progress Tracker</h1>
	<h3>Edit Cadet</h3>
</div>
<div id="container">
<?php echo form_open('admin/editcadet'); ?>
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
		<?php foreach ($db_cadet as $cadets): ?>
		<tr>
			<td>
				<?php
				$options = array(
							'CDT'		=> 'Cadet',
							'CPL'		=> 'Corporal',
							'SGT'		=> 'Sergeant',
							'FS'		=> 'Flight Sergeant',
							'CWO'		=> 'Cadet Warrant Officer',
					);
				$info = 'class="form-control" style="width: 120px;"';
				echo form_dropdown('rank', $options, $cadets['Rank'], $info);?>
			</td>
			<td>
				<?php 
				$info = 'class="form-control" style="width: 120px;"';
				echo form_input('name', $cadets['Name'], $info);?>
			</td>
			<td>
				<?php
				$options = array(
							'Recruit'		=> 'Recruit',
							'First Class'	=> 'First Class',
							'Leading'		=> 'Leading',
							'Senior'		=> 'Senior',
							'Master'		=> 'Master',
							'Instructor'	=> 'Instructor',
					);
				$info = 'class="form-control"style="width: 120px;"';	
				echo form_dropdown('classification', $options,$cadets['Classification'], $info);?>
			</td>
			<?php 
				$result = $this->db_model->get_achieved_specific($cadets['Name']);
				$i = 1;
				foreach ($result as $badge_achieved):
					$level = $badge_achieved['Level'];
					$colour = '';
					
					$options = array(
							'Grey'		=> 'No Level',
							'Blue'		=> 'Blue',
							'Bronze'	=> 'Bronze',
							'Silver'	=> 'Silver',
							'Gold'		=> 'Gold',
					);
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
					$info = 'class="form-control" style="width: 120px;"';
					echo '<td style="background-color:'.$colour.';">';
						echo form_input('date_'.html_escape($i).'', $badge_achieved['Date'], $info);
						echo '<br>';
						echo form_dropdown('level_'.html_escape($i).'', $options, $level, $info);
					echo '</td>';
					$i++;
				endforeach;
			?>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<div class="container">
	<a href="/admin/progtrack_edit" class="btn btn-primary" role="button">Back</a>
	<button type="submit" class="btn btn-default">Submit</button>
</div>
