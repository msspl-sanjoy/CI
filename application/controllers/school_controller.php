<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class School_controller extends CI_Controller 
{
		/*public function __construct()
		 {
        	parent::__construct();     
        	$this->lang->load('student_details','spanish/admin');
   		 }*/
		public function index()
		{
			$this->load->view('login');
		}
		public function country_fetch()
		{
			$this->load->model('school_model');
			$result=$this->school_model->fetch_country();

			if($result)
			{
				$data['country']=$result;
				$this->load->view('ajax_country_view',$data);
			}
		}
		public function state_fetch()
		{
			
			$p_id=$this->input->post('p_id');
			//echo $p_id;die();
			$this->load->model('school_model');
			$state_result=$this->school_model->fetch_state($p_id);
			//print_r($state_result);die();
			if($state_result)
			{
				$data=$state_result;
				//print_r($data);die();
				echo json_encode($data);
				//$this->load->view('ajax_country_view',$data);
			}
		}
		public function city_fetch()
		{
			
			$p_id=$this->input->post('p_id');
			//echo $p_id;die();
			$this->load->model('school_model');
			$state_result=$this->school_model->fetch_city($p_id);
			//print_r($state_result);die();
			if($state_result)
			{
				$data=$state_result;
				//print_r($data);die();
				echo json_encode($data);
				//$this->load->view('ajax_country_view',$data);
			}
		}

		public function login_action()
		{
			$data=array('username'=>$this->input->post('uname'),'password'=>md5($this->input->post('pass')),'is_block'=>0);
			$this->form_validation->set_rules('uname', 'Userame', 'required'); 
			$this->form_validation->set_rules('pass', 'Password', 'required');
			if($this->form_validation->run() == FALSE) 
	         { 
	         	$this->index();
	         } 
	         else 
	         { 
	            
					$this->load->model('school_model');
					$result=$this->school_model->login($data);
					if($result)
					{
						//echo "<script>alert('Login Succesfull');</script>";
						$data['teacher']=$result;
						$session=$result[0]['id'];
						$this->session->set_userdata('user_id',$session);
						$user_level=$result[0]['user_level'];
						$user_id=$result[0]['fk_user_id'];
						if($user_level=='T')
						{
								$this->teacher_login_succes($user_id);
								
						}
						//$this->load->view('user_details',$data
						else if($user_level=='S')
						{
							
								//echo "hii";die();
								$this->student_login_succes($user_id);
								//$this->load->model('school_model');
							
												
						}
								
						else
						{
							echo "<script>alert('Invalid Username or Password');</script>";
							$this->index();
						}
					}
					else
					{
						echo "<script>alert('Invalid Username or Password');</script>";
						$this->index();
					}
		     } 
		}
		public function teacher_login_succes($user_id)
		{
			$record=$this->school_model->teacher_details($user_id);
			if($record)
			{
				
				$data['teacher']=$record;
				/*echo "<pre>";
				print_r($record);
				echo "</pre>";die();*/
				//$this->load->model('school_model');
				$record2=$this->school_model->student_assign($user_id);
				$data['assigned_student']=$record2;
				
				if($record2)
				{
					$this->load->view('teacher_details',$data);
				}
				else
				{
					//echo "<script>alert('No assigned teacher found');</script>";
					$this->load->view('student_details',$data);
				}


			}
			else
			{
				echo "No student found";
			}
		}
		public function student_login_succes($user_id)
		{
				$record=$this->school_model->student_details($user_id);
				if($record)
				{
					
					$data['student']=$record;
					/*echo "<pre>";
					print_r($record);
					echo "</pre>";die();*/
					//$this->load->model('school_model');
					$record2=$this->school_model->teacher_assign($user_id);
					$data['assigned_teacher']=$record2;
					
					if($record2)
					{
						$this->load->view('student_details',$data);
					}
					else
					{
						//echo "<script>alert('No assigned teacher found');</script>";
						$this->load->view('student_details',$data);
					}

				}
				else
				{
					echo "No student found";
				}
		}
			
		
		public function assign_teac()
		{
			$id=$_GET['studentid'];
			$this->load->model('school_model');
			//$result=$this->main->fetch_schoolid($id);
			$result=$this->school_model->fetch_all_teachers($id);
			if($result)
			{
				$data['teacher']=$result;
				$this->load->view('assign_teacher',$data);
			}
			else
			{
				echo "<script>alert('No student from this school');</script>";
				$this->student_login_succes($id);
			}
		}
		public function assign()
		{
			$id=$_GET['teacherid'];
			$this->load->model('school_model');
			//$result=$this->main->fetch_schoolid($id);
			$result=$this->school_model->fetch_all_students($id);
			$data['student']=$result;
			if($result)
			{
				

				$this->load->view('assign_student',$data);
			}
			else
			{
				echo "<script>alert('No student from this school');</script>";
				//$this->load->view('teacher_details',$data);
				$this->teacher_login_succes($id);
			}
		}
		public function assign_action()
		{
			$studentid= $this->input->post('assign_student');
			$teacherid =$this->input->post('t_id');
	        //print_r($cars);
			for($i = 0; $i < count($studentid); $i++)
			{
	           
	            $stid=$studentid[$i];
	            //echo "<br>";
	            $this->load->model('school_model');
	            $insert=$this->school_model->insert_assign_students($teacherid,$stid);

	        }
	        if($insert)
	            {
	            	echo "<script>alert('insertion succesfull')</script>";
	            	$this->teacher_login_succes($teacherid);
	            	//$this->teacher_details($teacherid);
	            }
	            else
	            {
	            	echo "<script>alert('insertion unsuccesfull')</script>";
	            	$this->teacher_login_succes($teacherid);
	            }
		}
	public function assign_action_teacher()
	{
		$teacherid= $this->input->post('assign_teacher');
		$studentid=$this->input->post('s_id');
        //print_r($cars);
		for($i = 0; $i < count($teacherid); $i++)
		{
           
            $teacid=$teacherid[$i];
            //echo "<br>";
            $this->load->model('school_model');
            $insert=$this->school_model->insert_assign_teacher($studentid,$teacid);

        }
        if($insert)
            {
            	echo "<script>alert('insertion succesfull')</script>";
	            $this->student_login_succes($studentid);
            }
            else
            {
            	echo "<script>alert('insertion unsuccesfull')</script>";
	            $this->student_login_succes($studentid);
            }
	}
	public function edit_teacher()
	{
		$id=$_GET['teacherid'];
		$this->load->model('school_model');
        $fetch=$this->school_model->teacher_details($id);
        if($fetch)
        {
        	$data['teacher']=$fetch;
        	$this->load->view('edit_profile',$data);
        }
        else
        {
        	echo "no teacher found";
        	$this->index();
        }
	}
	public function edit_teacher_action()
	{
		$data=array('id'=>$this->input->post('id'),'name'=>$this->input->post('name'),'email'=>$this->input->post('email'),'mobile'=>$this->input->post('mobile'),'address'=>$this->input->post('address'),);
		$this->load->model('school_model');
        $update=$this->school_model->update($data);
        if($update)
        {
        	echo "<script>alert('update succesfull')</script>";
	        $this->teacher_login_succes($this->input->post('id'));
        }
        else
        {
        	echo "<script>alert('update unsuccesfull')</script>";
	        $this->teacher_login_succes($this->input->post('id'));
        }
	}
	public function edit_student()
	{
		$id=$_GET['studentid'];
		$this->load->model('school_model');
        $fetch=$this->school_model->student_details($id);
        if($fetch)
        {
        	$data['student']=$fetch;
        	$this->load->view('edit_profile_student',$data);
        }
        else
        {
        	echo "no student found";
        	$this->index();
        }
	}
	public function edit_student_action()
	{
		$data=array('id'=>$this->input->post('id'),'name'=>$this->input->post('name'),'email'=>$this->input->post('email'),'mobile'=>$this->input->post('mobile'),'address'=>$this->input->post('address'),);
		$this->load->model('school_model');
        $update=$this->school_model->update_student($data);
        if($update)
        {
        	echo "<script>alert('update succesfull')</script>";
	        $this->student_login_succes($this->input->post('id'));
        }
        else
        {
        	echo "<script>alert('update unsuccesfull')</script>";
	        $this->student_login_succes($this->input->post('id'));
        }
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/school_controller/index');
	}
}
?>