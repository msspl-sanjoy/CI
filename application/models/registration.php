<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Model {

	
	public function create($data)
	{
		
		$username= $data['username'];
		$this->db->where('username',$username);
		$log=$this->db->get('tbl_users');
		$login=$log->num_rows();
		
		if($login==0)
		{
			
			$insert=$this->db->insert('tbl_users',$data);
			if($insert)
			{
				return true;
			}
		}
		else
		{
			echo "<script>alert('username already exists')</script>";
		}
		
	}
	public function login($data)
	{
		

		$this->db->where($data);
		$log=$this->db->get('tbl_users');
		$login=$log->num_rows();
		if($login>0)
		{
			return $log->result_array();
		}
		else
		{
			return false;
		}
	}
	public function password($id,$data)
	{
		
		$uid=array('id'=>$id);

		$this->db->where($uid);
		$log=$this->db->get('tbl_users');
		$result=$log->result_array();
		$dbpass=$result[0]['password'];
		$old= $data['old'];
		$new= $data['new'];
	    $confirm= $data['confirm'];
		if($dbpass==$old)
		{
			if($new==$confirm)
			{
				$data=array('password'=>$new);
				$this->db->where('id',$id);
				$update=$this->db->update('tbl_users',$data);
				if($update)
				{
					return $update;
				}
			}
			else
			{
				echo "new and confirm password doesnot match";
			}
		}
		else
		{
			echo "Old pass word doesnot match";
		}
	}
	public function profile($id)
	{
		
		$userid=array('id'=>$id);
		$this->db->where($userid);
		$log=$this->db->get('tbl_users');
		$login=$log->num_rows;
		if($login>0)
		{
			
			return $log->row_array();
		}
		else
		{
			return false;
		}
	}
	public function update_profile($id,$data)
	{
		 
		
		$this->db->where('id',$id);
		$update=$this->db->update('tbl_users',$data);
		if($update)
		{
			return $update;
		}
	}
	public function insert_session($data)
	{
		$insert=$this->db->insert('tbl_user_loginsession',$data);
		if($insert)
		{
			return $insert;
		}
		else
		{
			return false;
		}
	}
	public function delete($id)
	{
		$this->db->where('fk_user_id',$id);
		$delete=$this->db->delete('tbl_user_loginsession');
		if($delete)
		{
			return $delete;
		}
		else
		{
			return false;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */