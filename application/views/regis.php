<!DOCTYPE html>
<html>
<head>
	<title>This is Registration Page</title>
</head>
<body>
<center>
	<form action="<?php echo base_url();?>index.php/main/insert" method="post">

		<table border="1">
			<?php echo validation_errors(); ?>
				<tr>
					<td colspan="2" align="center">
						<h3>Registration Page</h3></td>
				</tr>
				<tr>
					<td>Name</td>
					
					<td><input type="text" name="name" value="<?php echo isset($name) ? $name : '';?>" ></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="email" value="<?php echo isset($email) ? $email : '';?>"></td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td><input type="text" name="mobile" value="<?php echo isset($mobile_no) ? $mobile_no : '';?>"></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="uname" value="<?php echo isset($username) ? $username : '';?>"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="pass"></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
					<input type="submit" name="submit" value="Insert"></td>
				</tr>
		</table>
	</form>
</center>
</body>
</html>