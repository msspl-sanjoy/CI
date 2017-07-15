<!DOCTYPE html>
<html>
<head>
	<title>This is Admin Home Page</title>
</head>
<body>
<center>

	<u>Welcome</u>
	<b>
		 <?php

			$userlevel=$admin[0]['username'];
			$id=$admin[0]['fk_user_id'];
			user_name($id,$userlevel);
		?> 
	</b> <a href="<?php echo base_url();?>index.php/admin/school_controller/logout">Logout</a><br><br><b>
<a href="<?php echo base_url();?>index.php/admin/school_controller/school">Add School</a><br>
<a href="<?php echo base_url();?>index.php/admin/school_controller/teacher">Add Teacher</a><br>
<a href="<?php echo base_url();?>index.php/admin/school_controller/student">Add Student</a><br>
<a href="<?php echo base_url();?>index.php/admin/school_controller/all_school">View School</a><br>
<a href="<?php echo base_url();?>index.php/admin/school_controller/student_view">View Student</a><br>
<a href="<?php echo base_url();?>index.php/admin/school_controller/teacher_view">View Teacher</a><br>

</center>
</body>
</html>