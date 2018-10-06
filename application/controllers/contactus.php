<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contactus extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('birthdaymodel','birthdaymodel',TRUE);
		
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-contactus/contactus_list_view.php';
			$result = [];
			$header = "";
			$where=[];
			$orderby="contactus.created_on desc";
			$result['contactList'] = $this->commondatamodel->getAllRecordWhereOrderBy('contactus',$where,$orderby);
			//pre($result['studentList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


}// end of class