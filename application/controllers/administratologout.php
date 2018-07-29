<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class administratologout extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	
	public function logoutadministrator()
	{
		if($this->session->userdata('user_data')) 
		{
			$session = $this->session->userdata('user_data');
			$userid = $session['userid'];
			$ses_destroy = $this->session->sess_destroy();
			
				$update_array  = array(
					"last_logout" => date("Y-m-d H:i:s"),
					"is_looged_in" => FALSE
				);
				
				$where_admin_user = array(
					"administrator_user_master.id" => $userid
				);
			
				$user_activity = array(
				"activity_date" => date("Y-m-d H:i:s"),
				"activity_module" => 'AdministratorLogout',
				"action" => "Logout",
				"from_method" => "administratologout/logoutadministrator",
				"user_id" => $userid,
				"ip_address" => getUserIPAddress(),
				"user_browser" => getUserBrowserName(),
				"user_platform" => getUserPlatform(),
				"login_time" => NULL,
				"logout_time" => date("Y-m-d H:i:s")
				);
			
				$update = $this->commondatamodel->updateData_WithUserActivity('administrator_user_master',$update_array,$where_admin_user,'user_activity_report',$user_activity);
			
				
				
				redirect('administratorpanel', 'refresh');
			
		}
		else
		{
           redirect('administratorpanel', 'refresh');
		}
	}

}