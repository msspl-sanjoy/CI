<!DOCTYPE html>
<html>
<head>
	<title>This is Profile Page</title>
</head>
<body>

<center>

	
		<table border="1">
		 
			<tr>
				<td>Name</td>
				
				<td><?php echo $name;?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $email;?></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td><?php echo $mobile_no;?></td>
			</tr>
			<tr>
				<td>Image</td>
				<td><img src="<?php echo base_url('uploads/'. $image);?>"  width=200 height=200 ></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center">
				<a href="<?php echo base_url();?>index.php/main/form">Edit</a></td>
			</tr>

		</table>
	
</center>
</body>
</html>