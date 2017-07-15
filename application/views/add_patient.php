<!DOCTYPE html>
<html>
<head>
	<title>This is Patient Add Page</title>
</head>
<body>
	<center>
		<h1><u><?php echo $this->lang->line('add_patient');?></u></h1>
		<?php
		//print_r($dept);
		?>
		<form action="<?php echo base_url();?>index.php/doctor_controller/add_patient_action" method="post" >
			<table border="1">
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" required>
			</tr>
			<tr>
				<td>Mobile</td>
				<td><input type="text" name="mob" required>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" name="add" required></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submit" value="Register"></td>
			</tr>
			</table>
		</form>
	</center>
</body>
</html>