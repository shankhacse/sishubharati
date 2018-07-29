<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
    }
	
	
	 public function index()
	{
		if($this->session->userdata('user_data')){
		$session = $this->session->userdata('user_data');
		$page = 'dashboard/ds-home/dashboard-home';
		$result = "";
		$header = "";
		createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('login','refresh');
		}
	}

 
	
}