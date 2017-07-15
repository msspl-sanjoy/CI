<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class Registration_otp_model extends CI_Model 
{
	public function insert($data)
	{
		
		//echo "hii";die();
		$insert=$this->db->insert('tbl_registration',$data);
		if($insert)
		{
			//echo "hii";die();
			$this->db->where('email',$data['email']);
			$query=$this->db->get('tbl_registration');
			//echo $this->db->last_query();die();
			if($query->num_rows()>0)
			{
				$result=$query->row_array();
				//print_r($result);die();
				$user_id=$result['id'];
				$data=array('user_id'=>$user_id,'otp'=>mt_rand(1000,9999));
				$ins=$this->db->insert('tbl_otpfetch',$data);
				if($ins)
				{
					return $result;
				}
				else
				{
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}
	public function email_exits($email)
	{
		$this->db->where('email',$email);
		$query=$this->db->get('tbl_registration');
		if($query->num_rows()>0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	public function login_success($data)
	{
		$this->db->where($data);
		$query=$this->db->get('tbl_registration');
		//echo $this->db->last_query();die();
		if($query->num_rows()>0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	public function fetch_otp($email)
	{
			$this->db->where('user.email',$email);
			$this->db->select('otp.*, user.id as userid');
			$this->db->join('tbl_registration  as user' , 'user.id = otp.user_id', 'left');
			$this->db->from('tbl_otpfetch as otp');
			$query = $this->db->get();
			//echo $this->db->last_query();die();
			//echo $query->num_rows();die();
			if($query->num_rows()>0)
			{
				return $query->row_array();
			}
			else
			{
				return false;
			}
	}
	public function update_password($data)
	{
		//print_r($data['id']);//die();
		$this->db->where('id',$data['id']);
		//unset($data['id']);
		$query=$this->db->update('tbl_registration',$data);
		//echo $this->db->last_query();die();
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function update_profile($id,$data)
	{
		 
		
		$this->db->where('id',$id);
		$update=$this->db->update('tbl_registration',$data);
		//echo $this->db->last_query();die();
		if($update)
		{
			return $update;
		}
	}
	public function fetch_data($id)
	{
		$this->db->where('id',$id);
		$query=$this->db->get('tbl_registration');
		if($query->num_rows()>0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	public function update_status($id)
	{
		
		/*$data=array(array('is_active'=>'0'),array('is_active'=>'1'));
		$this->db->where();
		$this->db->update_batch('tbl_registration', $data);*/ 
		$this->db
	    ->set('is_active', 'CASE WHEN `is_active` = 0 THEN 1 ELSE 0 END', FALSE)
	    ->where('id',$id)
	    ->update('tbl_registration');
		$this->db->last_query();
		return true;
	}
	public function update_user($data)
	{
		$update=$this->db
		 ->where('id',$data['id'])
	    ->update('tbl_registration',$data);
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
}

?>