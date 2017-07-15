<!DOCTYPE html>
<html>
<head>
	<title>This is Country State City Page</title>
</head>
<body>

Choose Country:-<select name="country" onchange="fetch_state(id=this.value)">
					<option value="">Select Any</option>
					<?php

					if(isset($country))
					{
						
						foreach ($country as $value) {
						?>
						<option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
						<?php
						}
					}
					?>
				</select>
<span id='cstate' style="display: none;" name="cstate">
	Choose State<select name="state" id="state" onchange="fetch_city(id=this.value)">
					
				</select>
</span>
<span id='scity' style="display: none;" name="scity">
	Choose State<select name="city" id="city">
					
				</select>
</span>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">

	
	function fetch_state(id)
	{
			
			//alert(id);
			$.ajax({
				type:"post",
				url:"<?php echo base_url() ?>index.php/school_controller/state_fetch",
				data:{p_id:id},
				dataType: 'json',
				success:function(data)
				{
					//console.log(data.state);
					
					//$("#cstate").html(data);
					//alert(data.state);
					//var a = ["a", "b", "c"];

					var a = '';
					data.forEach(function(entry) {
					    //console.log(entry);
					    //alert(entry.id+'======'+entry.name+'======'+entry.parent_id);

					    //$("#state").val(entry.id);
					    //$("#state").html(entry.name);
					    //var a=Object.keys(entry).length;
					    /*$("#cstate").show();
					  // $('#state').append("<option value='" + entry.id + "'>" + entry.name + "</option>");
					      var opt = '<option>'; // here we're creating a new select option for each group
		                  opt.val(entry.id);
		                  opt.text(entry.name);
		                  $('#state').append(opt); */

		                a +='<option value="'+entry.id+'">'+entry.name+'</option>';
		                //alert(a);


					    /*for(i=1;i<a;i++)
					    {
					    	$("#state").val(entry.id);
					    	$("#state").text(entry.name);
					    	//$("#cstate").html(entry.name);
					    }*/
					});

					$("#state").html(a);

					//var myArray = JSON.parse(data);
					//$("#cstate").html(data);
					/*var JSONArray = $.parseJSON(rawJSON);
					alert(JSONArray);*/
					$("#cstate").show();
					//alert('hii');
					$("#scity").hide();
				}
			});
	}

	function fetch_city(id)
	{
			
			//alert(id);
			$.ajax({
				type:"post",
				url:"<?php echo base_url() ?>index.php/school_controller/city_fetch",
				data:{p_id:id},
				dataType: 'json',
				success:function(data)
				{
					//console.log(data.state);
					//$("#cstate").html(data);
					//alert(data.state);
					//var a = ["a", "b", "c"];
					var a = '';
					data.forEach(function(entry) {
					    //console.log(entry);
					    //alert(entry.id+'======'+entry.name+'======'+entry.parent_id);

					    //$("#state").val(entry.id);
					    //$("#state").html(entry.name);
					    //var a=Object.keys(entry).length;
					    /*$("#cstate").show();
					  // $('#state').append("<option value='" + entry.id + "'>" + entry.name + "</option>");
					      var opt = '<option>'; // here we're creating a new select option for each group
		                  opt.val(entry.id);
		                  opt.text(entry.name);
		                  $('#state').append(opt); */

		                a +='<option value="'+entry.id+'">'+entry.name+'</option>';
		                //alert(a);


					    /*for(i=1;i<a;i++)
					    {
					    	$("#state").val(entry.id);
					    	$("#state").text(entry.name);
					    	//$("#cstate").html(entry.name);
					    }*/
					});

					$("#city").html(a);

					//var myArray = JSON.parse(data);
					//$("#cstate").html(data);
					/*var JSONArray = $.parseJSON(rawJSON);
					alert(JSONArray);*/
					$("#scity").show();
					//alert('hii');
				}
			});
	}

</script>