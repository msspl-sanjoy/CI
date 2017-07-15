<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();     
    }
 
    function switchLang($lang) {
        
    	//echo "hii->>".$lang;die();
     
        $this->session->set_userdata('site_lang', $lang);
        
        redirect($_SERVER['HTTP_REFERER']);
        
    }
}
?>