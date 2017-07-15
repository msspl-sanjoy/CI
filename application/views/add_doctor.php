<!DOCTYPE html>
<html>
<head>
	<title>This is Doctor Add Page</title>
	<script type="text/javascript">
		function enableDisable()
    	{
			

			var ch = document.getElementsByName("checkbox[]");
			//alert(ch.length);

			for (var i = 0; i < ch.length; i++)
			{
   			 	
   			 	//alert("hii");
   			 	
   			 	document.getElementById('from'+i).disabled = ch[i].checked ? false : true;
   			 	document.getElementById('from'+i).focus();
   			 	document.getElementById('to'+i).disabled = ch[i].checked ? false : true;
   			 	//document.getElementById('to').setAttribute("disabled", false);
			}
    
  		}
  		function compareTime()
  		{
  			//alert("hii");
  			/*var ch = document.getElementsByName("checkbox[]");
			//alert(ch.length);

			for (var i = 0; i < ch.length; i++)
			{
				var from=document.getElementById('from'+i).value;
				var to=document.getElementById('to'+i).value;
				
				var diff=(to-from);
				alert(diff);
			}*/
			var ch = document.getElementsByName("checkbox[]");
			for (var i = 0; i < ch.length; i++)
			{
				var from = document.getElementById('from'+i).value;
				var fromTime = Number(from.match(/^(\d+)/)[1]);
				//alert(fromTime);
				var to = document.getElementById('to'+i).value;
				var toTime = Number(to.match(/^(\d+)/)[1]);
				//alert(fromTime+"->"+toTime);

				var resFrom = from.substr(-3, 3);
				//alert(resFrom);
				var resto = to.substr(-3, 3);
				resFrom=="a.m"?fromTime:fromTime+=12;
				resto=="a.m"?toTime:toTime+=12;
				/*if(resFrom=="a.m")
				{
					fromTime=fromTime;
				}
				else
				{
					fromTime=fromTime+12;
				}
				if(resto=="a.m")
				{
					toTime=toTime;
				}
				else
				{
					toTime=toTime+12;
				}*/
				var diff=(toTime-fromTime);
				if(diff==2)
				{
					return true;
				}
				else
				{
					errTime.innerHTML="The difference must be 2 hours";
					return false;
				}
				//alert(fromTime+":->"+toTime);
				//alert(from+":"+to+"->"+resFrom+"->"+resto);
			}
  		}
</script>
</head>
<body>
	<center>
		<h1><u><?php echo $this->lang->line('add_doctor');?></u></h1>
		<?php
		//print_r($dept);
		?>
		<form action="<?php echo base_url();?>index.php/doctor_controller/add_doctor_action" method="post" onsubmit="return compareTime();">
			<table border="1">
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" required>
			</tr>
			<tr>
				<td>Mobile</td>
				<td><input type="text" name="mob" required>
			</tr>
			<tr>
				<td>Qualification</td>
				<td><input type="text" name="quali" required>
			</tr>
			<tr>
				<td>Department</td>
				<td><select name="dept" required>
						<option value="">Select Any</option>
						<?php
							if(isset($dept))
							{
								foreach ($dept as $val) {
								?>
								<option value="<?php echo $val['id'];?>"><?php echo $val['name'];?> </option>
								<?php
								}
							}
							?>
					</select></td>
			</tr>
			<tr>
				<td colspan="2" align="center">Availability<span id="errTime" style="color:red"></span></td>
			</tr>
				<?php
				$i = 0;
				foreach ($day as $value) {
				
				    echo "<tr>";
				    echo "<td>";
				    echo "<input type=\"checkbox\" id=\"checkbox".$i."\" onClick=\"enableDisable()\" name=\"checkbox[]\" value=\"" . $value['id'] . "\"/> " . $value['name'] .  "</td><td>From:- <input type=\"text\" disabled style=\"width:50px;\" name=\"from[]\" id=\"from".$i."\"/>To:- <input type=\"text\" id=\"to".$i."\" disabled style=\"width:50px;\" name=\"to[]\"/></td>";
				    echo "</tr>";
				    $i++;
				}
			?>
			</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submit" value="add"></td>
			</tr>
			</tr>
			</table>
		</form>
	</center>
</body>
</html>