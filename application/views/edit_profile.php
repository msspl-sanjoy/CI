<!DOCTYPE html>
<html>
<head>
	<title>This is Profile Page</title>
</head>
<body>
<form action="<?php echo base_url();?>index.php/school_controller/edit_teacher_action" method="post">
<center>
	<table border="1">
		<input type="hidden" name="id" value="<?php echo $teacher['id'];?>" >
		<tr>
			<td>Name</td>
			<td><input type="name" name="name" value="<?php echo $teacher['name'];?>"></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="name" name="email" value="<?php echo $teacher['email'];?>"></td>
		</tr>
		<tr>
			<td>Mobile</td>
			<td><input type="name" name="mobile" value="<?php echo $teacher['mobile'];?>"></td>
		</tr>
		<tr>
			<td>Address</td>
			<td><input type="name" name="address" value="<?php echo $teacher['address'];?>"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="submit" value="Update"></td>
		</tr>
	</table>
</center>
</form>
</body>
</html>