<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class Doctor_controller extends CI_Controller
 {
 	
	public function __construct()
	{
		parent::__construct();     
		$this->lang->load('doctor','english');
		$this->load->model('doctor_model');
	}
	public function index()
	{
		$this->load->view('clinic_home');
	}	 
	public function admin()
	{
		$this->load->view('admin_home');
	}
	public function doctor()
	{
		$this->load->view('doctor_home');
	}
	public function patient()
	{
		$this->load->view('patient_home');
	}	
	public function add_doctor()
	{
		
		$result=$this->doctor_model->fetch_Dept();
		if($result)
		{
			$data['dept']=$result;
			$record=$this->doctor_model->fetch_Day();
			$data['day']=$record;
			$this->load->view('add_doctor',$data);
		}
	}
	public function add_patient()
	{
		$this->load->view('add_patient');
	}
	public function add_doctor_action()
	{
		$data1=array('name'=>$this->input->post('name'),'mobile'=>$this->input->post('mob'),'qualification'=>$this->input->post('quali'),'fk_department_id'=>$this->input->post('dept'));
		$data2=array('fk_day_id'=>$this->input->post('checkbox'),'slot_time_from'=>$this->input->post('from'),'slot_time_to'=>$this->input->post('to'));
		//print_r($data2);die();
		$insert=$this->doctor_model->insert_doctor($data1,$data2);
		if($insert)
		{
			$this->session->set_userdata('add_doctor_msg',$this->lang->line('add_doctor_msg'));
			redirect('doctor_controller/admin','refresh');
		}
		else
		{
			$this->session->set_userdata('add_doctor_err',$this->lang->line('add_doctor_err'));
			redirect('doctor_controller/admin','refresh');
		}
	}
	public function add_patient_action()
	{
		$data=array('name'=>$this->input->post('name'),'mobile'=>$this->input->post('mob'),'address'=>$this->input->post('add'));
		
		$insert=$this->doctor_model->insert_patient($data);
		if($insert)
		{
			$this->session->set_userdata('add_patient_msg',$this->lang->line('add_patient_msg'));
			redirect('doctor_controller/admin','refresh');
		}
		else
		{
			$this->session->set_userdata('add_doctor_err',$this->lang->line('add_doctor_err'));
			redirect('doctor_controller/admin','refresh');
		}
	}
	public function all_doctor_details()
	{
		$config = array();
        $config["base_url"] = base_url() . "index.php/doctor_controller/all_doctor_details";
      	
      	$config["total_rows"] = $this->doctor_model->record_count();
      	//echo $config["total_rows"];die();
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        //echo $this->url->segment(2);die();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->doctor_model->get_my_data($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

		/*$result=$this->doctor_model->fetch_doctor();
		if($result)
		{*/
			//$data['doctor']=$result;
		$this->load->view('all_doctor',$data);
		//}
	}
	public function doctor_avail()
	{
		$this->load->view('doctor_name');
	}
	public function appointment()
	{
		$this->load->view('patient_name');
	}
	public function doctor_details()
	{
		$mobile=$this->input->post('mobile');
		//echo $mobile;die();
		$fetch_id=$this->doctor_model->fetch_id($mobile);
		if($fetch_id)
		{
			$data['doctor']=$fetch_id;
			/*echo "<pre>";
			print_r($fetch_id);
			echo "</pre>";die();*/
			$this->load->view('doctor_details',$data);
		}
		else
		{
			echo "no records";
		}
	}
	public function patient_details()
	{
		$mobile=$this->input->post('mobile');
		//echo $mobile;die();
		$fetch_id=$this->doctor_model->fetch_patient_id($mobile);
		if($fetch_id)
		{
			$data['patient']=$fetch_id;
			$fetch_dept=$this->doctor_model->fetch_dept();
			$data['dept']=$fetch_dept;
			$this->load->view('patient_appointment',$data);
		}
		
	}
	public function doctor_fetch()
	{
		
		$p_id=$this->input->post('p_id');
		//echo $p_id;die();
		//$this->load->model('school_model');
		$doct_result=$this->doctor_model->fetch_doctor($p_id);
		//print_r($state_result);die();
		if($doct_result)
		{
			$data=$doct_result;
			//print_r($data);die();
			echo json_encode($data);
			//$this->load->view('ajax_country_view',$data);
		}
		
	}
	public function insert_slot()
	{
		//$data =$this->input->post('serialize');
		//$app_id=$this->input->post('a_id');

		$doct_id=$this->input->post('doctor_id');
		$patient_id=$this->input->post('patient_id');
		$day_id=$this->input->post('day_id');
		$date=$this->input->post('date');
		$slot_date=date('Y-m-d', strtotime($date));
		$slot=$this->doctor_model->fetch_avail_slot($doct_id,$slot_date);
		if($slot)
		{
			$result=$this->doctor_model->fetch_slottime($doct_id);

			//print_r($result);
			if($result)
			{
				foreach ($result as  $value) 
				{
				
					if($day_id==$value['fk_day_id'])
					{
						$fromTime=strtotime($value['slot_time_from']);
						//echo "<br>";
						$toTime=strtotime($value['slot_time_to']);
						$time=$fromTime;
						while ($time < $toTime)
						{
						    $from=date('H:i', $time) ;
						    $time = strtotime('+15 minutes', $time);
						    $to=date('H:i', $time);
						    $patient_id=$this->input->post('patient_id');
							$date=$this->input->post('date');
							$record_data=array('fk_doctor_id'=>$doct_id,'date'=>date('Y-m-d', strtotime($date)),'slot_time_from'=>$from,'slot_time_to'=>$to);
							$result_insert=$this->doctor_model->insert_slot($record_data);
							//echo $result1;
						}
						if($result_insert)
						{
							//echo "success";
							$slottime=$this->doctor_model->fetch_avail_slottime($doct_id,$slot_date);
							$extraelement=array('patient_id'=>$patient_id,'app_id'=>$app_id);

							$totalrecord=array_merge($slottime,$extraelement);
							echo json_encode($totalrecord);
							exit();
						}
						else
						{
							echo "bye";
						}
					}
					else 
					{
						//return "failure";
						 $day_name=$this->doctor_model->fetch_dayName($value['fk_day_id']);
						 echo $day_name['name'].",";
						 //echo "";
						 //echo "failue";
					}
					
				}
				
			}
			else
			{
				//return "failure";
				echo "";
			}
		}
		else
		{
			$slottime=$this->doctor_model->fetch_avail_slottime($doct_id,$slot_date);
			//echo json_encode($slottime);
			$record= array();
			for($i=0;$i<count($slottime);$i++)
			{
				$record[]=array('patient_id'=>$patient_id);
			}
			foreach($slottime as $key => $value)
			{
				foreach($record as $value2)
				{

					$slottime[$key]['patient_id'] = $value2['patient_id'];
					              
				}
			}
			echo json_encode($slottime);
			//
			//echo $slottime;die();
			/*$second=array();
			for($i=0;$i<count($slottime);$i++)
			{
				$second[]=array([$i]=>array('patient_id'=>$patient_id));
			}
			//$extraelement=array('patient_id'=>$patient_id);
			print_r($second);die();*/
			//print_r($slottime);
			//$totalrecord=array_push_assoc($slottime, 'patient_id', '$patient_id');
			/*for($i=0;$i<count($slottime);$i++)
			{
				
				/*$data1=;
				$data = array_merge($data, $slottime);*/
				/*$second=array([$i]=>array('patient_id'=>$patient_id,'app_id'=>$app_id));
				print_r($second);die();
				foreach($slottime as $key => $value)
				{
				    foreach($second as $value2)
				    {
				        if($value['id'] === $value2['id'])
				        {
				            $first[$key]['title'] = $value2['title'];
				   		}               
				    }
				}
				

				exit();
			}*/
		}

	}
	public function insert_appointment($slot_id,$doctor_id,$patient_id,$date)
	{
		/*echo $slot_id;
		echo "<br>";
		echo $doctor_id;
		echo "<br>";
		echo $patient_id;
		echo "<br>";
		echo $date;*/
		//echo $date_slot=date('Y-m-d', strtotime($date));die();
		$record=$this->doctor_model->slot_exists($patient_id,$date,$slot_id,$doctor_id);
		if($record)
		{
			$this->session->set_userdata('success','You have got Appointment Succesfully');
			$result=$this->doctor_model->fetch_patient_details($patient_id);
			if($result)
			{
				$data['patient']=$result;
				$this->load->view('patient_details',$data);
			}
		}
		else
		{
			$this->session->set_userdata('unsuccess','You already have Appointment on this day ');
			$result=$this->doctor_model->fetch_patient_details($patient_id);
			if($result)
			{
				$data['patient']=$result;
				$this->load->view('patient_details',$data);
			}
		}
	}
 }
 ?>