<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_school_model extends CI_Model
 	{
	
		public function login($data)
		{
			$this->db->where($data);
			$login=$this->db->get('tbl_user');
			$count=$login->num_rows();
			if($count>0)
			{
				return $login->result_array();
			}
			else
			{
				return false;
			}
		}
		public function student_details($user_id)
		{
			
			$this->db->where('stu.id',$user_id);
			$this->db->select('stu.*, scl.name as schoolname,scl.id as schoolid');
			$this->db->join('tbl_school_admin as scl' , 'scl.id = stu.fk_school_id', 'left');
			$this->db->from('master_tbl_student as stu');
			

			$query = $this->db->get();
			//echo $this->db->last_query();die();
			$count=$query->num_rows();
			if($count=1)
			{
				return $query->row_array();
			}
			else
			{
				return false;
			}
		}
		public function teacher_details($user_id)
		{
			
			$this->db->where('teach.id',$user_id);
			$this->db->select('teach.*, scl.name as schoolname,scl.id as schoolid');
			$this->db->join('tbl_school_admin as scl' , 'scl.id = teach.fk_school_id', 'left');
			$this->db->from('master_tbl_teacher as teach');
			

			$query = $this->db->get();
			//echo $this->db->last_query();die();
			$count=$query->num_rows();
			if($count=1)
			{
				return $query->row_array();
			}
			else
			{
				return false;
			}
		}
		public function school_details($user_id)
		{
			
			$this->db->where('id',$user_id);
				

			$query = $this->db->get('tbl_school_admin');
			//echo $this->db->last_query();die();
			$count=$query->num_rows();
			if($count=1)
			{
				return $query->row_array();
			}
			else
			{
				return false;
			}
		}
		public function fetch_all_school()
		{
			$query=$this->db->get('tbl_school_admin');
			$count=$query->num_rows();
			if($count>0)
			{
				return $query->result_array();
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
					
					$data1=array('username'=>$data['email'],'user_level'=>$userlevel,'fk_user_id'=>$insert_id);
					$ins=$this->db->insert('tbl_user',$data1);
					if($ins)
					{
						return true;
					}
			}
		}
		
		public function school_insert($data)
		{
			$insert=$this->db->insert('tbl_school_admin',$data);
			if($insert)
			{
				return true;
			}
			else
			{
				return false; 
			}
		}
		public function fetch_student()
		{
			$this->db->select('stu.*,scl.name as schoolname,scl.address as schooladdress,user.user_level as status,user.is_block as block');
			$this->db->join('tbl_school_admin as scl', 'scl.id = stu.fk_school_id','left');
			$this->db->join('tbl_user as user',"stu.id=user.fk_user_id and user.user_level='S'",'inner' );
			$this->db->from('master_tbl_student as stu');
			$query = $this->db->get();
			$count=$query->num_rows();
			if($count>0)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		public function fetch_teacher()
		{
			$this->db->select('stu.*,scl.name as schoolname,scl.address as schooladdress,user.user_level as status,user.is_block as block');
			$this->db->join('tbl_school_admin as scl', 'scl.id = stu.fk_school_id','left');			
			$this->db->join('tbl_user as user',"stu.id=user.fk_user_id and user.user_level='T'",'inner' );
			$this->db->from('master_tbl_teacher as stu');
			$query = $this->db->get();
			$count=$query->num_rows();
			if($count>0)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		public function change_status($data)
		{
			
			$this->db->set('is_block',$data['is_block']);
			$this->db->where('fk_user_id', $data['fk_user_id']);
			$query=$this->db->update('tbl_user');
			//echo $this->db->last_query();
			if($query)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		public function school_view()
		{
			$result=$this->db->get('tbl_school_admin');
			$count=$result->num_rows();

			if($count>0)
			{
				return $result->result_array();
			}
			else
			{
				return false;
			}
		}
		public function school_view_list($id)
		{
			$this->db->where('id',$id);
			$query=$this->db->get('tbl_school_admin');
			$count=$query->num_rows();
			if($count=1)
			{
				return $query->row_array();
			}
			else
			{
				return false;
			}
		}
		public function teacher_view_list($id)
		{
			$this->db->where('fk_school_id',$id);
			$query=$this->db->get('master_tbl_teacher');
			$count=$query->num_rows();
			if($count=1)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		public function student_view_list($id)
		{
			$this->db->where('fk_school_id',$id);
			$query=$this->db->get('master_tbl_student');
			$count=$query->num_rows();
			if($count=1)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
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
		public function update_school($data,$id)
		{
			$this->db->where('id', $id);
			unset($data['userlevel']);
			$update=$this->db->update('tbl_school_admin', $data); 
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
		public function fetch_country()
		{
			$this->db->where('parent_id',0);
			$result=$this->db->get('tbl_country');
			//echo $this->db->last_query();die();
			if($result)
			{
				return $result->result_array();
			}
			else
			{
				return false;
			}
		}
		public function fetch_state($p_id)
		{
			$this->db->where('parent_id',$p_id);
			$query=$this->db->get('tbl_country');
			//echo $this->db->last_query();die();
			if($query)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		public function fetch_city($p_id)
		{
			$this->db->where('parent_id',$p_id);
			$query=$this->db->get('tbl_country');
			//echo $this->db->last_query();die();
			if($query)
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