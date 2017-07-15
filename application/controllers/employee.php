<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Posts Management class created by CodexWorld
 */
class Employee extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('employee_m');
        $this->load->library('Ajax_pagination');
        $this->perPage = 3;
    }
    
    public function index(){
        $data = array();
        
        //total rows count
        $totalRec = count($this->employee_m->getRows());
       // echo $totalRec;die();
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'employee_m/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->employee_m->getRows(array('limit'=>$this->perPage));
        
        //load the view
        $this->load->view('employees/index', $data);
    }
    
    function ajaxPaginationData(){
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = count($this->employee_m->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'employee_m/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->employee_m->getRows(array('start'=>$offset,'limit'=>$this->perPage));
        
        //load the view
        $this->load->view('employees/ajax-pagination-data', $data, false);
    }
}