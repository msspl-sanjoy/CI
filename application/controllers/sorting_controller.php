<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

	class Sorting_controller extends CI_Controller 
	{
		public function sorting($sort_by='employee_name',$sort_order='asc',$offset=0)
		{
			$limit=10;
			$data=array();
			$data['fields']=array(
				'id'=>'ID',
				'employee_name'=>'Name',
				'employee_salary'=>'Salary',
				'employee_age'=>'Age'
				);
			$this->load->model('sorting_model');
			$results=$this->sorting_model->search($limit,$offset,$sort_by,$sort_order);
			$data['employee']=$results['rows'];
			$data['num_records']=$results['num_rows'];	
			//pagination start
			$this->load->library('pagination');
			$config=array();
			$config['base_url']=site_url("sorting_controller/sorting/$sort_by/$sort_order");
			$config['total_rows']=$data['num_records']	;
			$config['per_page']=$limit;
			$config['uri_segment']=5;

			$this->pagination->initialize($config);
			/*echo "<pre>";
			print_r($this->pagination);die();*/
			$data['page_links']=$this->pagination->create_links();
			//print_r($data['page_links']);die();
			//pagination end 

			$this->load->view('sorting_page',$data);
		}
			
	}

?>
