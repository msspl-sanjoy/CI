<!DOCTYPE html>
<html>
<head>
	<title>This is Teacher Page</title>
</head>
<body>
<center>
<form action="<?php echo base_url();?>index.php/school/teacher_insert" method="post">
<?php echo validation_errors();?>
	
	<table border="1">
		<tr>
			<td colspan="2" align="center">
			<h1>Teacher Insert Page</h1>
			</td>
		</tr>
		<tr>
			<td>Name:-</td>
			<td><input type="text" name="tname"></td>
		</tr>
		<tr>
			<td>Mobile No:-</td>
			<td><input type="text" name="tmob"></td>
		</tr>
		<tr>
			<td>Email Id:-</td>
			<td><input type="text" name="temail"></td>
		</tr>
		<tr>

			<td>School Name</td>
			<td>
				<select name="sname">
				<option value="">Select Any</option>
				<?php
				$schoolid=$_GET['id'];
				if(isset($record))
				{
				
					
					foreach ($record as $row) {
						?>
						<option value="<?php echo $row['id'];?>" <?php echo ($row['id']==$schoolid?'selected':'');?> ><?php echo $row['name'];?></option>
						<?php 
				}
			}
		?>
		</select>
			</td>
		</tr>

		<tr>
			<td colspan="2" align="center"><input type="submit" name="submit" value="Insert"></td>
		</tr>
	</table>
</form>
</center>
</body>
</html>