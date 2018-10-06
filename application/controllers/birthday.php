<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class birthday extends CI_Controller 
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
			$page = 'dashboard/adminpanel_dashboard/ds-birthday/birthday_list_view';
			$result = [];
			$header = "";
			$daymonth=date('m-d');
			$result['studentList']=$this->birthdaymodel->getTodayBirthdayList($session['yid'],$daymonth);
			//pre($result['studentList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


}// end of class