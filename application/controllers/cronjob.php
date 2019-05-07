<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cronjob extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		
    }
    
    public function index()
	{ 

			$cron_array = array(
				"capturedate" => date('Y-m-d H:i:s')
				
			    );

			$insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('cronjob',$cron_array);


	}


}