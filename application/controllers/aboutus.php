<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class aboutus extends CI_Controller {
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
			$page = 'dashboard/adminpanel_dashboard/ds-aboutus/aboutus_list_view.php';
			$result = [];
			$header = "";
			
			$where = array(
                'about_us.id' =>1,
                
            );
            $result['aboutUsData']= $this->commondatamodel->getSingleRowByWhereCls('about_us',$where);
			
			//pre($result['aboutUsData']);
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


public function updateAboutus(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$aboutusid = $this->input->post('aboutusid');
			$columnname = $this->input->post('columnname');
			$history = $this->input->post('history');
			$mission = $this->input->post('mission');
			$vision = $this->input->post('vision');
			
			if ($columnname=='History') {
				$update_array  = array("history" => $history);
			}elseif ($columnname=='Mission') {
				$update_array  = array("mission" => $mission);
			}elseif ($columnname=='Vision') {
				$update_array  = array("vision" => $vision);
			}
			
				
			$where = array(
				"about_us.id" => $aboutusid
				);
			
			
			$user_activity = array(
					"activity_module" => 'About Us',
					"action" => "Update",
					"from_method" => "aboutus/updateAboutus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('about_us',$update_array,$where,'user_activity_report',$user_activity);
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => $columnname." updated"
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


}//end of class