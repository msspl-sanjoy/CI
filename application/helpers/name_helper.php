<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('user_name'))
{
    function user_name($id,$userlevel)
    {
       

       	if($userlevel=='T')
       	{
       		
       		$ci =& get_instance(); //get main CodeIgniter object
       		$ci->load->database();//load database library
       		$query = $ci->db->get_where('master_tbl_teacher',array('id'=>$id));//get the result
       		
       		if($query->num_rows() > 0)
       		{
          		 $result = $query->row_array();
           		 echo $result['name'];
      		}
      		else
      		{
           		return false;
      	 	}
       		
       	}
       	else if($userlevel=='S')
       	{
       		
          $ci =& get_instance(); //get main CodeIgniter object
       		$ci->load->database();//load database library
       		$query = $ci->db->get_where('master_tbl_student',array('id'=>$id));//get the result
       	
       		if($query->num_rows() > 0)
       		{
          		 $result = $query->row_array();
           		 echo $result['name'];
      		}
      		else
      		{
           		return false;
      	 	}
       	}
       	else
       	{
       		echo "Admin";
       	}
    }
}

?>
