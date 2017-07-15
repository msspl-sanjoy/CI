<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
 	{
 		public function update_student($data,$id)
		{
			$this->db->where('id', $id);
			unset($data['userlevel']);
			$update=$this->db->update('master_tbl_student', $data); 
			//echo $this->db->last_query();die();
			if($update)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		public function update_teacher($data,$id)
		{
			$this->db->where('id', $id);
			unset($data['userlevel']);
			$update=$this->db->update('master_tbl_teacher', $data); 
			//echo $this->db->last_query();die();
			if($update)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		public function user_insert($data)
		{
			
			
			$userlevel=$data['userlevel'];
			if($data['userlevel'] == 'T')
			{
				
				unset($data['userlevel']);
				$insert=$this->db->insert('master_tbl_teacher',$data);
				$insert_id = $this->db->insert_id();

			} 
			else 
			{
				
				unset($data['userlevel']);
				$insert=$this->db->insert('master_tbl_student',$data);
				$insert_id = $this->db->insert_id();
				
			}
			if($insert)
			{
					//echo "bye";die();
					$data1=array('username'=>$data['email'],'user_level'=>$userlevel,'fk_user_id'=>$insert_id);
					//print_r($data1);die();
					$ins=$this->db->insert('tbl_user',$data1);
					if($ins)
					{
						return true;
					}
			}
		}
 	}
 ?>