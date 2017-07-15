<!DOCTYPE html>
<html>
<head>
	<title>This is Dashboard</title>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
           setTimeout(function() { $("#regsucces_msg").show().delay(2000).fadeOut(2000);
           						$("#no_image_msg").show().delay(2000).fadeOut(2000); 
           						$("#upsuccesfull_msg").show().delay(2000).fadeOut(2000); 
           						$("#upsucces_msg").show().delay(2000).fadeOut(2000);
           						$("#no_file_msg").show().delay(2000).fadeOut(2000);}, 2000);
           					
					
         			$(document).ready(function(){
    					//Image file input change event
					    $("#image").change(function(){
					        readImageData(this);//Call image read and render function
					    });
					});
			
		function readImageData(imgData)
		{
			if (imgData.files && imgData.files[0]) {
		        var readerObj = new FileReader();
		        
		        readerObj.onload = function (element) {
		            $('#preview_img').attr('src', element.target.result);
		        }
		        
		        readerObj.readAsDataURL(imgData.files[0]);
		    }
		}
        </script>
       
        <style>
            .green{color: green}
            .red{color:red}
            	.form_box{width:500px; margin:0 auto; margin-top:10px; margin-bottom: 40px; text-align: left;}
            }
			.fileinput{margin-left: 10px;}
			.preview_box{clear: both; padding: 5px; margin-top: 10px; text-align: center;}
			.preview_box img{max-width: 100%; max-height: 500px;}
                   
        </style>
</head>
<body>
<center>
	 <div id="headline1">
	 	<span class="green" id="regsucces_msg" style="font-size: 20px; font-weight: bold">
            <?php
            
             echo (!empty($this->session->userdata('welcome_dash'))) ?$this->session->userdata('welcome_dash') : '';
             $this->session->unset_userdata('welcome_dash');
                	
             ?>
        </span>
	 </div>
	 <div id="headline2">
	 	<span class="green" id="upsucces_msg" style="font-size: 20px; font-weight: bold">
            <?php
            
             echo (!empty($this->session->userdata('del_image'))) ?$this->session->userdata('del_image') : '';
             $this->session->unset_userdata('del_image');
                	
             ?>
        </span>
	 </div>
	 <div id="headline3">
	 	<span class="red" id="no_image_msg" style="font-size: 20px; font-weight: bold">
            <?php
            
             echo (!empty($this->session->userdata('no_image'))) ?$this->session->userdata('no_image') : '';
             $this->session->unset_userdata('no_image');
                	
             ?>
        </span>
	 </div>
	 <div id="headline4">
	 	<span class="red" id="no_file_msg" style="font-size: 20px; font-weight: bold">
            <?php
            
             echo (!empty($this->session->userdata('no_file'))) ?$this->session->userdata('no_file') : '';
             $this->session->unset_userdata('no_file');
                	
             ?>
        </span>
	 </div>
	 <div id="headline5">
	 	<span class="red" id="no_update_msg" style="font-size: 20px; font-weight: bold">
            <?php
            
             echo (!empty($this->session->userdata('no_update'))) ?$this->session->userdata('no_update') : '';
             $this->session->unset_userdata('no_update');
                	
             ?>
        </span>
	 </div>
	  <div id="headline6">
	 	<span class="green" id="upsuccesfull_msg" style="font-size: 20px; font-weight: bold">
            <?php
            
             echo (!empty($this->session->userdata('update_success'))) ?$this->session->userdata('update_success') : '';
             $this->session->unset_userdata('update_success');
                	
             ?>
        </span>
	 </div>
	 <b><u>Hello <?php echo (!empty($user)) ?$user['fname']." ".$user['lname'] : '';?></u></b>
	 <a href="<?php echo base_url()?>index.php/registration_otp_controller/logout/<?php echo (!empty($user)) ?$user['id']: '';?>">Logout</a><br>
	 <a href="<?php echo base_url()?>index.php/registration_otp_controller/edit_profile/<?php echo (!empty($user)) ?$user['id']: '';?>">Edit Profile</a>
	<div class="form_box">
	
	<form id="upload_form" action="<?php echo base_url()?>index.php/registration_otp_controller/do_upload" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo (!empty($user)) ?$user['id']: '';?>">
	<input type="hidden" name="oldimg" value="<?php echo (!empty($user)) ?$user['image']: '';?>">
			<div class="preview_box">
        	<img id="preview_img" src="<?php echo base_url()?>uploads/<?php echo (!empty($user)) ?$user['image']: '';?>" alt=""/>
        </div>
		<label><b>Select Image : </b></label>
        <input type="file" id="image" name="image" class="fileinput"/>
        <span class="red" id="no_select_msg" style="font-size: 15px; font-weight: bold">
            <?php
            
             echo (!empty($this->session->userdata('no_select'))) ?$this->session->userdata('no_select') : '';
             $this->session->unset_userdata('no_select');
                	
             ?>
        </span><br>
        <input type="submit" name="submit" value="Upload">
    </form>

</div>
</center>
</body>
</html>