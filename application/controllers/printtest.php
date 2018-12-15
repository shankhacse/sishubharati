<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class printtest extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('birthdaymodel','birthdaymodel',TRUE);
		
	}
		
	public function index()
	{
		
			$page = 'dashboard/adminpanel_dashboard/print/print_sample';
			$result = [];
			$header = "";
		
			//pre($result['studentList']);
			
			echo $this->load->view($page,$result,true);
		
		
	}


}// end of class