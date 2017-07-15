<!DOCTYPE html>
<html>
<head>
	<title>School view</title>
	

</head>
<body>
<center>
	<table border="1">
		<tr>
			<td colspan="8" align="center">
			<h1>Student View Page</h1>
			</td>
		</tr>
		<tr>
			
			<th>Student Name</th>
			<th>Student Phone No</th>
			<th>Student Email Id</th>
			<th>Student Address</th>
			<th>School Name</th>
			<th>School Address</th>
			<th>Status</th>
		</tr>
		<?php
			if(isset($student))
			{
			
				foreach ($student as $row) {
					?>
					<tr>
					
						
						<td><a href="<?php echo base_url();?>index.php/admin/school_controller/student_login_succes?id=<?php echo $row['id']?>"><?php echo $row['name']?></td>
						
						<td><?php echo $row['mobile'];?></td>
						<td><?php echo $row['email'];?></td>
						<td><?php echo $row['address'];?></td>
						<td><?php echo $row['schoolname'];?></td>
						<td><?php echo $row['schooladdress'];?></td>
					
						<td>
						  <select name="status" id="status" onchange="status_change(this.value,<?php echo $row['id'];?>)">
						
								<option value="0" <?php echo ($row['block']==0?'selected':'');?>>Unblock</option>
								<option value="1" <?php echo ($row['block']==1?'selected':'');?>>Block</option>
						</select>
						</td>
					</tr>
					<?php 
				}
			}
		?>
		<tr>
		<td colspan="8" align="center"><b><a href="<?php echo base_url();?>index.php/admin/school_controller/student">Add Student</a></b></td>
		</tr>
		</table>
		</center>
</body>
</html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">

	$(document).ready(function(){


		status_change(status,user_id);

	});
	function status_change(status,user_id)
	{
			//alert(status+'------'+user_id);
			$.ajax({
				type:"post",
				url:"<?php echo base_url() ?>index.php/admin/school_controller/block",
				data:{stat:status,id:user_id},
				success:function(data)
				{
					alert('user status has been updated');
				}
			});
	}

</script>
