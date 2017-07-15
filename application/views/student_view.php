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
			<h1>Student View Page</h1>
			</td>
		</tr>
		<tr>
			<th>Student Name</th>
			<th>Student Phone No</th>
			<th>Student Email Id</th>
			<th>School Name</th>
			<th>School Address</th>
		</tr>
		<?php
			if(isset($student))
			{
			
				foreach ($student as $row) {
					?>
					<tr>
						<td><a href="<?php echo base_url();?>index.php/school/teacher_details?id=<?php echo $row['id']?>"><?php echo $row['name']?></td>
						<td><?php echo $row['phn_no'];?></td>
						<td><?php echo $row['email_id'];?></td>
						<td><?php echo $row['schoolname'];?></td>
						<td><?php echo $row['schooladdress'];?></td>
					</tr>
					<?php 
				}
			}
		?>
		<tr>
		<td colspan="5" align="center"><b><a href="<?php echo base_url();?>index.php/school/student_insert">Add Student</a></b></td>
		</tr>
		</table>
		</center>
</body>
</html>