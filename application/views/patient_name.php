<!DOCTYPE html>
<html>
<head>
	<title>Patient</title>
</head>
<body>
	<center>
		<form action="<?php echo base_url();?>index.php/doctor_controller/patient_details" method="post">
		Enter Your Mobile No:-<input type="text" name="mobile"><br>
		<input type="submit" name="submit" value="Make Appointment">
		</form>
	</center>
</body>
</html>