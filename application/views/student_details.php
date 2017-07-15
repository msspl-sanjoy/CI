<!DOCTYPE html>
<html>
<head>
	<title>School view</title>
</head>
<body>
<center>

	<table border="1">
		<tr>
			<td colspan="5" align="center">
			   <h1><?php echo $this->lang->line('student_header'); ?></h1>
			</td>
		</tr>
		<tr>
		<td colspan="5" align="center">
		  <form action="<?php echo base_url();?>index.php/admin/school_controller/student" method="post">
		       <input type="hidden" name="id" value="<?php echo $student['id'];?>">
		       <input type="submit" name="edit" value="Update Profile">
	      </form><?php echo $this->lang->line('welcome'); ?>&nbsp;<b><?php user_name($student['id'],'S');?></b>
	       <a href="<?php echo base_url();?>index.php/admin/school_controller/logout">
	       	<?php echo $this->lang->line('logout'); ?>
	       </a>
	    </td>
       </tr>
		<tr>
			<th><?php echo $this->lang->line('student_name'); ?></th>
			<th><?php echo $this->lang->line('student_email'); ?></th>
			<th><?php echo $this->lang->line('student_mobile'); ?></th>
			<th><?php echo $this->lang->line('student_address'); ?></th>
			<th><?php echo $this->lang->line('school_name'); ?></th>
		</tr>
		<tr>
			<td><?php echo $student['name'];?></td>
			<td><?php echo $student['email'];?></td>
			<td><?php echo $student['mobile'];?></td>
			<td><?php echo $student['address'];?></td>
			<td><?php echo $student['schoolname'];?></td>
		</tr>
		<tr>
			<td colspan="5" align="center"><b><?php echo $this->lang->line('teacher_list'); ?></b><br>
				<a href="<?php echo base_url();?>index.php/school_controller/assign_teac?studentid=<?php echo  $student['id'];?>"><?php echo $this->lang->line('assign'); ?></a>&nbsp;
  			</td>
		</tr>
		
		<tr>
			<th><?php echo $this->lang->line('teacher_name'); ?></th>
			<th><?php echo $this->lang->line('teacher_email'); ?></th>
			<th colspan="2"><?php echo $this->lang->line('teacher_mobile'); ?></th>
			<th><?php echo $this->lang->line('teacher_address'); ?></th>
		</tr>
		<?php 
		if(!empty($assigned_teacher))
		{
			foreach ($assigned_teacher as  $value)
			 {
				?>
					<tr>
						<td><?php echo $value['teachername'];?></td>
						<td><?php echo $value['teacheremail'];?></td>
						<td colspan="2"><?php echo $value['teachermobile'];?></td>
						<td colspan="2"><?php echo $value['teacheraddress'];?></td>
					</tr>
				<?php
			 }
		}
		else
		{
			echo "<tr><td colspan=5><center>No teacher assigned</center></td></tr>";
		}

		?>
		
		<tr>
			
		</tr>
		<tr>
			<td colspan="5" align="center">
			Select Language:-	<a href="<?php echo base_url();?>index.php/LanguageSwitcher/switchLang/english">English</a>
   				 <a href="<?php echo base_url();?>index.php/LanguageSwitcher/switchLang/spanish">Spanish</a>
   			</td>
   		</tr>

		</table>
	</center>
	

 
</select>
</body>
</html>