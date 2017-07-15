<!DOCTYPE html>
<html>
<head>
	<title>Sorting Practice</title>
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
	</style>
</head>
<body>

	<div> 
		Number of records: <?php echo $num_records;?>
	</div>
	<br>
	<div>
	    <table >
	    	<thread>
	    		<?php foreach ($fields as $field_name =>$field_display) 
					{ ?>
				<th><?php echo $field_display;?></th>
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
	<a href="">Hiiii</a>
</body>
</html>