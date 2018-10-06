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
            $this->session->sess_destroy();
            redirect('administratorpanel', 'refresh');
          

      }else{
          redirect('administratorpanel', 'refresh');
        
      }
 }

}