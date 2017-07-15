<!DOCTYPE html>
<html>
<head>
	<title>Update Password</title>
	 <style>
             .red{color: red}
                   
      </style>
</head>
<body>
<form action="<?php echo base_url();?>index.php/registration_otp_controller/update_pass_action/" method="post">
<center>

 <div id="headline">
	 	<span class="red" id="otp_msg" style="font-size: 20px; font-weight: bold">
            <?php
                if(!empty($this->session->userdata('not_pass')))
                	{ 
                		echo $this->session->userdata('not_pass'); 
                		$this->session->unset_userdata('not_pass');
                	 }
             ?>
        </span>
	 </div>
	 
	<table border="1">
		<tr>
			<td>New Password</td>
			<td><input type="password" name="newpass"></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td><input type="password" name="confirmpass"></td>
		</tr>
		<input type="hidden" name="userid" value="<?php echo (!empty($userid)) ? $userid : '';?>">	
     	<tr>
			<td colspan="2" align="center"><input type="submit" name="update" value="update"></td>
	</table>
</center>
</form>
</tr>
</body>
</html>