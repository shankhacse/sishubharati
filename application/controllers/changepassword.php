<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class changepassword extends CI_Controller {
 public function __construct()
 {
   parent::__construct();
   
    $this->load->library('session');
    $this->load->dbutil();
    $this->load->helper('file');
    $this->load->helper('download');
   
	
 }

public function index()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$result=[];
			$header = "";
			$page = 'student/dashboard/changepassword/change_password.php';
			
			studentbody_method($result, $page, $header, $session);
				 


		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}



	public function Updatepassword()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			 $json_response = array();
             $formData = $this->input->post('formDatas');
               parse_str($formData, $dataArry);
  
 
 
			$cur_pass =  $dataArry['cur_pass'];
			$password =  $dataArry['password'];
			
			 $student_autoid=$session['student_autoid'];
			 $arrayName = array(
			 					'student_master.student_id' =>$student_autoid ,
			 					'student_master.password' =>$cur_pass 
			 					 );
			$chk=$this->commondatamodel->checkExistanceData('student_master',$arrayName);
				if ($chk) {

					$where_address = array(
							'student_master.student_id' =>$student_autoid
						);
						$update_array  = array(
								'student_master.password' => $password,
							
							);
						$user_activity = array(
						"activity_module" => 'changepassword',
						"action" => 'Update',
						"from_method" => 'changepassword/Updatepassword',
						"user_id" => $session['student_autoid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );

						$update = $this->commondatamodel->updateData_WithUserActivity('student_master',$update_array,$where_address,'user_activity_report',$user_activity);
					
					if($update)
						{
								$json_response = array(
							"msg_status" => 1,
							 "msg_data" => "Updated successfully"
							);
						}
						else
						{
							$json_response = array(
							"msg_status" => 0,
							 "msg_data" => "There is some problem while updating ...Please try again."
							);
						}
				


				 	
				 }else{

				 	$json_response = array(
							"msg_status" => 0,
							 "msg_data" => "Your Current Password is wrong."
							);

				 } 

				//header('Content-Type: application/json');
   				echo json_encode( $json_response );
  				exit;

		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}

}// end of class