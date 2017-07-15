<!DOCTYPE html>
<html>
<head>
	<title>Assign Student</title>
</head>
<body>
<form action="<?php echo base_url();?>index.php/school_controller/assign_action_teacher" method="post">
<center>

<table border="1">
<tr>
<td colspan="2"><h1>Assign Teacher</h1></td>
</tr>
<tr>
<td colspan="2"><input type="hidden" name="s_id" value="<?php echo $_GET['studentid'];?>"></td>
</tr>
	
	<tr>
		<td>Choose Teacher</td>
		<td><select name='assign_teacher[]' multiple>
			
			<?php 
			if(isset($teacher))
			{
				foreach ($teacher as $value) {
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