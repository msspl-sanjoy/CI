<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class Pagination_controller extends CI_Controller
 {
 	
		 public function teacher_pagination() 
			{
				$this->load->model('pagination_model');
		        $config = array();
		        $config["base_url"] = base_url() . "index.php/pagination_controller/teacher_pagination";
		      	
		      	$config["total_rows"] = $this->pagination_model->record_count();
		        $config["per_page"] = 2;
		        $config["uri_segment"] = 3;
		        $this->pagination->initialize($config);
		        //echo $this->url->segment(3);die();
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		        $data["results"] = $this->pagination_model->get_my_data($config["per_page"], $page);
		        $data["links"] = $this->pagination->create_links();

		        $this->load->view("pagination_view.php", $data);
		    }
			
 }
 ?>