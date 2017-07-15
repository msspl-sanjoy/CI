<!DOCTYPE html>
<html>
<head>
	<title>This is Doctor Page</title>
</head>
<body>
<?php
//print_r($doctor);
?>
<center>
	<h1><u><?php echo $this->lang->line('doctor_avl');?></u></h1>
	
	<table border="1">
		<tr>
			
			<th>Day</th>
			<th>From</th>
			<th>To</th>
		</tr>
	<?php 
	if(isset($doctor))
	{
		foreach ($doctor as $data) {
			?>
			<tr>
				
				<td><?php echo $data->day ?></td>
				<td><?php echo date('h A', strtotime($data->fromtime)) ?></td>
				<td><?php echo date('h A', strtotime($data->totime)) ?></td>
				
			</tr>
			<?php
			
		}
	}

	?>
	
	</table>
</center>
</body>
</html>