<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sorting_model extends CI_Model
 	{
 		public function search($limit,$offset,$sort_by,$sort_order)
 		{
 			
 			$ret=array();
 			$sort_order=($sort_order=='desc')?'desc':'asc';
 			$sort_column=array('id','employee_name','employee_age','employee_salary');
 			$sort_by=(in_array($sort_by,$sort_column))?$sort_by:
 			'employee_name';

 			//fetching result
 			$q=$this->db->select('id,employee_name,employee_age,employee_salary')
 			  ->from('tbl_employee')
 			  ->limit($limit,$offset)
 			  ->order_by($sort_by,$sort_order);
 			$ret['rows']=$this->db->get()->result();
 			// counting result
 			$q=$this->db->select('count(*) as COUNT ',FALSE)
 			  ->from('tbl_employee');
 			$tmp=$q->get()->result();
 			$ret['num_rows']=$tmp[0]->COUNT;
 			return $ret;
 		}
 	}
?>