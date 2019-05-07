<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class logout extends CI_Controller {
 public function __construct()
 {
   parent::__construct();
    
    $this->load->library('session');
	
 }
	
 public function index()
 {
      if ($this->session->userdata('user_data')) {
      	$session = $this->session->userdata('user_data');
      	$role=$session['role'];
            $this->session->sess_destroy();
            if ($role=='ADMIN') {
            	redirect('administratorpanel', 'refresh');
            }else{
            redirect('teacher/login', 'refresh');	
            }
            
          

      }else{
          redirect('administratorpanel', 'refresh');
        
      }
 }

 public function studentlogout()
 {
      if ($this->session->userdata('student_data')) {

        $session = $this->session->userdata('student_data');
        $details_upd = array('logouttime' => date("Y-m-d H:i:s") );
        $where = array('student_activity.id' => $session['activity_id'] );

        $this->commondatamodel->updateDataSingleTable('student_activity',$details_upd,$where);

            $this->session->sess_destroy();
            redirect('studentlogin', 'refresh');
          

      }else{
          redirect('studentlogin', 'refresh');
        
      }
 }

}