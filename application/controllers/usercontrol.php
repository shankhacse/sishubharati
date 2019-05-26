<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usercontrol extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('usercontrolmodel','usercontrolmodel',TRUE);
	   $this->method_call_view =& get_instance();
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/user_control/usercontrol_list_view.php';
			$result = [];
			$header = "";
			$daymonth=date('m-d');
			
            $where = array(
            				'administrator_user_master.id' => $session['userid']
            				
            				 );
            $result['admuser']=$this->commondatamodel->getSingleRowByWhereCls('administrator_user_master',$where);


           $userType=$result['admuser']->usertype;

           if ($userType=='Superadmin' || $userType== 'Developer') {
           $result['userList']=$this->usercontrolmodel->userList();
           }else{
           	$result['userList']=[];
           }
			
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


		public function setStatus(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$updID = trim($this->input->post('uid'));
			$setstatus = trim($this->input->post('setstatus'));
			
			$update_array  = array(
				"is_active" => $setstatus
				);
				
			$where = array(
				"administrator_user_master.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'usercontrol',
					"action" => "Update",
					"from_method" => "usercontrol/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('administrator_user_master',$update_array,$where,'activity_log',$user_activity);
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

}