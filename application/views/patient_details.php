<!DOCTYPE html>
<html>
<head>
	<title>Patient Details Page</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
           setTimeout(function() { $("#add_slot_succs_msg").show().delay(2000).fadeOut(2000);
           						  }, 2000);
           					
					
      </script>
     <style>
        .green{color: green}
        .red{color:red}
      </style>
</head>
<body>
	<center>
		<div id="headline1">
		 	<span class="green" id="add_slot_succs_msg" style="font-size: 20px; font-weight: bold">
		        <?php
		        
		         echo (!empty($this->session->userdata('success'))) ?$this->session->userdata('success') : '';
		         $this->session->unset_userdata('success');
		            	
		         ?>
		    </span>
		 </div>
		 <div id="headline1">
		 	<span class="red" id="add_slot_err_msg" style="font-size: 20px; font-weight: bold">
		        <?php
		        
		         echo (!empty($this->session->userdata('unsuccess'))) ?$this->session->userdata('unsuccess') : '';
		         $this->session->unset_userdata('unsuccess');
		            	
		         ?>
		    </span>
		 </div>
		 <?php
		/* echo "<pre>";
		 print_r($patient);		 
		 echo "</pre>";*/
		 ?>
		 <b>Welcome <u><?php echo $patient[0]['patientname'];?></u><br></b>
		<!---<table border="1">
		 	<tr>
		 		<th>Doctor Name</th>
		 		<th>Date</th>
		 		<th>From Time</th>
		 		<th>To Time</th>
		 	</tr>
		 	<?php

		 	/*foreach ($patient as   $value)
		 	{
		 		?>

		 		<tr>
		 			<td><?php echo $value['doctorname'];?></td>
		 			<td><?php echo $value['date'];?></td>
		 			<td><?php echo $value['fromtime'];?></td>
		 			<td><?php echo $value['totime'];?></td>
		 		</tr>
		 		<?php
		 	}*/
		 	?>
		 </table>-->
	 </center>
</body>
</html>
