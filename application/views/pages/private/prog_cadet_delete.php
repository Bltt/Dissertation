<div class="container">
    <h1>Progress Tracker</h1>
	<h3>Add Cadet</h3>
</div>
<div id="container-fluid" class="row">
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
    <?php echo validation_errors(); ?>
<?php echo form_open('admin/progcadetdelete'); ?>
<div class="row">
		<div class="col-lg-10">
		  <form class="form-horizontal" action="#">
			<div class="form-group">
				<label class="control-label col-sm-2" for="name">Name:</label>			
				<select class="form-control" id="name" name="name">
				<?php foreach ($db_cadets as $cadets):
					echo '<option>';
					echo $cadets['Name'];
					echo '</option>';
				endforeach; ?>
				</select>
			</div>			
			
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<a href="/admin/progtrack_edit" class="btn btn-primary" role="button">Back</a>
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</div>
		  </form>
		</div>
	</div>