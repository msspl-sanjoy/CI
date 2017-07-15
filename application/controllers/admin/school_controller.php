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
			$this->load->view('admin/login');
		}
		public function country_fetch()
		{
			$this->load->model('admin/admin_school_model');
			$result=$this->admin_school_model->fetch_country();

			if($result)
			{
				$data['country']=$result;
				$this->load->view('ajax_country_view',$data);
			}
		}
		public function state_fetch()
		{
			
			$p_id=$this->input->post('p_id');
			$this->load->model('admin/admin_school_model');
			$state_result=$this->admin_school_model->fetch_state($p_id);
			if($state_result)
			{
				$data=$state_result;
				echo json_encode($data);
			}
		}
		public function city_fetch()
		{
			$p_id=$this->input->post('p_id');
			$this->load->model('school_model');
			$state_result=$this->school_model->fetch_city($p_id);
			if($state_result)
			{
				$data=$state_result;
				echo json_encode($data);
			}
		}
		public function all_school()
		{
			
			$this->load->model('admin/admin_school_model');
			$result=$this->admin_school_model->school_view();
			if($result)
			{
				$data['record']=$result;
				$this->load->view('school_view',$data);
			}
			else
			{
				echo "School Details fetching error";
			}
		}
	
		public function login_action()
		{
			$data=array('username'=>$this->input->post('uname'),'password'=>md5($this->input->post('pass')));
			$this->form_validation->set_rules('uname', 'Userame', 'required'); 
			$this->form_validation->set_rules('pass', 'Password', 'required');
			if($this->form_validation->run() == FALSE) 
	         { 
	         	$this->index();
	         } 
	         else 
	         { 
	            
					$this->load->model('admin/admin_school_model');
					$result=$this->admin_school_model->login($data);
					if($result)
					{
						$data['admin']=$result;
						$session=$result[0]['id'];
						$this->session->set_userdata('user_id',$session);
						$user_level=$result[0]['user_level'];
						if($user_level=='A')
						{
							echo "<script>alert('Login Succesfull');</script>";
							$this->load->view('admin/dashboard',$data);
						}
						else
						{
							echo "<script>alert('Login Unsuccesfull');</script>";
							$this->index();
						}
					}
					else
					{
						echo "<script>alert('Login Unsuccesfull');</script>";
						$this->index();
					}
		     } 
		}
		public function student()
		{
			$this->load->model('admin/admin_school_model');
			$result=$this->admin_school_model->fetch_all_school();
			$this->load->model('school_model');
			$record=$this->school_model->fetch_country();
			if($result && $record)
			{
				$data['school']=$result;
				$data['country']=$record;
				$id=$this->input->post('id');
				$fetch=$this->admin_school_model->student_details($id);
				$data['student']=$fetch;
				if($fetch)
				{
					$country_id=$fetch['fk_country_id'];
					$state_id=$fetch['fk_state_id'];
					$state_list=$this->admin_school_model->fetch_state($country_id);
					$data['state']=$state_list;
					$city_list=$this->admin_school_model->fetch_city($state_id);
					$data['city']=$city_list;
					$this->load->view('admin/student',$data);
				}
				else
				{
					$this->load->view('admin/student',$data);
				}
			}
			else
			{
				echo "no school";
			}
		}
		
		public function teacher()
		{
			$this->load->model('admin/admin_school_model');
			$result=$this->admin_school_model->fetch_all_school();
			$this->load->model('school_model');
			$record=$this->school_model->fetch_country();
			if($result && $record)
			{
				$data['school']=$result;
				$data['country']=$record;
				$id=$this->input->post('id');
				$fetch=$this->admin_school_model->teacher_details($id);
				$data['teacher']=$fetch;
				if($fetch)
				{
					$country_id=$fetch['fk_country_id'];
					$state_id=$fetch['fk_state_id'];
					$state_list=$this->admin_school_model->fetch_state($country_id);
					$data['state']=$state_list;
					$city_list=$this->admin_school_model->fetch_city($state_id);
					$data['city']=$city_list;
					$this->load->view('admin/teacher',$data);
				}
				else
				{
					$this->load->view('admin/teacher',$data);
				}
			}
			else
			{
				echo "no school";
			}
			
		}
		public function school()
		{
			$this->load->model('admin/admin_school_model');
			$id=$this->input->post('id');
			$fetch=$this->admin_school_model->school_details($id);
			$data['school']=$fetch;
			$this->load->view('admin/school',$data);

		}
		public function student_action()
		{
			$data=array('name'=>$this->input->post('stname'),'email'=>$this->input->post('stemail'),'mobile'=>$this->input->post('stmob'),'address'=>$this->input->post('stadd'),'fk_country_id'=>$this->input->post('country'),'fk_state_id'=>$this->input->post('state'),'fk_city_id'=>$this->input->post('city'),
				'fk_school_id'=>$this->input->post('sname'),'userlevel'=>$this->input->post('user_level'));
			$id=$this->input->post('id');
			if(empty($id))
			{
				$result=$this->common_model->user_insert($data);
				if($result)
				{
					
						echo "two table insert succesfull";
						$this->student_view();

				}
				else
				{
					echo "Student Insertion Unuccesfull";
					$this->student();

				}
			}
			else
			{
				$update=$this->common_model->update_student($data,$id);
				if($update)
		        {
		        	echo "update succesfull";
		        }
		        else
		        {
		        	echo "update unsuccesfull";
			       
		        }
			}
		}
		public function teacher_action()
		{
			$data=array('name'=>$this->input->post('tname'),'email'=>$this->input->post('temail'),'mobile'=>$this->input->post('tmob'),'address'=>$this->input->post('tadd'),'fk_country_id'=>$this->input->post('country'),'fk_state_id'=>$this->input->post('state'),'fk_city_id'=>$this->input->post('city'),
				'fk_school_id'=>$this->input->post('sname'),'userlevel'=>$this->input->post('user_level'));
			$this->load->model('admin/admin_school_model');
			$id=$this->input->post('id');
			if(empty($id))
			{
				$result=$this->common_model->user_insert($data);
				if($result)
				{
					
						echo "two table insert succesfull";
						$this->teacher_view();

				}
				else
				{
					echo "Student Insertion Unuccesfull";
					$this->teacher();

				}
			}
			else
			{
				$update=$this->common_model->update_teacher($data,$id);
				if($update)
		        {
		        	echo "update succesfull";
			        //$this->student_login_succes($id);
		        }
		        else
		        {
		        	echo "update unsuccesfull";
			        //$this->student_login_succes($id);
		        }
			}
		}
		public function school_action()
		{
			$data=array('name'=>$this->input->post('sname'),'address'=>$this->input->post('sadd'),'phn_no'=>$this->input->post('sphn'));
			
			$this->load->model('admin/admin_school_model');
			$id=$this->input->post('id');
			if(empty($id))
			{
				$result=$this->admin_school_model->school_insert($data);
				if($result)
				{
					
						echo "school insertsuccesfull";
						$this->school_view();
				}
				else
				{
					echo "school Insertion Unuccesfull";
					$this->school();
				}
			}
			else
			{
				$update=$this->admin_school_model->update_school($data,$id);
				if($update)
		        {
		        	echo "update succesfull";
		        }
		        else
		        {
		        	echo "update unsuccesfull";
		        }
			}
		}
		
		public function student_view()
		{
			$this->load->model('admin/admin_school_model');
			$result=$this->admin_school_model->fetch_student();

			if($result)
			{
				$data['student']=$result;
				$this->load->view('admin/student_full_view',$data);
			}
			else
			{
				echo "No record Found";
			}
		}
		public function teacher_view()
		{
			$this->load->model('admin/admin_school_model');
			$result=$this->admin_school_model->fetch_teacher();
			if($result)
			{
				$data['teacher']=$result;
				$this->load->view('admin/teacher_full_view',$data);
			}
			else
			{
				echo "No record Found";
			}
		}
		public function block()
		{
			$data=array('is_block'=>$this->input->post('stat'),'fk_user_id'=>$this->input->post('id'));

			$this->load->model('admin/admin_school_model');
			$result=$this->admin_school_model->change_status($data);
		}
		public function student_login_succes()
		{
				$user_id=$_GET['id'];
				$this->load->model('school_model');
				$record=$this->school_model->student_details($user_id);
				if($record)
				{
					
					$data['student']=$record;
					$record2=$this->school_model->teacher_assign($user_id);
					$data['assigned_teacher']=$record2;
					
					if($record2)
					{
						$this->load->view('student_details',$data);
					}
					else
					{
						$this->load->view('student_details',$data);
					}

				}
				else
				{
					echo "No student found";
				}
		}
		public function teacher_login_succes()
		{
			$user_id=$_GET['id'];
			$this->load->model('school_model');
			$record=$this->school_model->teacher_details($user_id);
			if($record)
			{
				
				$data['teacher']=$record;
				$record2=$this->school_model->student_assign($user_id);
				$data['assigned_student']=$record2;
				
				if($record2)
				{
					$this->load->view('teacher_details',$data);
				}
				else
				{
					$this->load->view('teacher_details',$data);
				}
			}
			else
			{
				echo "No student found";
			}
		}
		public function school_view()
			{
				if(isset($_GET['id']))
				{
					$id=$_GET['id'];
					$this->load->model('admin/admin_school_model');
					$result=$this->admin_school_model->school_view_list($id);
					if($result)
					{
						$data['school']=$result;
						$record=$this->admin_school_model->teacher_view_list($id);
						$data['teacher']=$record;
						if($record)
						{
							$record_student=$this->admin_school_model->student_view_list($id);
							$data['student']=$record_student;
							if($record_student)
							{
								
								$this->load->view('school_view_list',$data);
							}
							else
							{
								echo "<script>alert('No student from this school');</script>";
								$this->student_insert();
							}

						}
						else
						{
							echo "<script>alert('No Teacher from this school');</script>";
							$this->teacher_insert();
							
						}
					}
					else
					{
						$this->load->view('school_view');
					}
				}
				else
				{
					$this->load->view('school_view_list',$data);
				}
			}
			public function logout()
			{
				$this->session->sess_destroy();
				redirect('/admin/school_controller/index');
			}
}
?>