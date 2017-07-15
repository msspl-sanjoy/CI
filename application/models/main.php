<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Model
 	{

		public function school_insert($data)
		{
			$insert=$this->db->insert('tbl_school',$data);
			if($insert)
			{
				return $insert;
			}
			else
			{
				return false;
			}
		}
		public function school_view()
		{
			$result=$this->db->get('tbl_school');
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
		public function schoolid_fetch()
		{
			$this->db->select('id,name');
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
		public function teacher_insert($data)
		{
			$insert=$this->db->insert('master_tbl_teacher',$data);
			if($insert)
			{
				return $insert;
			}
			else
			{
				return false;
			}
		}
		public function student_insert($data)
		{
			$insert=$this->db->insert('master_tbl_student',$data);
			if($insert)
			{
				return $insert;
			}
			else
			{
				return false;
			}
		}
		public function teacher_view()
		{
			$this->db->select('teac.*, scl.name as schoolname,scl.address as schooladdress');
			$this->db->join('tbl_school as scl' , 'scl.id = teac.fk_school_id', 'left');
			$this->db->from('tbl_teacher as teac');
			

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
		public function student_view()
		{
			$this->db->select('stu.*,scl.name as schoolname,scl.address as schooladdress');
			$this->db->join('tbl_school as scl', 'scl.id = stu.fk_school_id','left');
			$this->db->from('tbl_student as stu');
			

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
		public function school_view_list($id)
		{
			$this->db->where('id',$id);
			$query=$this->db->get('tbl_school');
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
			$query=$this->db->get('tbl_teacher');
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
			$query=$this->db->get('tbl_student');
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
		public function teacher_details($teacherid)
		{
			$this->db->where('teac.id',$teacherid);
			$this->db->select('teac.*, scl.name as schoolname,scl.address as schooladdress');
			$this->db->join('tbl_school_admin as scl' , 'scl.id = teac.fk_school_id', 'left');
			$this->db->from('master_tbl_teacher as teac');
			

			$query = $this->db->get();
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
		public function student_assign($teacherid)
		{
			$this->db->where('rel.fk_teacher_id',$teacherid);
			$this->db->select('rel.*, stu.id as studentid,stu.name as stuname,stu.mobile as studentmobile,stu.email as studentemail,stu.address as stuaddress');
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
		public function assign_student($id)
		{
			$this->db->where('id',$id);
			$this->db->select('fk_school_id');
			$this->db->from('tbl_teacher');
			$query=$this->db->get();
			$count=$query->num_rows();
			if($count>0)
			{
				return $query->result_array;
			}
			else
			{
				return false;
			}
		}
		/*public function fetch_schoolid($id)
		{
			$query=$this->db->get_where('tbl_teacher',array('id'=>$id));
			$count=$query->num_rows();
			if($count)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		public function student_fetch($schoolid)
		{
			$query=$this->db->get_where('tbl_student',array('fk_school_id'=>$schoolid));
			$count=$query->num_rows();
			if($count)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		public function fetch_unassignstudent($id,$data)
		{
				
				
		}*/
		public function fetch_all_students($id)
		{
			/*$this->db->select('stu.*');
            $this->db->from('tbl_student as stu'); 
            $this->db->join('tbl_school as sch', 'sch.id=stu.fk_school_id', 'left');
            $this->db->join('tbl_teacher as teac', 'teac.fk_school_id=sch.id', 'left');
            $this->db->where('teac.id',$id);      
            $query = $this->db->get(); 
            $count=$query->num_rows();
            if($count>0)
            {
            	return $query->result_array();
            }
            else
            {
            	return false;
            }*/
            /*$this->db->select('stu.*');
			$sub = $this->subquery->start_subquery('select');
			$sub->select('rel.fk_student_id')->from('tbl_relation as rel');
			$sub->where('rel.fk_teacher_id',$id);
			$this->subquery->end_subquery('sub');
			$this->db->from('tbl_student as stu');
			$this->db->where('id', '1');*/

			/*$this->db->select('rel.fk_student_id')->from('tbl_relation as rel')->where('rel.fk_teacher_id',$id);
			$subQuery =  $this->db->get_compiled_select();
			$query=$this->db->select('stu.*')
			         ->from('tbl_student as stu')
			         ->where("stu.id  NOT IN ($subQuery)", NULL, FALSE)
			         ->get();
			         
			$count=$query->num_rows();
			if($count>0)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}*/

			/*$this->db->select('stu.*')->from('tbl_student as stu')->where('stu.id  NOT IN ($sub)');
			$sub = $this->subquery->start_subquery('select');
			$sub->select('rel.fk_student_id')->from('tbl_relation as rel')->where('rel.fk_teacher_id',$id);
			$this->subquery->end_subquery('subq'); 
			$query=$this->db->get();
			$count=$query->num_rows();
			if($count>0)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}*/
			



			$this->db->select('stu.*');
			$this->db->from('tbl_student as stu');
			$this->db->join('tbl_teacher as teach','stu.fk_school_id=teach.fk_school_id','left');
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
		public function student_details($studentid)
		{
			$this->db->where('stu.id',$studentid);
			$this->db->select('stu.*, scl.name as schoolname,scl.address as schooladdress');
			$this->db->join('tbl_school_admin as scl' , 'scl.id = stu.fk_school_id', 'left');
			$this->db->from('master_tbl_student as stu');
			

			$query = $this->db->get();
		
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
		public function fetch_all_teachers($id)
		{
			$this->db->select('teach.*');
			$this->db->from('tbl_teacher as teach');
			$this->db->join('tbl_student as stu','stu.fk_school_id=teach.fk_school_id','left');
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
	}
?>