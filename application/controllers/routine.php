<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class routine extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('routinemodel','routinemodel',TRUE);
		
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-routine/routine_add_edit_view';
			$result = [];
			$header = "";
			
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


	public function addroutine()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$classID = 0;
				$result['routineEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$classID = $this->uri->segment(3);
				$whereAry = array(
					'class_master.id' => $classID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['routineEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('class_master',$whereAry); 
				
			}

			$header = "";
			$wheresession = array('session_year.session_id' =>$session['yid']);
			$result['year']= $this->commondatamodel->getSingleRowByWhereCls('session_year',$wheresession);
		    $result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
		    $result['subjectList']=$this->commondatamodel->getAllDropdownData('subject_master');
		    $result['dayList']=$this->routinemodel->getAllweekDays();
			
			$page = 'dashboard/adminpanel_dashboard/ds-routine/routine_add_edit_view';
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

 
}