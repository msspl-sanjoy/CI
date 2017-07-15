<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class Registration_otp_controller extends CI_Controller 
{

	public function __construct()
		 {
        	parent::__construct();     
        	$this->lang->load('student_details','english/admin');
   		 }
   	public function index()
   	{
   		$this->load->view('otp_login');
   	}
	public function register()
	{
		
		if($this->input->post("submit") !== false)
		{
			
			$record=array("fname"=>$this->input->post('fname'),"lname"=>$this->input->post('lname'),"email"=>$this->input->post('email'),"username"=>$this->input->post('username'),"password"=>md5($this->input->post('pass')),"gender"=>$this->input->post('gender'),"mobile"=>$this->input->post('mobile'),);
			$word=$this->session->userdata('captchaWord');
			$username=$this->input->post('username');
			$password=md5($this->input->post('pass'));
			$captcha=$this->input->post('captcha');
			$email=$this->input->post('email');
			if($word==$captcha)
			{
				$this->load->model('registration_otp_model');
				$email_exits=$this->registration_otp_model->email_exits($email);
				if($email_exits)
				{
					
					$result=$this->registration_otp_model->insert($record);
					if($result)
					{
						$data['user']=$result;
						$email=$result['email'];
						$record=$this->registration_otp_model->fetch_otp($email);
						$data['all_data']=$record;
						if($record)
						{
							$this->load->view('verify_user',$data);
						}
						
					}
					else
					{
						$this->session->set_userdata('not_insert',$this->lang->line('not_insert'));
          				redirect('registration_otp_controller/register','refresh');
					}
				}
				else
				{
					$this->session->set_userdata('email_exits',$this->lang->line('email_exits'));
					//echo $this->lang->line('email_exits');die();
          			redirect('registration_otp_controller/register','refresh');
				}
			}
			else
			{
				
				$this->session->set_userdata('captcha_notmatch',$this->lang->line('captcha_notmatch'));
          		redirect('registration_otp_controller/register','refresh');
			}

		}
		else
		{
		  $this->load->helper('captcha');
	      $random_number = mt_rand(0000,9999);
 	      $vals = array(
	         'word' => $random_number,
	         'img_path' => 'captcha/',
	         'img_url' => base_url().'captcha/',
	         'img_width' => 140,
	         'img_height' => 32,
	         'expiration' => 7200
	        );
	      
	      $data['captcha'] = create_captcha($vals);

	      $this->session->set_userdata('captchaWord',$data['captcha']['word']);
	      $this->load->view('regis_captcha',$data);
      	
		}
	}
	public function login()
	{
		
		$data=array('username'=>$this->input->post('uname'),'password'=>md5($this->input->post('pass')));
		//print_r($data);die();
		$this->load->model('registration_otp_model');
		$result=$this->registration_otp_model->login_success($data);
		if($result)
		{
			$data['user']=$result;
			/*$id=$result['id'];
			$update=$this->registration_otp_model->update_status($id);*/
			$this->session->set_userdata('welcome_dash',$this->lang->line('welcome_dash'));
          	$this->load->view('otp_dashboard',$data);
		}
		else
		{
			$this->session->set_userdata('not_valid',$this->lang->line('not_valid'));
			//echo $this->lang->line('not_valid');die();
          	redirect('registration_otp_controller/index','refresh');
		}
	}
	public function forget_password()
	{
		$this->load->view('forget_password');
	}
	public function otp_generate()
	{
		$email=$this->input->post('email');
		$this->load->model('registration_otp_model');
		$result=$this->registration_otp_model->fetch_otp($email);
		if($result)
		{
			$data['user']=$result;
			$this->load->view('otp',$data);
		}
	}
	public function new_pass()
	{
		$fetch_otp=$this->input->post('fetch_otp');
		$post_otp=$this->input->post('otp');
		$userid=$this->input->post('id');
		$data['userid']=$userid;
		$this->session->set_userdata('userid',$userid);
		//echo $this->session->userdata('user_id');die();
		// print_r($this->session->all_userdata());die();
		if($fetch_otp==$post_otp)
		{
			$this->load->view('updatepass',$data);
		}
		else
		{
			$this->session->set_userdata('not_otp',$this->lang->line('not_otp'));
			//echo $this->lang->line('not_valid');die();
          	redirect('registration_otp_controller/otp_generate','refresh');
		}
	}
	public function update_pass_action()
	{
		$newpassword=md5($this->input->post('newpass'));
		$confirmpassword=md5($this->input->post('confirmpass'));
		$userid=$this->input->post('userid');
		if($newpassword==$confirmpassword)
		{
			$data=array('id'=>$userid,'password'=>$newpassword);
			//print_r($data);die();
			$this->load->model('registration_otp_model');
			$result=$this->registration_otp_model->update_password($data);
			if($result)
			{
				$this->session->set_userdata('update_success',$this->lang->line('update_success'));
          		redirect('registration_otp_controller/index','refresh');
			}
			else
			{
				$this->session->set_userdata('update_unsuccess',$this->lang->line('update_unsuccess'));
          		redirect('registration_otp_controller/index','refresh');
			}
			 
		}
		else
		{
			$this->session->set_userdata('not_pass',$this->lang->line('not_pass'));
			//echo $this->lang->line('not_valid');die();
          	redirect('registration_otp_controller/new_pass','refresh');
		}
			
	}
	public function do_upload()
	{
				
					
			$flag=true;
			$oldpic=$this->input->post('oldimg');
			//echo $_FILES['image']['name']."hii";die();
			if(!empty($_FILES['image']['name']))
			{
				$this->load->model('registration_otp_model');
				$config['upload_path'] = 'uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '10000';
				$config['max_width']  = '10241';
				$config['max_height']  = '7681';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('image'))
				{
					
					$error = array('error' => $this->upload->display_errors());

					$this->load->view('otp_dashboard', $error);
					$flag=false;
				}
		
				else
				{
					//echo "hii";die();
					$data = array('upload_data' => $this->upload->data());
					$filename=$data['upload_data']['file_name'];
				}
			}
			
			if($flag)
			{
				$filename=$_FILES['image']['name'];
				$id=$this->input->post('id');
				if(!empty($filename))
				{
					$data=array('id'=>$id,'image'=>$filename);
					//print_r($data);die();
					$update=$this->registration_otp_model->update_profile($id,$data);
											
					
					if($update)
					{
							
						if($oldpic=="")
						{
							//echo "hii";die();
							//$this->session->set_userdata('no_image',$this->lang->line('no_image'));
	          				redirect('registration_otp_controller/fetch_profile/'.$id,'refresh');
							
																
						}
						else
						{
							$oldfile=$this->config->item('realpath').$oldpic;
							if(file_exists($oldfile))
							{
								unlink($oldfile);
								$this->session->set_userdata('del_image',$this->lang->line('del_image'));
	          					redirect('registration_otp_controller/fetch_profile/'.$id,'refresh');
							
							}
							else
							{
								//echo "hii";die();
								//$this->session->set_userdata('no_file',$this->lang->line('no_file'));
	          					redirect('registration_otp_controller/fetch_profile/'.$id,'refresh');
							}
						}
					
					}
					else
					{
						$this->session->set_userdata('no_update',$this->lang->line('no_update'));
	          			redirect('registration_otp_controller/fetch_profile/'.$id,'refresh');
					}
				}
				else
				{
					$this->session->set_userdata('no_select',$this->lang->line('no_select'));
	          		redirect('registration_otp_controller/fetch_profile/'.$id,'refresh');
				}
												
			}
			else
			{
				$this->session->set_userdata('no_update',$this->lang->line('no_update'));
          		redirect('registration_otp_controller/fetch_profile/'.$id,'refresh');
			}
			
			
		}
	public function fetch_profile($id)		
	{
		$this->load->model('registration_otp_model');
		$result=$this->registration_otp_model->fetch_data($id);
		if($result)
		{
			$data['user']=$result;
			/*echo "<br>";
			print_r($result);
			echo "</br>";die();*/
			$this->session->set_userdata('welcome_dash',$this->lang->line('welcome_dash'));
			$this->session->set_userdata('update_success',$this->lang->line('update_success'));
			$this->load->view('otp_dashboard',$data);
		}
	}
	public function update_status()
	{
		$real_otp=$this->input->post('fetch_otp');
		$post_otp=$this->input->post('otp');
		$id=$this->input->post('userid');
		if($real_otp==$post_otp)
		{
			$this->load->model('registration_otp_model');
			$update=$this->registration_otp_model->update_status($id);
			if($update)
			{
				
          		$this->fetch_profile($id);
			}
		}

	}
		
	public function logout($id)
	{
		
		$this->session->set_userdata('logout',$this->lang->line('logout'));
		redirect('registration_otp_controller/index','refresh');

	}
	public function edit_profile($id)
	{
		$this->load->model('registration_otp_model');
		$result=$this->registration_otp_model->fetch_data($id);
		if($result)
		{
			$data['user']=$result;
			/*echo "<br>";
			print_r($result);
			echo "</br>";die();*/
			//$this->session->set_userdata('welcome_dash',$this->lang->line('welcome_dash'));
			$this->load->view('profile',$data);
		}
	}
	public function edit_profile_action()
	{
		$data=array("fname"=>$this->input->post('fname'),"lname"=>$this->input->post('lname'),"email"=>$this->input->post('email'),"username"=>$this->input->post('username'),"gender"=>$this->input->post('gender'),"mobile"=>$this->input->post('mobile'),"id"=>$this->input->post('user_id'));
		//print_r($data);
		$this->load->model('registration_otp_model');
		$result=$this->registration_otp_model->update_user($data);
		if($result)
		{
			
			$this->fetch_profile($data['id']);
		}
	}
}
?>