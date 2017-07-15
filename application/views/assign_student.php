<!DOCTYPE html>
<html>
<head>
	<title>Assign Student</title>
</head>
<body>
<form action="<?php echo base_url();?>index.php/school_controller/assign_action" method="post">
<center>

<table border="1">
<tr>
<td colspan="2"><h1>Assign Student</h1></td>
</tr>
<tr>
<td colspan="2"><input type="hidden" name="t_id" value="<?php echo $_GET['teacherid'];?>"></td>
</tr>
	
	<tr>
		<td>Choose Student</td>
		<td><select name='assign_student[]' multiple>
			
			<?php 
			if(isset($student))
			{
				foreach ($student as $value) {
					?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
					<?php
				}
			}
			?>
		</select>
		</td>
	</tr>
	<tr>
	<td colspan="2" align="center">
		<input type="submit" value='Assign'></td>
	</tr>
</table>
</center>
</form>
</body>
</html>