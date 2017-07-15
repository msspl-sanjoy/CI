<!DOCTYPE html>
<html>
<head>
	<title>School view</title>
</head>
<body>
<center>
	<table border="1">
		<tr>
			<td colspan="4" align="center">
			<h1>School View Page</h1>
			</td>
		</tr>
		<tr>
			<th>School Name</th>
			<th>School Address</th>
			<th >School Phone No</th>
			<th>Action</th>
		</tr>
		<?php
			if(isset($record))
			{
			
				foreach ($record as $row) {
					?>
					<tr>
					<?php 
					$id=$row['id'];
					?>
						<td><a href="<?php echo base_url();?>index.php/admin/school_controller/school_view?id=<?php echo $id;?> "><?php echo $row['name']?></a></td>
						<td><?php echo $row['address'];?></td>
						<td><?php echo $row['phn_no'];?></td>
						<td>
						<form action="<?php echo base_url();?>index.php/admin/school_controller/school" method="post">
					       <input type="hidden" name="id" value="<?php echo $row['id'];?>">
					       <input type="submit" name="edit" value="Edit">
					   </form></td>
					</tr>
					<?php 
				}
			}
		?>
		
		</table>
		</center>
</body>
</html>