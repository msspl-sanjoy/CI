<!DOCTYPE html>
<html>
<head>
	<title>This is  form Profile Page</title>
</head>
<body>
<center>

	
		<table border="1">
		<form action="<?php echo base_url();?>index.php/main/do_upload" method="post" enctype="multipart/form-data">
		 
			<tr>
				<td>Name</td>
				
				<td><input type="text" name="name" value="<?php echo $name;?>"</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email;?>"></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td><input type="text" name="mobile" value="<?php echo $mobile_no;?>"></td>
			</tr>
			<tr>
			<td>
				<input type="hidden" name="oldimg" value="<?php echo $image;?>">
			</td> 
			</tr>
			<tr>
				<td>Image</td>
				<td><input type="file" name="pic"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				<input type="submit" name="submit" value="update"></td>
			</tr>

		</table>
		</form>
	
</center>
</body>
</html>