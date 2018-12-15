<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class message extends CI_Controller {
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
			$page = 'dashboard/adminpanel_dashboard/ds-message/message_list_view';
			$result = [];
			$header = "";
			
			$result['messageList']=$this->messagemodel->getMessageList();
			
			//pre($result['gradeList']);
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


public function replyMessage()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$msgid = $this->input->post('msgid');
			$reply = $this->input->post('reply');
			
			
			$update_array  = array(
				"admin_reply" => $reply,
				"message.is_replied" =>'Y',
				"message.admin_reply_date" =>date("Y-m-d H:i:s")
				
				);
				
			$where = array(
				"message.id" => $msgid
				
				);
			
			
			$user_activity = array(
					"activity_date" => date("Y-m-d H:i:s"),
					"activity_module" => 'message',
					"action" => "Reply",
					"from_method" => "message/messageReply",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform(),
					"login_time" => NULL,
					"logout_time" => NULL
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('message',$update_array,$where,'user_activity_report',$user_activity);
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Fullmarks Updated"
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