<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shortmessage extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('attendancemodel','attmodel',TRUE);
	   $this->load->library('setupfile'); // TextLocal message api

		
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			//$page = 'dashboard/adminpanel_dashboard/ds-attendance/attendance_register_view';
			$page='';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			//pre($result['classList']);


			echo "--------------------- send --------------------<br>";
// Authorisation details.
	$username = "asimsbbm@gmail.com";
	$hash = "abdd277d1be1890409af423c45c359ba0d95890ce35b2314c708280550dd60d7";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "1";

	// Data for text message. This is the text message data.
	$sender = "PBSBBM"; // This is who the message appears to be from.
	$numbers = "917003319369"; // A single number or a comma-seperated list of numbers

	$studentname='Shankha';
	$metdate=date('d-m-Y');
	$meettime='10AM-11AM';

	
    $text='Dear parent of '.$studentname.', you are hereby requested to attend our PTM (Parent Teachers Meeting) on '.$metdate.'between '.$meettime;


	$message = urlencode($text);
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	//$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	echo $result = curl_exec($ch); // This is the result from the API
	curl_close($ch);


			
			//createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}



	public function testmessage(){

		echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~<br>";


		//$this->load->library('setupfile');
			$studentname='Shankha';
			$metdate=date('d-m-Y');
			$meettime='10AM-11AM';

		 $text='Dear parent of '.$studentname.', you are hereby requested to attend our PTM (Parent Teachers Meeting) on '.$metdate.'between '.$meettime;

		 $number=array(9153575808,70033193609);

		try {
	    $result= $this->setupfile->send($number,$text);

	    pre($result);
	    } catch (Exception $e) {
		    die('Error: ' . $e->getMessage());
		}




	}


	public function balance(){
		try {
	    $result= $this->setupfile->getbalance();

	    pre($result);
	    } catch (Exception $e) {
		    die('Error: ' . $e->getMessage());
		}

	}





}// end of class