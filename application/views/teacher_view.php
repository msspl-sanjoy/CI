<!DOCTYPE html>
<html>
<head>
	<title>School view</title>
</head>
<body>
<center>
	<table border="1">
		<tr>
			<td colspan="5" align="center">
			<h1>Teacher View Page</h1>
			</td>
		</tr>
		<tr>
			<th>Teacher Name</th>
			<th>Teacher Phone No</th>
			<th>Teacher Email Id</th>
			<th>School Name</th>
			<th>School Address</th>
		</tr>
		<?php
			
			if(isset($record))
			{
			
				foreach ($record as $row) {
					?>
					<tr>
						<td><a href="<?php echo base_url();?>index.php/school/teacher_details?id=<?php echo $row['id'];?>"><?php echo $row['name']?></a></td>
						<td><?php echo $row['phn_no'];?></td>
						<td><?php echo $row['email_id'];?></td>
						<td><?php echo $row['schoolname'];?></td>
						<td><?php echo $row['schooladdress'];?></td>
					</tr>
					<?php 
				}
			}
		?>
		</table>
		</center>
</body>
</html>