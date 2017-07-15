<!DOCTYPE html>
<html>
<head>
	<title>This is School Page</title>
</head>
<body>
	<form action="<?php echo base_url();?>index.php/admin/school_controller/school_action" method="post" onsubmit="return validation()">
		<center>
		
		<table border="1">
			<tr>
				<td colspan="2" align="center">
				<h1>School Insert Page</h1>
				</td>
			</tr>
			<input type="hidden" name="id"
			<?php
			
			if(!empty($school))
			{
				$id=$school['id'];
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
				<td><input type="text" name="sname" id="sname"
				<?php
				
				if(!empty($school))
				{
					$name=$school['name'];
					echo "value='$name'";
				}

				?>
				><span id="errName"></span></td>
			</tr>
			<tr>
				<td>Address:-</td>
				<td><input type="text" name="sadd" id="sadd"
				<?php
				
					if(!empty($school))
					{
						$add=$school['address'];
						echo "value='$add'";
					}

				?>
				><span id="errAddress"></span></td>
			</tr>
			<tr>
				<td>Phone No:-</td>
				<td><input type="text" name="sphn" id="sphn"
				<?php
				
					if(!empty($school))
					{
						$phn=$school['phn_no'];
						echo "value='$phn'";
					}

				?>
				><span id="errMob"></span></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				<input type="submit" name="submit" <?php
			
			if(!empty($school))
			{
				//$email=$student['email'];
				echo "value='update'";
			}
			else
			{
				echo "value='insert'";
			}

			?>></td>
			</tr>
		</table>
		</center>
	</form>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">

	$(document).ready(function()
	{

		//validation();
	});
	function validation()
	{
		var flag=0;
		var a=$("#sname").val();
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
		var b=$("#sphn").val();
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
		
		var d=$("#sadd").val();
		if(d=="")
		{
			flag++;
			$("#errAddress").html('Please Enter Address');
			$("#errAddress").css('color', 'red');
		}
		else
		{
			$("#errAddress").html('');
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

</script>
