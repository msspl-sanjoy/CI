<!DOCTYPE html>
<html>
<head>
	<title>This is Login Page</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            setTimeout(function() { $("#update_success_msg").show().delay(2000).fadeOut(2000);
            $("#logout_msg").show().delay(2000).fadeOut(2000); }, 2000);
        </script>

	<style>
          .red{color: red}
          .green{color:green}       
     </style>
</head>
<body>
<center>
	<div id="headline">
	 	<span class="red" id="login_error_msg" style="font-size: 20px; font-weight: bold">
            <?php
                if(!empty($this->session->userdata('not_valid')))
                	{ 
                		echo $this->session->userdata('not_valid'); 
                		$this->session->unset_userdata('not_valid');
                	 }
                	
             ?>
        </span>
	 </div>
	 <div id="headline2">
	 	<span class="green" id="update_success_msg" style="font-size: 20px; font-weight: bold">
            <?php
                if(!empty($this->session->userdata('update_success')))
                	{ 
                		echo $this->session->userdata('update_success'); 
                		$this->session->unset_userdata('update_success');
                	 }
                	
             ?>
        </span>
	 </div>
	 <div id="headline2">
	 	<span class="green" id="logout_msg" style="font-size: 20px; font-weight: bold">
            <?php
                if(!empty($this->session->userdata('logout')))
                	{ 
                		echo $this->session->userdata('logout'); 
                		$this->session->unset_userdata('logout');
                	 }
                	
             ?>
        </span>
	 </div>
	<form action="<?php echo base_url();?>index.php/registration_otp_controller/login" method="post">

		<table border="1">
		
		<tr>
			<td colspan="2" align="center">
				<h3>Login Page</h3></td>
		</tr>
			
			
				<td>Username</td>
				<td><input type="text" name="uname" required></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="pass" required=""></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				<input type="submit" name="submit" value="Login"><br><a href="<?php echo base_url();?>index.php/registration_otp_controller/forget_password">Forget Password</a></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><a href='<?php echo base_url();?>index.php/registration_otp_controller/register'>Click Here To Register</a></td>
			</tr>
		</table>
	</form>
</center>
</body>
</html>