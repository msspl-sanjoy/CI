<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class School extends CI_Controller {

	
	public function index()
	{
		
		$this->load->model('main');
		$result=$this->main->school_view();
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
	public function school_insert()
	{
		$this->load->view('school');
	}
	public function school_insert_action()
	{
		
		$data=array("name"=>$this->input->post('sname'),"address"=>$this->input->post('sadd'),"phn_no"=>$this->input->post('sphn'));
		$this->form_validation->set_rules('sname', 'Name', 'required'); 
		$this->form_validation->set_rules('sadd', 'Address', 'required'); 
		$this->form_validation->set_rules('sphn', 'Phone No', 'required'); 
		if($this->form_validation->run()==FALSE)
		{
			$this->school_insert();
		}
		else
		{
			$this->load->model('main');
			$insert=$this->main->school_insert($data);
			if($insert)
			{
				echo "<script>alert('insertion done')</script>";
				$this->index();
			}
			else
			{
				echo "<script>alert('insertion not done')</script>";
				$this->index();
			}
		}
	}
	public function school_view()
	{
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			$this->load->model('main');
			$result=$this->main->school_view_list($id);
			if($result)
			{
				$data['school']=$result;
				$this->load->model('main');
				$record=$this->main->teacher_view_list($id);
				$data['teacher']=$record;
				if($record)
				{
					$this->load->model('main');
					$record_student=$this->main->student_view_list($id);
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
	public function teacher()
	{
		if(isset($_GET['id']))
		{
			$schoolid=$_GET['id'];
			$this->load->model('main');
			$result=$this->main->schoolid_fetch();
			if($result)
			{
				$data['record']=$result;
				$this->load->view('teacher',$data);
			}
			else
			{
				echo "School Id fetching error";	
			}
		}
		else
		{
			$this->load->model('main');
			$result=$this->main->schoolid_fetch();
			if($result)
			{
				$data['record']=$result;
				$this->load->view('teacher',$data);
			}
			else
			{
				echo "School Id fetching error";	
			}
		}
	}
	public function teacher_insert()
	{
		$data=array("fk_school_id"=>$this->input->post('sname'),"name"=>$this->input->post('tname'),"phn_no"=>$this->input->post('tmob'),"email_id"=>$this->input->post('temail'));
		$this->form_validation->set_rules('sname', 'School Name', 'required'); 
		$this->form_validation->set_rules('tname', 'Name', 'required'); 
		$this->form_validation->set_rules('tmob', 'Phone No', 'required'); 
		$this->form_validation->set_rules('temail', 'Email Id', 'required'); 
		if($this->form_validation->run()==FALSE)
		{
			$this->teacher();
		}
		else
		{
			$this->load->model('main');
			$insert=$this->main->teacher_insert($data);
			if($insert)
			{
				echo "<script>alert('insertion done')</script>";
				$this->teacher_view();
			}
			else
			{
				echo "<script>alert('insertion not done')</script>";
				$this->teacher_view();
			}
		}
	}
	public function student()
	{
		$this->load->model('main');
		$result=$this->main->schoolid_fetch();
		if($result)
		{
			$data['record']=$result;
			$this->load->view('student',$data);
		}
		else
		{
			echo "School Id fetching error";	
		}
	}
	public function student_insert()
	{
		$data=array("fk_school_id"=>$this->input->post('sname'),"name"=>$this->input->post('stname'),"phn_no"=>$this->input->post('stmob'),"email_id"=>$this->input->post('stemail'));
		$this->form_validation->set_rules('sname', 'School Name', 'required'); 
		$this->form_validation->set_rules('stname', 'Name', 'required'); 
		$this->form_validation->set_rules('stmob', 'Phone No', 'required'); 
		$this->form_validation->set_rules('stemail', 'Email Id', 'required'); 
		if($this->form_validation->run()==FALSE)
		{
			$this->student();
		}
		else
		{
			$this->load->model('main');
			$insert=$this->main->student_insert($data);
			if($insert)
			{
				echo "<script>alert('insertion done')</script>";
				$this->student_view();
			}
			else
			{
				echo "<script>alert('insertion not done')</script>";
				$this->student();
			}
		}
	}
	public function teacher_view()
	{
		$this->load->model('main');
		$result=$this->main->teacher_view();
		if($result)
		{
			$data['record']=$result;
			$this->load->view('teacher_view',$data);
		}
		else
		{
			echo "Teacher Details fetching error";
		}
	}
	public function student_view()
	{
		$this->load->model('main');
		$result=$this->main->student_view();
		if($result)
		{
			$data['record']=$result;
			$this->load->view('student_view',$data);
		}
		else
		{
			echo "Student Details fetching error";
		}
	}
	public function teacher_details()
	{
		$teacherid=$_GET['id'];
		$this->load->model('main');
		$result=$this->main->teacher_details($teacherid);
		if($result)
		{
			$data['teacher']=$result;
			$this->load->model('main');
			$record=$this->main->student_assign($teacherid);
			$data['assigned_student']=$record;
			
			if($record)
			{
				$this->load->view('teacher_details',$data);
			}
			else
			{
				//echo "<script>alert('No assigned student found');</script>";
				$this->load->view('teacher_details',$data);
			}
		}
		else
		{
			echo "No record found";
		}
	}
	public function assign()
	{
		$id=$_GET['teacherid'];
		$this->load->model('main');
		//$result=$this->main->fetch_schoolid($id);
		$result=$this->main->fetch_all_students($id);
		if($result)
		{
			$data['student']=$result;

			$this->load->view('assign_student',$data);
		}
		else
		{
			echo "<script>alert('No student from this school');</script>";
			$this->student_insert();
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
            $this->load->model('main');
            $insert=$this->main->insert_assign_students($teacherid,$stid);

        }
        if($insert)
            {
            	echo "insertion succesfull";
            	//$this->teacher_details($teacherid);
            }
            else
            {
            	echo "insertion unsuccesfull";
            }
	}
	public function student_details()
	{
		$studentid=$_GET['id'];
		$this->load->model('main');
		$result=$this->main->student_details($studentid);
		if($result)
		{
			$data['student']=$result;
			$this->load->model('main');
			$record=$this->main->teacher_assign($studentid);
			$data['assigned_teacher']=$record;
			
			if($record)
			{
				$this->load->view('student_details',$data);
			}
			else
			{
				echo "<script>alert('No assigned teacher found');</script>";
				$this->load->view('student_details',$data);
			}
		}
		else
		{
			echo "No record found";
		}
	}
	public function assign_teac()
	{
		$id=$_GET['studentid'];
		$this->load->model('main');
		//$result=$this->main->fetch_schoolid($id);
		$result=$this->main->fetch_all_teachers($id);
		if($result)
		{
			$data['teacher']=$result;

			$this->load->view('assign_teacher',$data);
		}
		else
		{
			echo "<script>alert('No student from this school');</script>";
			$this->student_insert();
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
            $this->load->model('main');
            $insert=$this->main->insert_assign_teacher($studentid,$teacid);

        }
        if($insert)
            {
            	echo "insertion succesfull";
            }
            else
            {
            	echo "insertion unsuccesfull";
            }
	}
}
?>