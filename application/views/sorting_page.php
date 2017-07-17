<!DOCTYPE html>
<html>
<head>
	<title>Sorting Practice</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>

		table
		{
			border-collapse: collapse;
		}
		th,td
		{
			border: 1px solid #666666;
			padding: 4px;
		}
		.sort_asc:after
		{
			content:'\f0de';
			font: normal normal normal 14px/1 FontAwesome;
		    font-size: 14px;
			font-size: inherit;
			text-rendering: auto;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;

		}
		.sort_desc	:after
		{
			content:'\f0dd';
			font: normal normal normal 14px/1 FontAwesome;
		    font-size: 14px;
			font-size: inherit;
			text-rendering: auto;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;

		}
		.find{
			background-color: #ff5733;
			width: 6em; 
		    height: 2em;
		}
	</style>
</head>
<body>

	<h1><u>Sorting & Filtering Example</u></h1>
	<form>
			Gender:--<select name='gender'>
						<option value="">Select</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
			         </select>
		Designation:--<select name='designation'>
						<option value="">Select</option>
						<option value="developer">Developer</option>
						<option value="designer">Designer</option>
						<option value="bidder">Bidder</option>
						<option value="TL">Team Leader</option>
		         	  </select>	
		<input type="submit" class="find" value="Find" name="find">

	</form>
	<br>
	<div>
	    <table >
	    	<thread>
	    		<?php foreach ($fields as $field_name =>$field_display) 
					{ ?>
				<th <?php if($sort_by==$field_name) echo "class=\"sort_$sort_order\""	 ?>><?php echo anchor("sorting_controller/sorting/$field_name/".
				 (($sort_order=='asc' && $sort_by==$field_name)?'desc':'asc'),$field_display);?></th>
				  <?php }
	    		?>
	    	</thread>
	    	<tbody>
	    		<?php foreach ($employee as $employee) {	

	    		?>
	    		<tr>
	    			<?php foreach ($fields as $field_name =>$field_display) 
						{ ?>
						<td><?php echo $employee->$field_name;?></td>
						  <?php }
			    		?>
	    		</tr>
	    		<?php }?>
	    	</tbody>
	    </table>
	</div>
	<br>
	<div>
		<?php echo $page_links;?>
	</div>
</body>
</html>