<!DOCTYPE html>
<html>
<head>
	<title>This is Clinic Home Page</title>
</head>
<body>
<center>
	<h1><u><?php echo $this->lang->line('welcome_clinic');?></u></h1>
	<a href="<?php echo base_url();?>index.php/doctor_controller/admin">Admin</a><br>
	<a href="<?php echo base_url();?>index.php/doctor_controller/doctor">Doctor</a><br>
	<a href="<?php echo base_url();?>index.php/doctor_controller/patient">Patient</a><br>
</center>
</body>
</html>