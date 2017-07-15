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
			<h1>School Details Page</h1>
			</td>
		</tr>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>Phn No</th>
			
		</tr>
		
		<tr>
			<td><?php echo $school['name'];?></td>
			<td><?php echo $school['address'];?></td>
			<td><?php echo $school['phn_no'];?></td>
			
		</tr>
		
		
		<tr>
		<td colspan="3" align="center"><b>Teacher List</b><br>
		<a href="<?php echo base_url();?>index.php/admin/school_controller/teacher?id=<?php echo $school['id'];?> ">Add Teacher</a>
		</td>
		</tr>
		<tr>
			<th>Name</th>
			<th>Phone No</th>
			<th>Email Id</th>
		</tr>
		<?php

		foreach ($teacher as $row) {

			?>
			<tr>
			<td><a href="<?php echo base_url();?>index.php/school/teacher_details?id=<?php echo $row['id'];?> "><?php echo $row['name'];?></a></td>
			<td><?php echo $row['mobile'];?></td>
			<td><?php echo $row['email'];?></td>
			
		</tr>
		<?php
		}
		
		?>
		<tr>
		<td colspan="3" align="center"><b>Student List</b><br>
		<a href="<?php echo base_url();?>index.php/admin/school_controller/student?id=<?php echo $school['id'];?> ">Add Student</a>
		</td>
		</tr>
		<tr>
			<th>Name</th>
			<th>Phone No</th>
			<th>Email Id</th>
		</tr>
		<?php

		foreach ($student as $rowst) {

			?>
			<tr>
			<td><a href="<?php echo base_url();?>index.php/school/student_details?id=<?php echo $rowst['id'];?> "><?php echo $rowst['name'];?></a></td>
			<td><?php echo $rowst['mobile'];?></td>
			<td><?php echo $rowst['email'];?></td>
			
		</tr>
		<?php
		}
		
		?>
		</table>
	</center>
</body>
</html>