<!DOCTYPE html>
<html>
<head>
	<title>This is Doctor Page</title>
</head>
<body>
<?php
//print_r($results);
?>
<center>
	<h1><u><?php echo $this->lang->line('doctor_list');?></u></h1>
	<table border="1">
		<tr>
			<th>Doctor Name</th>
			<th>Mobile</th>
			<th>Qualification</th>
			<th>Department</th>
			<th>Day</th>
			<th>From</th>
			<th>To</th>
		</tr>
	<?php 
	if(isset($results))
	{
		foreach ($results as $data) {
			?>
			<tr>
				<td><?php echo $data->name ?></td>   
				<td><?php echo $data->mobile ?></td>
				<td><?php echo $data->qualification ?></td>
				<td><?php echo $data->deptname ?></td>
				<td><?php echo $data->day ?></td>
				<td><?php echo date('h A', strtotime($data->fromtime)) ?></td>
				<td><?php echo date('h A', strtotime($data->totime)) ?></td>
				
			</tr>
			<?php
			
		}
	}

	?>
	 <tr>
      <td colspan="7"><center><p><?php echo $links; ?></p></center></td></tr>
	</table>
</center>
</body>
</html>