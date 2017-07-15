<!DOCTYPE html>
<html>
<head>
	<title>This is Registration Page</title>
	 
       
        <style>
                    .red{color: red}
                   
        </style>
</head>
<body>

	
	<form action="<?php echo base_url();?>index.php/registration_otp_controller/edit_profile_action" method="post">
		<center>
			<table border="1">
			<input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
			<tr>
				<td>First Name</td>
				<td><input type="text" name="fname" placeholder="Firstname" value="<?php echo $user['fname'];?>" required></td>
				
			</tr>
			<tr>	
				<td>Last Name</td>
				<td><input type="text" name="lname"  value="<?php echo $user['lname'];?>" placeholder="Lastname" required></td>
			<tr>
				<td>Email</td>
				<td ><input type="email" name="email"  value="<?php echo $user['email'];?>" readonly required></td>
			</tr>
			<tr>
				<td>Username</td>
				<td ><input type="text" name="username"  value="<?php echo $user['username'];?>" readonly required></td>
			</tr>
			
			<tr>
				<td>Gender</td>
				<td ><select name="gender" required>
						
					<option value="male" <?php echo ($user['gender']=='male'?'selected':'');?>>Male</option>
					<option value="female" <?php echo ($user['gender']=='female'?'selected':'');?>>Female</option>
					</select></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td ><input type="text" name="mobile" value="<?php echo $user['mobile'];?>" required></td>
			</tr>
			
			
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Update" name="submit"></td>
			</tr>

			
			</table>
		</center>
	</form>.
</body>
</html>
