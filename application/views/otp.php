<!DOCTYPE html>
<html>
<head>
	<title>OTP Generate Page</title>
	 <style>
                    .red{color: red}
                   
        </style>
</head>
<body>
<center>
 <div id="headline">
	 	<span class="red" id="otp_msg" style="font-size: 20px; font-weight: bold">
            <?php
                if(!empty($this->session->userdata('not_otp')))
                	{ 
                		echo $this->session->userdata('not_otp'); 
                		$this->session->unset_userdata('not_otp');
                	 }
             ?>
        </span>
	 </div>
	<form action="<?php echo base_url();?>index.php/registration_otp_controller/new_pass" method="post">
		One Time Password<input type="text" name="fetch_otp" readonly value="<?php if(!empty($user)){ echo $user['otp'];}?>"><br>
		Enter Above OTP<input type="text" name="otp"><br>
		<input type="hidden" name="id" value="<?php if(!empty($user)){ echo $user['userid'];}?>"><br>
		<input type="submit" value="submit">
	</form>
</center>
</body>
</html>