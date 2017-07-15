<!DOCTYPE html>
<html>
<head>
	<title>This is Registration Page</title>
	 
       
        <style>
                    .red{color: red}
                   
        </style>
</head>
<body>

	<div id="headline">
	 	<span class="red" id="insert_error_msg" style="font-size: 20px; font-weight: bold">
            <?php
                if(!empty($this->session->userdata('not_insert')))
                	{ 
                		echo $this->session->userdata('not_insert'); 
                		$this->session->unset_userdata('not_insert');
                	 }
             ?>
        </span>
	 </div>
	<form action="<?php echo base_url();?>index.php/registration_otp_controller/register" method="post">
		<center>
			<table border="1">
			<tr>
				<td>First Name</td>
				<td><input type="text" name="fname" placeholder="Firstname" required></td>
				
			</tr>
			<tr>	
				<td>Last Name</td>
				<td><input type="text" name="lname" placeholder="Lastname" required></td>
			<tr>
				<td>Email</td>
				<td colspan="2"><input type="email" name="email" required>
							<span class="red" id="email_msg" style="font-size: 12px; font-weight: bold">
                                <?php
                                    if(!empty($this->session->userdata('email_exits')))
                                    	{ 
                                    		echo $this->session->userdata('email_exits'); 
                                    		$this->session->unset_userdata('email_exits');
                                    	 }
                                 ?>
                             </span></td>
			</tr>
			<tr>
				<td>Username</td>
				<td ><input type="text" name="username" required></td>
			</tr>
			<tr>
				<td>Password</td>
				<td ><input type="password" name="pass" required></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td ><select name="gender" required>
						<option value="" selected>I am</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td ><input type="text" name="mobile" required></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center"><label for="captcha"><?php echo $captcha['image']; ?></label></td>
			</tr>
			<tr>
				<td colspan="2" align="center" ><input type="text" name="captcha" id='captcha' placeholder="Type the code from the image" required>
					<span class="red" id="captcha_msg" style="font-size: 12px; font-weight: bold">
                                <?php
                                    if(!empty($this->session->userdata('captcha_notmatch')))
                                    	{ 
                                    		echo $this->session->userdata('captcha_notmatch'); 
                                    		$this->session->unset_userdata('captcha_notmatch');
                                    	 }
                                 ?>
                    </span></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Register" name="submit"></td>
			</tr>

			<span id="submit_succes" style="display:none;color:yellow; "></span>
			</table>
		</center>
	</form>.
</body>
</html>
