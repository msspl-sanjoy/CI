<!DOCTYPE html>
<html>
<head>
	<title>This is Verification page</title>
</head>
<body>
<form action="<?php echo base_url();?>index.php/registration_otp_controller/update_status" method="post">
<center>
Your OTP:-<input type="text" name="fetch_otp" value="<?php echo (!empty($all_data))?$all_data['otp']:'';?>" readonly><br>
Enter above Code:<input type="text" name="otp"><br>
<input type="hidden" name="userid" value="<?php echo (!empty($all_data))?$all_data['id']:'';?>"><br>
<input type="submit" name="submit" value="Submit">
</center>
</form>
</body>
</html>