<!DOCTYPE html>
<html>
<head>
	<title>Forget Password Page</title>
</head>
<body>
<center>
	<form action="<?php echo base_url();?>index.php/registration_otp_controller/otp_generate" method="post">
		Enter Email Id:-<input type="email" name="email" required><br>
		<input type="submit" value="Submit">
	</form>
</center>
</body>
</html>