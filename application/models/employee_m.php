<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_m extends CI_Model{

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_employee');
        $this->db->order_by('id','desc');
        //echo $this->db->last_query();
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

}