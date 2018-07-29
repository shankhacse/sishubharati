<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	//	$this->load->library('session');
	    $this->load->model('locationmodel','Locationmodel',TRUE);
	    $this->load->model('webviewmodels/homemodel','homemodel',TRUE);
	    $this->load->model('webviewmodels/testmodel','testModels',TRUE);
	}
	
	
	public function index()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/home_view";

		
		webview_helper($result, $page, $header, $session);
	
	}

	public function gallery()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/gallery";

		
		webview_helper($result, $page, $header, $session);
	
	}

	public function contactus()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/contactus";

		
		webview_helper($result, $page, $header, $session);
	
	}



}