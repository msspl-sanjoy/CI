<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School_model extends CI_Model
 	{

		public function login($data)
		{
			$this->db->where($data);
			$login=$this->db->get('tbl_user');
			//echo $this->db->last_query();
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
			$this->db->select('stu.*, scl.name as schoolname');
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
		public function teacher_assign($studentid)
		{
			$this->db->where('rel.fk_student_id',$studentid);
			$this->db->select('rel.*, teach.id as teacherid,teach.name as teachername,teach.mobile as teachermobile,teach.email as teacheremail,teach.address as teacheraddress');
			$this->db->join('master_tbl_teacher as teach' , 'teach.id = rel.fk_teacher_id', 'left');
			$this->db->from('tbl_relation as rel');
			$query = $this->db->get();
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
		public function teacher_details($user_id)
		{
			
			$this->db->where('teach.id',$user_id);
			$this->db->select('teach.*, scl.name as schoolname');
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
		public function student_assign($user_id)
		{
			$this->db->where('rel.fk_teacher_id',$user_id);
			$this->db->select('rel.*, stu.id as stuid,stu.name as stuname,stu.mobile as studentmobile,stu.email as studentemail,stu.address as stuaddress');
			$this->db->join('master_tbl_student as stu' , 'stu.id = rel.fk_student_id', 'left');
			$this->db->from('tbl_relation as rel');
			$query = $this->db->get();
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
		public function fetch_all_students($id)
		{
			
			$this->db->select('stu.*');
			$this->db->from('master_tbl_student as stu');
			$this->db->join('master_tbl_teacher as teach','stu.fk_school_id=teach.fk_school_id','left');
			$this->db->where("stu.id NOT IN(select fk_student_id from tbl_relation  where fk_teacher_id='".$id."')");
			$this->db->where('teach.id',$id);
			
			$query=$this->db->get();
			//echo $this->db->last_query(); die();
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
		public function fetch_all_teachers($id)
		{
			$this->db->select('teach.*');
			$this->db->from('master_tbl_teacher as teach');
			$this->db->join('master_tbl_student as stu','stu.fk_school_id=teach.fk_school_id','left');
			$this->db->where("teach.id NOT IN(select fk_teacher_id from tbl_relation where fk_student_id='".$id."')");
			$this->db->where('stu.id',$id);
			$query=$this->db->get();
			//echo $this->db->last_query(); die();
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
		public function insert_assign_students($teacherid,$stid)
		{
			$data=array('fk_teacher_id'=>$teacherid,'fk_student_id'=>$stid);
			$insert=$this->db->insert('tbl_relation',$data);
			if($insert)
			{
				return $insert;
			}
			else
			{
				return false;
			}
		}
		public function insert_assign_teacher($studentid,$teacid)
		{
			$data=array('fk_student_id'=>$studentid,'fk_teacher_id'=>$teacid);
			$insert=$this->db->insert('tbl_relation',$data);
			if($insert)
			{
				return $insert;
			}
			else
			{
				return false;
			}
		}
		public function update($data)
		{
			$this->db->where('id', $data['id']);
			unset($data['id']);
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
		public function update_student($data)
		{
			$this->db->where('id', $data['id']);
			unset($data['id']);
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