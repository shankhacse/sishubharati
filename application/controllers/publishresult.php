<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class publishresult extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		 $this->load->model('publishresultmodel','publishresultmodel',TRUE);
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			$result['termList'] = $this->publishresultmodel->termList($session['yid']); 
			$page = "dashboard/adminpanel_dashboard/ds-result_publish/term_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function setStatus(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$updID = trim($this->input->post('uid'));
			$setstatus = trim($this->input->post('setstatus'));
			
			$update_array  = array(
				"is_publish" => $setstatus
				);
				
			$where = array(
				"result_publish.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Result Publish',
					"action" => "Update",
					"from_method" => "publishresult/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('result_publish',$update_array,$where,'user_activity_report',$user_activity);
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Status updated"
				);
			}
			else
			{
				$json_response = array(
					"msg_status" => 0,
					"msg_data" => "Failed to update"
				);
			}


		header('Content-Type: application/json');
		echo json_encode( $json_response );
		exit;

		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

}// end of class