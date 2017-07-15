<!DOCTYPE html>
<html>
<head>
	<title>This is Login Page</title>
</head>
<body>
<center>
	<form action="<?php echo base_url();?>index.php/admin/school_controller/login_action" method="post">

		<table border="1">
		<?php echo validation_errors(); ?>
		<tr>
			<td colspan="2" align="center">
				<h3>Login Page</h3></td>
		</tr>
			
			
				<td>Username</td>
				<td><input type="text" name="uname"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="pass"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				<input type="submit" name="submit" value="Login"></td>
			</tr>
			
		</table>
	</form>
</center>
</body>
</html>