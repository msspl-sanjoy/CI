<!DOCTYPE html>
<html>
<head>
	<title>This is Admin Home Page</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
           setTimeout(function() { $("#add_doctor_succs_msg").show().delay(2000).fadeOut(2000);
           						$("#add_doctor_err").show().delay(2000).fadeOut(2000); 
           						$("#upsuccesfull_msg").show().delay(2000).fadeOut(2000); 
           						$("#add_patient_succs_msg").show().delay(2000).fadeOut(2000); 
           						$("#upsucces_msg").show().delay(2000).fadeOut(2000);
           						$("#no_file_msg").show().delay(2000).fadeOut(2000);}, 2000);
           					
					
         </script>
         <style>
            .green{color: green}
            .red{color:red}
          </style>
</head>
<body>

	<center>
		 <div id="headline1">
			 	<span class="green" id="add_doctor_succs_msg" style="font-size: 20px; font-weight: bold">
		            <?php
		            
		             echo (!empty($this->session->userdata('add_doctor_msg'))) ?$this->session->userdata('add_doctor_msg') : '';
		             $this->session->unset_userdata('add_doctor_msg');
		                	
		             ?>
		        </span>
			 </div>
			  <div id="headline2">
			 	<span class="green" id="add_patient_succs_msg" style="font-size: 20px; font-weight: bold">
		            <?php
		            
		             echo (!empty($this->session->userdata('add_patient_msg'))) ?$this->session->userdata('add_patient_msg') : '';
		             $this->session->unset_userdata('add_patient_msg');
		                	
		             ?>
		        </span>
			 </div>
			 <div id="headline3">
			 	<span class="red" id="add_doctor_err" style="font-size: 20px; font-weight: bold">
		            <?php
		            
		             echo (!empty($this->session->userdata('add_doctor_err'))) ?$this->session->userdata('add_doctor_err') : '';
		             $this->session->unset_userdata('add_doctor_err');
		                	
		             ?>
		        </span>
			 </div>
			<h1><u><?php echo $this->lang->line('welcome_admin');?></u></h1>
			<a href="<?php echo base_url();?>index.php/doctor_controller/add_doctor">Add Doctor</a><br>
			<a href="<?php echo base_url();?>index.php/doctor_controller/add_patient">Add Patient</a><br>
			<a href="<?php echo base_url();?>index.php/doctor_controller/all_doctor_details">View Doctor</a>
	</center>
</body>
</html>