<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');

        if ($siteLang) {
            $ci->lang->load('student_details',$siteLang.'/admin');
          
        } else {
            $ci->lang->load('student_details','english/admin');
           
        }
    }
}