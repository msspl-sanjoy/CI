<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);
class Angular_controller extends CI_Controller
{
   public function __construct()
   {
       parent::__construct();
       $this->load->model('angular/angular_model');
   }
   public function index()
   {
     //$data['include'] = 'angular/index';
    $this->load->view('angular/index');
   } 
   
   public function add()
    {
     // Here you will get data from angular ajax request in json format so you have to decode that json data you will get object array in $request variable
   
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $name = $request->name;
        //echo $name;die();
        $mobile = $request->mobile;
        // echo $mobile;die();
        $email=$request->email;
        //echo $email;die();
        $address=$request->address;
        $id = $this->angular_model->AddUser($name,$mobile,$email,$address);
        if($id)
        {
           echo $result = '{"status" : "success"}';
        }
        else
        {
           echo $result = '{"status" : "failure"}';
        }
    }
}
?>