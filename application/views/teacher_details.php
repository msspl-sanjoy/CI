<!DOCTYPE html>
<html>
<head>
	<title>School view</title>
</head>

<center>
	<table border="1">
		<tr>
			<td colspan="5" align="center">
			<h1>Teacher Details Page</h1>
			</td>
		</tr>
		<tr>
		<td colspan="5" align="center">
			<form action="<?php echo base_url();?>index.php/admin/school_controller/teacher" method="post">
		       <input type="hidden" name="id" value="<?php echo $teacher['id'];?>">
		       <input type="submit" name="edit" value="Update Profile">
	       </form>Welcome &nbsp;<b><?php user_name($teacher['id'],'T');?></b>
	        <a href="<?php echo base_url();?>index.php/school_controller/logout">Logout</a>
	      </td>
       </tr>
		<tr>
			<th>Name</th>
			<th>Email Id</th>
			<th>Phn No</th>
			<th>Address</th>
			<th>School Name</th>
		</tr>
		
		<tr>
		 
			<td><?php echo $teacher['name'];?></td>
			<td><?php echo $teacher['email'];?></td>
			<td><?php echo $teacher['mobile'];?></td>
			<td><?php echo $teacher['address'];?></td>
			<td><?php echo $teacher['schoolname'];?></td>
		
		</tr>
		<tr>
			<td colspan="5" align="center"><b>Student List</b><br>
				<a href="<?php echo base_url();?>index.php/school_controller/assign?teacherid=<?php echo $teacher['id'];?>">Assign</a>
			</td>
		</tr>
		
		<tr>
			<th>Student Name</th>
			<th>Student Phn No</th>
			<th colspan="2">Student Email Id</th>
			<th colspan="2">Student Address</th>
		</tr>
		<?php 
		if(!empty($assigned_student))
		{
			foreach ($assigned_student as  $value) {
			?>
			<tr>
				<td><?php echo $value['stuname'];?></td>
				<td><?php echo $value['studentmobile'];?></td>
				<td colspan="2"><?php echo $value['studentemail'];?></td>
				<td><?php echo $value['stuaddress'];?></td>
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