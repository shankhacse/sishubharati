<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class testcontroller extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
	
		$this->load->model('locationmodel','Locationmodel',TRUE);
	}
	
	
	public function index()
	{
		echo "Test Controller in sub folder";
	}

	
	

}
?>