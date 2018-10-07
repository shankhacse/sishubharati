<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('studentbody_method'))
{
    function studentbody_method($body_content_data = '',$body_content_page = '',$body_content_header='',$data,$heared_menu_content='')
    {
      
	  
	  $CI =& get_instance();
	
	  $CI->load->model('studentmenumodel','',TRUE);
	  
	  if($CI->session->userdata('student_data'))
	  {
		 $session = $CI->session->userdata('student_data');
		 
		 // user_info
		 $user_tbl = 'student_master';
		 $where_user = array(
			"student_master.student_uniq_id" => $session['studentID']
		 );
		 $data['studentData'] = $CI->commondatamodel->getSingleRowByWhereCls($user_tbl,$where_user);
		 
		
	  }
	  else
	  {
		  
	  }
	  
	
	// $CI->load->model('leftmenumodel','',TRUE);
	 $CI->load->library('template');
	 /* leftmenu */
	 $left_menu = $CI->studentmenumodel->getAllAdministrativeMenu('student_menu_master');
		 
	 $data['bodyview'] = $body_content_page;
	 $data['leftmenusidebar'] = '';
	 $data['headermenu'] = $body_content_header;
	
	 $CI->template->setHeader($heared_menu_content);
	 $CI->template->setBody($body_content_data);
	 $CI->template->setLeftmenu($left_menu);
	
	 
	// $CI->template->view('default_view', array('body'=>$body_content_page,'leftmenu'=>'leftmenu_view'), $data);
	   $CI->template->view('student/default_view_student', array('body'=>$body_content_page), $data);
		
	
    }   
}