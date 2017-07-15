<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
</head>
<body>
<?php
if($this->session->userdata('uid'))
{
	$session_id=$this->session->userdata('uid');
	
?>
<center>
	<form action="<?php echo base_url();?>index.php/main/passchange" method="post">

		<table border="1">
		
		<tr>
			<td colspan="2" align="center">
				<h3>Change Password</h3></td>
		</tr>
			
			<tr>
				<td>Old Password</td>
				<td><input type="password" name="old"></td>
			</tr>
			<tr>
				<td> New Password</td>
				<td><input type="password" name="new"></td>
			</tr>
			<tr>
				<td> Confirm Password</td>
				<td><input type="password" name="confirm"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				<input type="submit" name="submit" value="Change"></td>
			</tr>
		</table>
	</form>
</center>
<?php
}
else
{
	$this->load->view('login');
}

?>
</body>
</html>