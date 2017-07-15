<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor_model extends CI_Model
 	{
 		public function fetch_dept()
 		{
 			$query=$this->db->get('tbl_department');
 			if($query->num_rows()>0)
 			{
 				return $query->result_array();
 			}
 			else
 			{
 				return false;
 			}
 		}
 		public function fetch_Day()
 		{
 			$query=$this->db->get('tbl_day');
 			if($query->num_rows()>0)
 			{
 				return $query->result_array();
 			}
 			else
 			{
 				return false;
 			}
 		}
 		
 		public function insert_doctor($data1,$data2)
 		{
 			$insert=$this->db->insert('tbl_doctor_details',$data1);
 			if($insert)
 			{
 				$this->db->where('name',$data1['name']);
 				$this->db->where('mobile',$data1['mobile']);
 				$query=$this->db->get('tbl_doctor_details');
 				//echo $this->db->last_query();die();
 				$reco=$query->row_array();
 				//print_r($data2);die();
 				/*foreach ($data2 as  $value) {
 					print_r($value);die();
 					$this->db->insert('tbl_doctor_timeslot',array('fk_doctor_id'=>$record['id'],'fk_day_id'=>$value['fk_day_id'],'slot_time_from '=>$value['slot_time_from'],'slot_time_to'=>$$value['slot_time_to']));
 					echo $this->db->last_query();die();
 				}*/
 				//echo $data1['fk_department_id'];die();
 				$record= array();
 				//echo count($data2['fk_day_id']);
				for ($i=0; $i < count($data2['fk_day_id']); $i++)
				{
					$record[] = array('fk_department_id'=>$data1['fk_department_id'],'fk_doctor_id'=>$reco['id'],'fk_day_id'=>$data2['fk_day_id'][$i],'slot_time_from '=>date( "H:i:s", strtotime($data2['slot_time_from'][$i])),'slot_time_to'=>date( "H:i:s", strtotime($data2['slot_time_to'][$i])));
					//$this->db->insert_batch('tbl_doctor_timeslot',$record);
					//echo $this->db->last_query();
				}
				//date( "H:i:s", strtotime($data2['slot_time_to'][$i]));
				/*echo "<pre>";
				print_r($record);
				echo "</pre>";*/
				$ins=$this->db->insert_batch('tbl_doctor_timeslot',$record);
				if($ins)
				{
					return true;
				}
				
 			}
 		}
 		public function insert_patient($data)
 		{
 			$insert=$this->db->insert('tbl_patient_details',$data);
 			if($insert)
 			{
 				return true;
 			}
 		}
 		
 		public function record_count()
 		{
 			return $this->db->count_all("tbl_doctor_timeslot");
 		}
 		
		public function get_my_data($limit, $start) 
	    {
	    	
	        $this->db->limit($limit, $start);
	       	$this->db->select('doct.*,dept.name as deptname,day.name as day,doct_slot.slot_time_from as fromtime,doct_slot.slot_time_to as totime');

 			$this->db->join('tbl_department as dept','dept.id=doct_slot.fk_department_id');
 			$this->db->join('tbl_day as day','day.id=doct_slot.fk_day_id');
 			$this->db->join('tbl_doctor_details as doct','doct.id=doct_slot.fk_doctor_id');
 			$this->db->from('tbl_doctor_timeslot as doct_slot');
			$query=$this->db->get();
	        //echo $this->db->last_query();die();
	        if ($query->num_rows() > 0) 
	        {
	            foreach ($query->result() as $row) 
	            {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return false;
	   }
	   public function fetch_id($mobile)
	   {
	   		$this->db->where('mobile',$mobile);
	   		$query=$this->db->get('tbl_doctor_details');
	   		//echo $this->db->last_query();die();
	   		$record=$query->row_array();
	   		//echo $record['id'];die();
	   		if($query->num_rows()>0)
	   		{
	   			//echo "enter";die();
	   			$this->db->where('fk_doctor_id',$record['id']);
	   			$this->db->select('doct.*,dept.name as deptname,day.name as day,doct_slot.slot_time_from as fromtime,doct_slot.slot_time_to as totime');

				$this->db->join('tbl_department as dept','dept.id=doct_slot.fk_department_id');
				$this->db->join('tbl_day as day','day.id=doct_slot.fk_day_id');
				$this->db->join('tbl_doctor_details as doct','doct.id=doct_slot.fk_doctor_id');
				$this->db->from('tbl_doctor_timeslot as doct_slot');
				$query2=$this->db->get();
				//echo $query2->num_rows();die();
				if ($query2->num_rows() > 0) 
		        {
		            foreach ($query2->result() as $row) 
		            {
		                $data[] = $row;
		            }
		            return $data;
		        }
		        return false;
				//echo $this->db->last_query();die();
	   		}
	   }
	   public function fetch_patient_id($mobile)
	   {
	   		$this->db->where('mobile',$mobile);
	   		$query=$this->db->get('tbl_patient_details');
	   		//echo $this->db->last_query();die();
	   		if($query->num_rows()>0)
	   		{
	   			return $query->row_array();
	   		}

	   }
	   public function fetch_doctor($p_id)
	   {
	   		$this->db->where('fk_department_id',$p_id);
	   		$query=$this->db->get('tbl_doctor_details');
	   		if($query)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
	   }
	   public function insert_slot($record_data)
	   {
	   		//echo $record_data;
	   		$insert=$this->db->insert('tbl_slot',$record_data);
	   		if($insert)
	   		{
	   			return true;
	   		}
	   		else
	   		{
	   			return false;
	   		}
	   }
	   public function fetch_slottime($doct_id)
	   {
	   		$this->db->where('fk_doctor_id',$doct_id);
	   		$query=$this->db->get('tbl_doctor_timeslot');
	   		//echo $this->db->last_query();
	   		if($query->num_rows()>0)
	   		{
	   			return $query->result_array();
	   		}
	   		else
	   		{
	   			return false;
	   		}
	   }
	   public function fetch_dayName($id)
	   {
	   		$this->db->where('id',$id);
	   		$query=$this->db->get('tbl_day');
	   		if($query->num_rows()>0)
	   		{
	   			return $query->row_array();
	   		}
	   		else
	   		{
	   			return false;
	   		}
	   }
	   public function fetch_avail_slot($doctor_id,$slot_date)
	   {
	   		$data=array('fk_doctor_id'=>$doctor_id,'date'=>$slot_date);
	   		$query=$this->db->get_where('tbl_slot',$data);
	   		//echo $this->db->last_query();

	   		if($query->num_rows()==0)
	   		{
	   			return true;
	   		}
	   		else
	   		{
	   			return false;
	   		}
	   }
	   public function fetch_avail_slottime($doct_id,$slot_date)
	   {
	   		$data=array('fk_doctor_id'=>$doct_id,'date'=>$slot_date);
	   		$query=$this->db->get_where('tbl_slot',$data);
	   		//echo $this->db->last_query();

	   		if($query->num_rows()>0)
	   		{
	   			return $query->result_array();
	   		}
	   		else
	   		{
	   			return false;
	   		}
	   }
	   public function slot_exists($patient_id,$date,$slot_id,$doctor_id)
	   {
	   		$this->db->where('fk_patient_id',$patient_id);
	   		$this->db->where('date',$date);
	   		$query=$this->db->get('tbl_slot');
	   		//echo $this->db->last_query();die();
	   		//echo $query->num_rows();die();
	   		if($query->num_rows()==0)
	   		{
	   			$data=array('fk_patient_id'=>$patient_id,'fk_doctor_id'=>$doctor_id,'fk_slot_id'=>$slot_id);
	   			$insert=$this->db->insert('tbl_appointment',$data);
	   			if($insert)
	   			{
	   				$this->db->where('id', $slot_id);
					$update=$this->db->update('tbl_slot',array('fk_patient_id'=>$patient_id,'status'=>1)); 
					if($update)
					{
						return true;
					}
					
	   			}
	   			
	   		}
	   		else
	   		{
	   			return false;
	   		}
	   }
	   public function fetch_patient_details($patient_id)
	   {
	   		$this->db->where('app.fk_patient_id',$patient_id);
	   		//$this->db->where('slot.status',1);
   			$this->db->select('pat.name as patientname,doct.name as doctorname,slot.date as date,slot.slot_time_from as fromtime,slot.slot_time_to as totime');

			$this->db->join('tbl_doctor_details as doct','doct.id=app.fk_doctor_id');
			$this->db->join('tbl_slot as slot','slot.fk_patient_id=app.fk_patient_id');
			$this->db->join('tbl_patient_details as pat','pat.id=app.fk_patient_id');
			$this->db->from('tbl_appointment as app');
			$query=$this->db->get();
			//echo $this->db->last_query();die();
			if($query->num_rows()>0)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
	   }
	}
?>