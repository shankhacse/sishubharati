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
     public function aboutus()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/about_us";

		
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


public function login()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/login";

		
		webview_helper($result, $page, $header, $session);
	
	}


	public function noticeboard()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/notice_update";

		
		webview_helper($result, $page, $header, $session);
	
	}


	public function eventupdate()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/event";

		
		webview_helper($result, $page, $header, $session);
	
	}


	public function admissionpage()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/admission";

		
		webview_helper($result, $page, $header, $session);
	
	}



	public function holidaylist()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/holiday_list";
		$result['year']=date('Y');

		$where = array('holidays.year' =>$result['year']);
		    $result['holidays']=$this->commondatamodel->getAllRecordWhereOrderBy('holidays',$where,'holidays.date');

		
		webview_helper($result, $page, $header, $session);
	
	}


	public function importantinfo()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/important_info";

		
		webview_helper($result, $page, $header, $session);
	
	}

/*insert contact*/
public function saveContact()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$name = trim(htmlspecialchars($dataArry['conpername']));
			$email = trim(htmlspecialchars($dataArry['conemail']));
			$phone = trim(htmlspecialchars($dataArry['conphone']));
			$message = trim(htmlspecialchars($dataArry['message']));
			


					$array_insert = array(
						"name" => $name,
						"email" => $email,
						"phone" => $phone,
						"message" => $message
						
					);

				
				$insertData = $this->commondatamodel->insertSingleTableData('contactus',$array_insert);

					
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Your message is successfully send.",
							"mode" => "ADD"
						);
					

				

			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

}// end of class