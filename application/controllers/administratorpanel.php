<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class administratorpanel extends CI_Controller {
 public function __construct()
 {
   parent::__construct();
	$this->load->model('loginmodel','',TRUE);
    $this->load->library('session');
	
 }
	
 public function index()
 {
    $page = 'loginpanel/admin_login';
	$result['year'] = $this->loginmodel->getAcademicYear();
	
	$this->load->view($page,$result);
 }

 
 public function verifyLogin()
 {
	$json_response = array();
	$formData = $this->input->post('formDatas');
	parse_str($formData, $dataArry);
	$username =  htmlspecialchars($dataArry['username']);
	$password =  md5(htmlspecialchars($dataArry['password']));
	$year =  htmlspecialchars($dataArry['year']);
	$result=[];
	
	$verify_data = array(
		"username" => $username,
		"password" => $password
		
	);
	
	if($username=="" OR $password=="")
	{
		$json_response = array(
			 "msg_status" => 0,
			 "msg_data" => "All fields are required"
		);
		
	}
	else
	{
		$result = $this->loginmodel->verifyLogin($verify_data);
		if(sizeof($result)>0 && !empty($result))
		{
			$sessionData = array(
				"username" => $result['username'],
				"yid" => $year,
				"userid" => $result['userid'],
				"logintime" => date("Y-m-d H:i:s"),
				"security_token" => $this->getSecureToken()
			);
			
			
			
			$this->setSessionData($sessionData);
			$session = $this->session->userdata('user_data');
			
			
			$update_array  = array(
				"last_login" => date("Y-m-d H:i:s"),
				"is_looged_in" => TRUE
				);
				
			$where_admin_user = array(
				"administrator_user_master.id" => $session['userid']
				);
			
			
			$user_activity = array(
					"activity_date" => date("Y-m-d H:i:s"),
					"activity_module" => 'AdministratorLogin',
					"action" => "Login",
					"from_method" => "administratorpanel/verifyLogin",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform(),
					"login_time" => date("Y-m-d H:i:s"),
					"logout_time" => NULL
					
				);
			
			$update = $this->commondatamodel->updateData_WithUserActivity('administrator_user_master',$update_array,$where_admin_user,'user_activity_report',$user_activity);
			
			
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Logged in successfully..."
				);
			}
			
		}
		else
		{
			$json_response = array(
				"msg_status" => 0,
				 "msg_data" => "Invalid login data.Please check your login details..."
			);
		}
		
	}
	
	header('Content-Type: application/json');
    echo json_encode( $json_response );
	exit;
	
 }
 
 private function getSecureToken()
 {
	$token="";
	$token = openssl_random_pseudo_bytes(16);
	$token = bin2hex($token);
	return $token;
 }
 
 
 
 private function setSessionData($result=NULL){
   
   if($result)
   { 
        $this->session->set_userdata("user_data",$result);
   }
 }
 

	

}