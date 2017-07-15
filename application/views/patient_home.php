<!DOCTYPE html>
<html>
<head>
	<title>This is Patient Home Page </title>
</head>
<body>
	<center>
		<h1><u><?php echo $this->lang->line('welcome_patient');?></u></h1>
		<a href="<?php echo base_url();?>index.php/doctor_controller/appointment">Appointment Booking</a><br>
		<a href="<?php echo base_url();?>index.php/doctor_controller/search_doctor">Search Doctor</a><br>
	</center>
</body>
</html>