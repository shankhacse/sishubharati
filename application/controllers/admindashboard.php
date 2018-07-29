<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admindashboard extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
		
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-home/dashboard-home';
			$result = [];
			$header = "";
			$where = array('session_year.session_id' =>$session['yid'] );
		    $result['academicsession']=$this->commondatamodel->getAllRecordWhere('session_year',$where);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}

 
}