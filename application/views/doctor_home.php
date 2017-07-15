<!DOCTYPE html>
<html>
<head>
	<title>This is Doctor Home Page </title>
</head>
<body>
	<center>
		<h1><u><?php echo $this->lang->line('welcome_doctor');?></u></h1>
		<a href="<?php echo base_url();?>index.php/doctor_controller/doctor_avail">Availablity Details</a><br>
		<a href="<?php echo base_url();?>index.php/doctor_controller/doctor_book">Booking Details</a><br>
	</center>
</body>
</html>