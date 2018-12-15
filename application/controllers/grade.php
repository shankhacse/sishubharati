<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class grade extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('grademodel','grademodel',TRUE);
	}
	
	
	public function index()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-grade/grade_list_view';
			$result = [];
			$header = "";
			
			$result['gradeList']=$this->grademodel->getGradeList();
			
			//pre($result['gradeList']);
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


}//end of class