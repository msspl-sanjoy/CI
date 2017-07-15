<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class Main extends CI_Controller {

	
	public function index()
	{
		$this->load->view('regis');
	}
	public function insert()
	{
		 $data=array('name'=>$this->input->post('name'),'email'=>$this->input->post('email'),
						'mobile_no'=>$this->input->post('mobile'),'username'=>$this->input->post('uname'),'password'=>md5($this->input->post('pass')));
		 $this->form_validation->set_rules('name', 'Name', 'required'); 
		 $this->form_validation->set_rules('email', 'Email', 'required'); 
		 $this->form_validation->set_rules('mobile', 'Mobile', 'required'); 
		 $this->form_validation->set_rules('uname', 'Username', 'required'); 
		 $this->form_validation->set_rules('pass', 'Password', 'required'); 
         if($this->form_validation->run() == FALSE) 
         { 
         	$this->load->view('regis'); 
         } 
         else 
         { 
            
				$this->load->model('registration');
				$ins=$this->registration->create($data);
				if($ins)
				{
					$this->load->view('login');
				}
				else
				{
					$this->load->view('regis',$data);
				}
		}
	}
	public function login()
	{
		$data=array('username'=>$this->input->post('uname'),'password'=>md5($this->input->post('pass')));

		$this->form_validation->set_rules('uname', 'Username', 'required'); 
		$this->form_validation->set_rules('pass', 'Password', 'required'); 
		if($this->form_validation->run() == FALSE) 
         { 
         	$this->load->view('login'); 
         }
         else
         {
			
			$this->load->model('registration');
			$result=$this->registration->login($data);
			if($result)
			{
				
				
				$log['logi']=$result;
				$session=$result[0]['id'];
				$ipaddress = $_SERVER['REMOTE_ADDR'];
        		$browser_session_id=md5(session_id());
        		$useragent = $_SERVER ['HTTP_USER_AGENT'];
				$data=array("fk_user_id"=>$session,"ip_address"=>$ipaddress,"browser_session_id"=>$browser_session_id,"user_agent"=>$useragent);
								
				$this->load->model('registration');
				$insert=$this->registration->insert_session($data);
				
				if($insert)
				{
					
					$this->session->set_userdata('uid',$session);
					$this->load->view('dashboard');
				}
				else
				{
					$this->load->view('login');
				}
			}
			else
			{
				
				$this->load->view('login');
			}
		}
	}
	public function view()
	{
				if($this->session->userdata('uid'))
				{
					$id=$this->session->userdata('uid');
					$this->load->model('registration');
					$result=$this->registration->profile($id);
					
					if($result)
					{
											

						$this->load->view('prl',$result);
					}
					else
					{
						echo "no return";
					}
				}
				else
				{
					$this->load->view('login');
				}
	}
	public function pass()
	{
				if($this->session->userdata('uid'))
				{
					$this->load->view('password');
				}
				else
				{
					$this->load->view('login');
				}
	}
	public function logout()
	{
		$id=$this->session->userdata('uid');
		$this->load->model('registration');
		$delete=$this->registration->delete($id);
		if($delete)
		{
			$this->session->unset_userdata('uid');
			$this->load->view('login');
		}
	}
	public function passchange()
	{
			if($this->session->userdata('uid'))
				{
					$id=$this->session->userdata('uid');
					$data=array('old'=>md5($this->input->post('old')),'new'=>md5($this->input->post('new')),'confirm'=>md5($this->input->post('confirm')));

					$this->load->model('registration');
					$change=$this->registration->password($id,$data);
					echo $change;
				}
			else
				{
					$this->load->view('login');
				}
	}
	public function form()
	{
				if($this->session->userdata('uid'))
				{
					$id=$this->session->userdata('uid');
					$this->load->model('registration');
					$result=$this->registration->profile($id);

					if($result)
					{
											
						
						$this->load->view('form',$result);
					}
					else
					{
						echo "no return";
					}
				}
				else
				{
					$this->load->view('login');
				}
	}
	public function do_upload()
	{
		if($this->session->userdata('uid'))
		{
						
					
						  $flag=true;
						 $oldpic=$this->input->post('oldimg');
						if(!empty($_FILES['pic']['name']))
						{
								$this->load->model('registration');
								$config['upload_path'] = 'uploads/';
								$config['allowed_types'] = 'gif|jpg|png|jpeg';
								$config['max_size']	= '10000';
								$config['max_width']  = '10241';
								$config['max_height']  = '7681';

								$this->load->library('upload', $config);

								if ( ! $this->upload->do_upload('pic'))
								{
									
									$error = array('error' => $this->upload->display_errors());

									$this->load->view('form', $error);
									$flag=false;
								}
						
								else
								{
									$data = array('upload_data' => $this->upload->data());
									$filename=$data['upload_data']['file_name'];
								}
						}
						
						if($flag)
						{
							$filename=$_FILES['pic']['name'];
							$id=$this->session->userdata('uid');
							$data=array('name'=>$this->input->post('name'),'email'=>$this->input->post('email'),
									'mobile_no'=>$this->input->post('mobile'),'image'=>$filename);
							$this->load->model('registration');
							$update=$this->registration->update_profile($id,$data);
							
											
								
								if($update)
								{
										
										if($oldpic=="")
										{
											echo "<script>alert('No previous image');</script>";
											$this->form();
																				
										}
										else
										{
											$oldfile=$this->config->item('realpath').$oldpic;
											if(file_exists($oldfile))
											{
												unlink($oldfile);
												echo "update succesfull";
											}
											else
											{
												echo "<script>alert('No file to be deleted');</script>";
												$this->form();
											}
										}
									
								}
								else
								{
									echo "update unsuccesfull";
								}
															
						}	
						else
						{
							echo "update not succesfull";
						}
				
				
			}

				
	
	else
	{
		$this->load->view('login');
	}	

		
}
}

?>