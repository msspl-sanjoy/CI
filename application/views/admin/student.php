<!DOCTYPE html>
<html>
<head>
	<title>This is Teacher Page</title>
	
</head>
<body>
<?php
/*echo "<pre>";
print_r($student);
echo "</pre>";*/
?>
<center>
<form method="post" action="<?php echo base_url();?>index.php/admin/school_controller/student_action" onsubmit="return validation()">

	<table border="1">
		<tr>
			<td colspan="2" align="center">
			<h1>Student Insert Page</h1>
			</td>
		</tr>
		<input type="hidden" name="id"
			<?php
			
			if(!empty($student))
			{
				$id=$student['id'];
				echo "value='$id'";
			}
			else
			{
				echo "value=''";
			}
			?>

		>
		<tr>
			<td>Name:-</td>
			<td><input type="text" name="stname" id="stname" 
			<?php
			
			if(!empty($student))
			{
				$name=$student['name'];
				echo "value='$name'";
			}

			?>
			>


			<span id='errName'></span></td>
		</tr>
		<tr>
			<td>Mobile No:-</td>
			<td><input type="text" name="stmob" id="smob"
			<?php
			
			if(!empty($student))
			{
				$mob=$student['mobile'];
				echo "value='$mob'";
			}

			?>
			><span id='errMob'></span></td>
		</tr>
		<tr>
			<td>Email Id:-</td>
			<td><input type="text" name="stemail" id="semail"
			<?php
			
			if(!empty($student))
			{
				$email=$student['email'];
				echo "value='$email'";
			}

			?>
			><span id='errEmail'></span></td>
		</tr>
		<tr>
			<td>Address:-</td>
			<td><input type="text" name="stadd" id="sadd"
			<?php
			
			if(!empty($student))
			{
				$add=$student['address'];
				echo "value='$add'";
			}

			?>
			><span id='errAdd'></span></td>
		</tr>
		<tr>
			<td>Choose Country:-</td>
			<td>
				<select name="country" onchange="fetch_state(this.value)" id="country">
					<option value="">Select Any</option>
					<?php

					if(isset($country))
					{
						
						foreach ($country as $value) {
						?>
						<option value="<?php echo $value['id'];?>"
						<?php
							if(!empty($student))
								{
									$country=$student['fk_country_id'];
									echo ($value['id']==$country?'selected':'');
								}							

						?>

						><?php echo $value['name'];?></option>
						<?php
						}
					}
					?>
				</select><span id='errCoun'></span>
			</td>
		</tr>
		<span id='cstate'  name="cstate">
		<tr>
			
				<td>Choose State</td>
				<td><select name="state" id="state" onchange="fetch_city(this.value)">
						<option value="">Select any</option>
						<?php
			
							if(!empty($student))
							{
								$state_id=$student['fk_state_id'];
								/*if(!empty($state))
								{
									foreach ($state as $value) {
								echo "<option value='" + $state['id'] + "'>" + $state['name'] + "</option>";
									}
									
								}*/
								if(!empty($state))
								{
									foreach ($state as $value) 
									{
										?>
										<option value="<?php echo $value['id'];?>"
										<?php
											
													echo ($value['id']==$state_id?'selected':'');
														

										?>><?php echo $value['name'];?></option>

										<?php
									}
								}
							}

						?>
					</select><span id='errState'></td>
			
		</tr>
		
		<tr>
			<span id='scity'  name="scity">
				<td>Choose City</td>
				<td><select name="city" id="city">
						<option value="">Select city</option>	
						<?php
			
							if(!empty($student))
							{
								$city_id=$student['fk_city_id'];
								/*if(!empty($state))
								{
									foreach ($state as $value) {
								echo "<option value='" + $state['id'] + "'>" + $state['name'] + "</option>";
									}
									
								}*/
								if(!empty($city))
								{
									foreach ($city as $value) 
									{
										?>
										<option value="<?php echo $value['id'];?>"
										<?php
											
													echo ($value['id']==$city_id?'selected':'');
														

										?>><?php echo $value['name'];?></option>

										<?php
									}
								}
							}

						?>
					</select><span id='errCity'></td>
			</span>
		</tr>
			<input type="hidden" name="user_level" value="S">
		
		<tr>

			<td>School Name</td>
			<td>
				<select name="sname" id="sname">
				<option value="">Select Any</option>
				<?php 
					if(isset($school))
					{
						foreach ($school as  $value) {
							?>
							<option value="<?php echo $value['id'];?>" 
							<?php
								if(!empty($student))
								{
									$schoolid=$student['schoolid'];
									echo ($schoolid==$value['id']?'selected':'');
								}
							?>
							><?php echo $value['name'];?></option>
							<?php
						}
					}
				?>
		</select><span id='errSchool'></span>
			</td>
		</tr>

		<tr>
			<td colspan="2" align="center"><input type="submit" name="submit" 
			<?php
			
			if(!empty($student))
			{
				//$email=$student['email'];
				echo "value='update'";
			}
			else
			{
				echo "value='insert'";
			}

			?>

			 ></td>
		</tr>
	</table>
</form>
</center>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">

	
	function validation()
	{
		var flag=0;
		var a=$("#stname").val();
		//alert(a);
		if(a=="")
		{
			flag++;
			$("#errName").html('Please Enter Name');
			$("#errName").css('color', 'red');
		}
		else
		{
			$("#errName").html('');
		}
		var b=$("#smob").val();
		if(b=="")
		{
			flag++;
			$("#errMob").html('Please Enter Mobile');
			$("#errMob").css('color', 'red');
		}
		else if(isNaN(b))
		{
			flag++;
			$("#errMob").html('Please Enter Numeric Mobile No');
			$("#errMob").css('color', 'red');
		}
		else
		{
			$("#errMob").html('');
		}
		var c=$("#semail").val();
		if(c=="")
		{
			flag++;
			$("#errEmail").html('Please Enter Email');
			$("#errEmail").css('color', 'red');
		}
		else
		{
			$("#errEmail").html('');
		}
		var d=$("#sadd").val();
		if(d=="")
		{
			flag++;
			$("#errAdd").html('Please Enter Address');
			$("#errAdd").css('color', 'red');
		}
		else
		{
			$("#errAdd").html('');
		}
		var e=$("#sname").val();
		if(e=="")
		{
			flag++;
			$("#errSchool").html('Please Choose School');
			$("#errSchool").css('color', 'red');
		}
		else
		{
			$("#errSchool").html('');
		}
		var f=$("#country").val();
		if(f=="")
		{
			flag++;
			$("#errCoun").html('Please select Country');
			$("#errCoun").css('color', 'red');
		}
		else
		{
			$("#errCoun").html('');
		}
		var g=$("#state").val();
		if(g=="")
		{
			flag++;
			$("#errState").html('Please select state');
			$("#errState").css('color', 'red');
		}
		else
		{
			$("#errState").html('');
		}
		var h=$("#city").val();
		if(h=="")
		{
			flag++;
			$("#errCity").html('Please select city');
			$("#errCity").css('color', 'red');
		}
		else
		{
			$("#errCity").html('');
		}
		//alert(flag);
		if(flag>0)
		{
			return false;
		}
		else
		{
			return true;
			//location.href="admin/abc";
			//window.location.href="http://127.0.0.1/CI/index.php/admin/school_controller/student_insert";
		}
	}	
	function fetch_state(id)
	{
			
		//alert(id);
		if(!(id==""))
		{
			$.ajax
			({
				type:"post",
				url:"<?php echo base_url() ?>index.php/admin/school_controller/state_fetch",
				data:{p_id:id},
				dataType: 'json',
				success:function(data)
				{
					
					$("#state").html('<option value="">Select State</option>');
					$.each(data, function(i, data)
					 {
					        $('#state').append("<option value='" + data.id + "'>" + data.name + "</option>");

					 });
					$('#city').html('<option value="">Select State first</option>'); 
					$("#city").val("");

				}

			});

		}
		else
		{
			
			alert("Please select country");
			$("#state").html('<option value="">Select Country First</option>');
			$("#city").html('<option value="">Select State First</option>');
		}
	}

	function fetch_city(id)
	{
			
			//alert(id);
			if(!(id==""))
			{
				$.ajax({
					type:"post",
					url:"<?php echo base_url() ?>index.php/admin/school_controller/city_fetch",
					data:{p_id:id},
					dataType: 'json',
					success:function(data)
					{
						
						$("#city").html('<option value="">Select City</option>');
						$.each(data, function(i, data)
							 {
							     $('#city').append("<option value='" + data.id + "'>" + data.name + "</option>");
							 });
						
					}

				});
			}
			else
			{
				alert("Please select state");
				$("#state").html('<option value="">Select Country First</option>');
				$("#city").html('<option value="">Select State First</option>');
				
			}
	}
</script>
