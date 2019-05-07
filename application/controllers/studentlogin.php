<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class studentlogin extends CI_Controller {
 public function __construct()
 {
   parent::__construct();
    $this->load->model('studentloginmodel','studentloginmodel',TRUE);
    $this->load->library('session');
	
 }
	
 public function index()
 {
     
     $page = 'student/student_login';
     $this->load->view($page);
 }
 
 
 /**
  * @method login
  * @date:06/10/2018
  * @chek student panel login by Student Id and dob
  * */
 public function login(){
 $studentid = $this->input->post("studentid");
 $password = $this->input->post("pwd");
 $json_response=array();
 if($studentid!="" && $password!=""){

    
	

     $result=  $this->studentloginmodel->verifyStudentLogin($studentid,$password);
     if(sizeof($result)>0 && !empty($result)){
        

        /*----------------- student login record ----------*/

          $user_activity = array(
            "student_uniq_id" => $result['studentID'],
            "academic_id" => $result['academicID'],
            "academic_session_id" => $result['academic_session_id'],
            "activity_date" => date("Y-m-d"),
            "activity_module" => 'Student login',
            "action" => 'Login',
            "from_method" => 'studentlogin/login',
            "logintime" => date("Y-m-d H:i:s"),
            "ip_address" => getUserIPAddress(),
            "user_browser" => getUserBrowserName(),
            "user_platform" => getUserPlatform()
           );

      $activity_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('student_activity',$user_activity);

        $sessionData = array(
        "student_autoid" => $result['student_autoid'],
        "studentID" => $result['studentID'],
        "academicID" => $result['academicID'],    
        "academic_session_id" => $result['academic_session_id'],    
        "logintime" => date("Y-m-d H:i:s"),
        "activity_id" => $activity_id,
        "token" => $this->getSecureToken()
      );
        $this->setSessionData($sessionData);




         $json_response = array("msg_code"=>1,"msg_data"=>"");
     }else{
          $json_response = array("msg_code"=>3,"msg_data"=>"Incorrect mobilenumber or password");
     }
 
 }else{
	   $json_response = array("msg_code"=>0,"msg_data"=>"Student ID or password cannot be blank");
	
           
           
 }
	 header("Access-Control-Allow-Origin: *");
	

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
        $this->session->set_userdata("student_data",$result);
   }
 }
 

	

}