<!DOCTYPE html>
<html>
<head>
	<title>Appointment Booking </title>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<style>
	    .green{color: green}
	    .red{color:red}
	    .c0{ background-color: #cdecc8}

	    .c1{ background-color:#FD5A5A;
	    	 }
		.a1
		 {
		   pointer-events: none;
		   background-color:#FD5A5A;
	       opacity: 0.65; 
		   cursor: not-allowed;
		 }

    </style>
</head>
<body>

	<center>
		
		 <span class="green" id="insert_success" style="font-size: 20px; font-weight: bold"></span>       
	       
		
		<form  method="post" name="form" id="form" >
			<table border="1">
			<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient['id'];?>"><br>
			<input type="hidden" name="day_id" id="day_name">
				
				<tr>
					<td colspan="2" align="center"><h1>Appointment Booking Page</h1></td>
				</tr>
				
				<tr>
					<td>Department</td>
					<td><select name="dept" id="dept" onchange="fetch_doctor(this.value)" required>
							<option value="">Select Any</option>
							<?php
							if(isset($dept))
								foreach ($dept as $value)
								 {
									?>
										<option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
									<?php
								 }
							?>
						</select>
					</td>
				</tr>
				<span id='cdoct'  name="cdoct">
					<tr>
					
						<td>Choose Doctor</td>
						<td><select name="doct" id="doct" required>
								<option value="">Select any</option>
								
							</select></td>
				
					</tr>
				</span>
				
				<tr>
					<td>Date</td>
					<td><div><input type="text" name="date" id="date" required onchange="getDay();"></div>
					<span id="errDay" class="red"></span></td>
					</tr>
				</tr>
				<span id="slot">
					<tr>
						<td colspan="2" align="center"><input type="button" onclick="show_slot(event)" value="Check"></td>
					</tr>
				</span>
				<tr>
					<td colspan="2"><span id='slot_show'></span></td>
				</tr>
				
			</table>
		</form>
	</centre>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() 
		{
    		$("#date").datepicker();

  		});
	
	function fetch_doctor(id)
	{
			
		if(!(id==""))
		{
			$.ajax
			({
				type:"post",
				url:"<?php echo base_url() ?>index.php/doctor_controller/doctor_fetch",
				data:{p_id:id},
				dataType: 'json',
				success:function(data)
				{
					
					$("#doct").html('<option value="">Select Doctor</option>');
					$.each(data, function(i, data)
					 {
					        $('#doct').append("<option value='" + data.id + "'>" + data.name + "</option>");

					 });
					
				},
				error: function (jqXHR, status, err)
				 {
				    $("#doct").html('<option value="">No Doctor</option>');
				  },

			});

		}
		else
		{
			
			//alert("Please select country");
			$("#doct").html('<option value="">Please select department</option>');
			//$("#city").html('<option value="">Select State First</option>');
		}
	}
	function show_slot(event)
	{
		event.preventDefault();
		//var mydata = $("#form").serialize();
		//var app_id=document.getElementById('app_id').value;
		var doct_id =document.getElementById('doct').value;
		var pat_id=document.getElementById('patient_id').value;
		var date=document.getElementById('date').value;
		var day_id=document.getElementById('day_name').value;
		//alert(app_id);
		 $.ajax(
		 {
            type: "post",
            url: "<?php echo base_url() ?>index.php/doctor_controller/insert_slot",
            data:{doctor_id:doct_id,patient_id:pat_id,date:date,day_id:day_id},
            dataType:'json',
            success:function(data)
            {
				
        		//alert(data);
        		//data = $.parseJSON(data);
        		/*var b=typeof data;
        		alert(b);*/
        		
				 
				  $.each(data, function(i, data)
					{
					        
					$('#slot_show').append(


					"<a href='<?php echo base_url()?>index.php/doctor_controller/insert_appointment/"+data.id+"/"+data.fk_doctor_id+"/"+data.patient_id+"/"+data.date+"' class='a"+data.status+"''><input type='button' class='c"+data.status+"''  style=\"width:150px;\" value='" + data.slot_time_from + "-" + data.slot_time_to + "'></a>" );

					 });	
				  	$("#slot_show").show();
				
        		
        		//alert(data);
    			
        		//alert(typeof data);
        		/*if(data=="no_insertion")
        		{
        			
        		}*/
        		
        		/*else 
        		{
        			var str = data;
					str = str.slice(0, -1);
        			$("#errDay").html('Doctor is not available on this day.Available only on :-'+str);
        		}*/
        						
            },
           	error: function(jqxhr)
           	 {
            	
            	$("#errDay").text('Doctor is not available on this day.Available only on :-'+jqxhr.responseText);
            	
          	 }
			
         });

	}
	function getDay()
	{
		//alert('hii');exit();
		var date=document.getElementById('date').value;
		//alert(date);
		/*var dayofweek = date('d', strtotime(date));

		alert(result);*/
		var weekday = ["1","2","3","4","5","6","7"];

		var a = new Date(date);
		document.getElementById('day_name').value=weekday[a.getDay()];
		$("#errDay").html('');
		$("#slot_show").hide();

	}
	
           					
</script>