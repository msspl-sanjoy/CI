<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagination_model extends CI_Model
 	{
 		public function record_count()
 		{
 			return $this->db->count_all("master_tbl_teacher");
 		}
 		
		public function get_my_data($limit, $start) 
		    {
		    	
		        $this->db->limit($limit, $start);
		        $query = $this->db->get("master_tbl_teacher");

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
	}

?>