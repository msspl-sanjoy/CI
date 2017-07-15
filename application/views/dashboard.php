<!DOCTYPE html>
<html>
<head>
	<title>This is Home Page</title>
</head>
<body>


<?php
if($this->session->userdata('uid'))
{
	$session_id=$this->session->userdata('uid');
	
?>
<center>
<h1>Welcome to Dashboard</h1>
	<a href='<?php echo base_url();?>index.php/main/view' >Profile</a><br>
	<a href='<?php echo base_url();?>index.php/main/pass' >Change Password</a><br>
	<a href='<?php echo base_url();?>index.php/main/logout' >Logout</a>

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
