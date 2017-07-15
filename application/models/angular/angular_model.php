<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);
class Angular_Model extends CI_Model
{
 
	 public function __construct()
	 {
	 parent::__construct();
	 }
	 
	 public function AddUser($name,$mobile,$email,$address)
	 {
	  $data = array('name' =>$name,'mobile' =>$mobile,'email' =>$email,'address' =>$address);
	  $this->db->insert('tbl_user_angular',$data);
	  $insert_id = $this->db->insert_id();
	  return $insert_id;
	 }
}
?>
