<!DOCTYPE html>
<html>
<head>
	<title>School view</title>
</head>
<body>
<center>
<?php 
echo "<pre>";
print_r($user);echo"<br>";
echo $user['name'];
echo "</pre>";

?>
	<table border="1">
		<tr>
			<td colspan="5" align="center">
			<h1>User Details Page</h1>
			</td>
		</tr>
		<tr>
			<th>Name</th>
			<th>Email Id</th>
			<th>Phn No</th>
			<th>School Name</th>
		</tr>
		
		<tr>
		 
			<td><?php echo $user['name'];?></td>
			<td><?php echo $user['phn_no'];?></td>
			<td><?php echo $user['email_id'];?></td>
			<td><?php echo $user['address'];?></td>
		
		</tr>
		<tr>
			<td colspan="4" align="center"><b>Teacher List</b><br>
				<a href="<?php echo base_url();?>index.php/school/assign_teac?studentid=<?php echo  $student['id'];?>">Assign</a>
			</td>
		</tr>
		
		<tr>
			<th>Student Name</th>
			<th>Student Phn No</th>
			<th colspan="2">Student Email Id</th>
			
		</tr>
		<?php 
		if(!empty($assigned_student))
		{
			foreach ($assigned_student as  $value) {
			?>
			<tr>
				<td><a href="<?php echo base_url();?>index.php/school/student_details?id=<?php echo $value['studentid'];?>"><?php echo $value['studentname'];?></a></td>
				<td><?php echo $value['phnno'];?></td>
				<td colspan="2"><?php echo $value['email'];?></td>
			</tr>
			<?php
				}
		}
		else
		{
			echo "<tr><td colspan=4><center>No Student assigned</center></td></tr>";
		}

		?>
		
		<tr>
			
		</tr>
		

		</table>
	</center>
</body>
</html>