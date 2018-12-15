<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admindashboard extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('messagemodel','messagemodel',TRUE);
		
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
		    $result['totalStudent']=$this->commondatamodel->rowcount('student_master');
		    $result['totalClass']=$this->commondatamodel->rowcount('class_master');
		    $result['totalSubject']=$this->commondatamodel->rowcount('subject_master');

		    $where = array('session_year.session_id' =>$session['yid']);
			$result['sessionData']= $this->commondatamodel->getSingleRowByWhereCls('session_year',$where);

			$result['message']=$this->messagemodel->replyPending();

			$where_acd_dtl = array(
				'student_academic_details.session_id' =>$session['yid'], 
				'student_academic_details.is_active' =>'Y' 
			);

			 $result['totalStudent']=$this->commondatamodel->rowcountwhere('student_academic_details',$where_acd_dtl);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


	public function DashboardCalender()
	{
		if($this->session->userdata('user_data')){
		
		




				$json_response = array(
		        "msg_status" => 1,
		        "year" => date("Y"),
		        "day" => date("d"),
		        "month" => date("M"),
		        "time" => date("h:i:s:A"),
		       
		      );

			 header('Content-Type: application/json');
	   		 echo json_encode( $json_response );
	 		 exit;
			}else
			{
				redirect('userlogin','refresh');
			}
		}

 



}//end of class