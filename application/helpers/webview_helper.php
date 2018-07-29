<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('webview_helper'))
{
    function webview_helper($body_content_data = '',$body_content_page = '',$body_content_header=[],$data,$heared_menu_content='')
    {
      
	  
	  $CI =& get_instance();
	  
	
	 $CI->load->model('menumodel','',TRUE);
	 $CI->load->library('template');
	 /* leftmenu */
	 $left_menu = "";//$CI->leftmenumodel->getLeftmenu($data['user_id'],$data['role_id']);
	 $left_menu = $CI->menumodel->getAllAdministrativeMenu('administartor_menu_master');
		 
	 $data['bodyview'] = $body_content_page;
	 //$data['leftmenusidebar'] = [];
	 $data['headermenu'] = $body_content_header;
	
	 $CI->template->setHeader($heared_menu_content);
	 $CI->template->setBody($body_content_data);
	 $CI->template->setLeftmenu($left_menu);
	
	 
	// $CI->template->view('default_view', array('body'=>$body_content_page,'leftmenu'=>'leftmenu_view'), $data);
	   $CI->template->view('webview/default_web_view', array('body'=>$body_content_page), $data);
		
	
    }   
}