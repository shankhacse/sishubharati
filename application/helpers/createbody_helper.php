<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('createbody_method'))
{
    function createbody_method($body_content_data = '',$body_content_page = '',$body_content_header='',$data,$heared_menu_content='')
    {
      
	  
	  $CI =& get_instance();
	  
	
	 $CI->load->model('menumodel','',TRUE);
	 $CI->load->model('teachermenumodel','',TRUE);
	 $CI->load->library('template');
	 $CI->load->library('session');
	 /* leftmenu */
	 $session = $CI->session->userdata('user_data');
	 if ($session['role']=='ADMIN') {
	 	 $left_menu = $CI->menumodel->getAllAdministrativeMenu('administartor_menu_master');
	 }else{
	 	 $left_menu = $CI->teachermenumodel->getAllAdministrativeMenu('teacher_menu_master');
	 }
	
     $yearinfo= $CI->menumodel->getSessionYearData();
	
		 
	 $data['bodyview'] = $body_content_page;
	 $data['leftmenusidebar'] = '';
	 $data['headermenu'] = $body_content_header;
	 $data['yearinfo']=$yearinfo;
	
	 $CI->template->setHeader($heared_menu_content);
	 $CI->template->setBody($body_content_data);
	 $CI->template->setLeftmenu($left_menu);
	
	 
	// $CI->template->view('default_view', array('body'=>$body_content_page,'leftmenu'=>'leftmenu_view'), $data);
	   $CI->template->view('default_view', array('body'=>$body_content_page), $data);
		
	
    }   
}