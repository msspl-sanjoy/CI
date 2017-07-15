<!DOCTYPE html>
<html>
<head>
	<title>This is School Page</title>
</head>
<body>
	<form action="<?php echo base_url();?>index.php/school/school_insert_action" method="post">
		<center>
		<?php echo validation_errors();?>
		<table border="1">
			<tr>
				<td colspan="2" align="center">
				<h1>School Insert Page</h1>
				</td>
			</tr>
			<tr>
				<td>Name:-</td>
				<td><input type="text" name="sname"></td>
			</tr>
			<tr>
				<td>Address:-</td>
				<td><input type="text" name="sadd"></td>
			</tr>
			<tr>
				<td>Phone No:-</td>
				<td><input type="text" name="sphn"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				<input type="submit" name="submit" value="Add"></td>
			</tr>
		</table>
		</center>
	</form>
</body>
</html>