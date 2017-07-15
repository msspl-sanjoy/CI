<!DOCTYPE html>
<html>
<head>
	<title>This is Registration Page</title>
</head>
<body>
<center>
	<form action="<?php echo base_url();?>index.php/school_controller/registration_action" method="post">

		<table border="1">
				<?php echo validation_errors(); ?>
					<tr>
						<td colspan="2" align="center">
							<h3>Registration Page</h3></td>
					</tr>
					<tr>
						<td> User </td>
						<td><select name='utype'>
								<option value="">Select Any</option>
								<option value="s">Student</option>
								<option value="t">Teacher</option>
							</select>
						</td>
					<tr>
						<td>Name</td>
						<td><input type="text" name="name"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="add"></td>
					</tr>
					<tr>
						<td>Email Id</td>
						<td><input type="text" name="eml_id"></td>
					</tr>
					<tr>
						<td>Mobile</td>
						<td><input type="Mobile" name="mob"></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><input type="text" name="uname"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="pass"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
						<input type="submit" name="submit" value="Register"></td>
					</tr>
					
		</table>
	</form>
</center>
</body>
</html>