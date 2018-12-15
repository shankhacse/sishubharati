<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	//	$this->load->library('session');
	    $this->load->model('locationmodel','Locationmodel',TRUE);
	    $this->load->model('webviewmodels/homemodel','homemodel',TRUE);
	    $this->load->model('birthdaymodel','birthdaymodel',TRUE);
	    $this->load->model('noticemodel','noticemodel',TRUE);
	    $this->load->model('eventsmodel','eventsmodel',TRUE);
	    $this->load->model('importantinfomodel','impinfo',TRUE);
	    $this->load->model('gallerymodel','gallerymodel',TRUE);
	}
	
	
	public function index()
	{
		
		$session = [];
		$header = [];
		$result = [];
		$year=date('Y');
		$daymonth=date('m-d');

		$where = array(
						'session_year.year' =>$year,
						
					);
		$result['SessionYearData']= $this->commondatamodel->getSingleRowByWhereCls('session_year',$where);
			

			if ($result['SessionYearData']) {
				$latest_session_id=$result['SessionYearData']->session_id;
				$result['birthdayStudentListToday']=$this->birthdaymodel->getTodayBirthdayList($latest_session_id,$daymonth);
			}else{
				$result['birthdayStudentListToday']=[];
			}


			$result['NoticeList'] = $this->noticemodel->getAllActiveNoticeList();
			$result['EventsList'] = $this->eventsmodel->getAllActiveEventsListLimit();
			

		//pre($result['birthdayStudentListToday']);
		$page = "webview/dswv-home/home_view";

		
		webview_helper($result, $page, $header, $session);
	
	}

	public function gallery()
	{

		$session = [];
		$header = [];
		$result = [];
		$result['imageList'] = $this->gallerymodel->getAllImageList();
			$result['albumList']=$this->commondatamodel->getAllDropdownData('album_master');
		$page = "webview/dswv-home/gallery";

		
		webview_helper($result, $page, $header, $session);
	
	}
     public function aboutus()
	{

		$session = [];
		$header = [];
		$result = [];
		$page = "webview/dswv-home/about_us";

		$where = array(
						'about_us.id' =>1,
						
					);
		$result['aboutUsData']= $this->commondatamodel->getSingleRowByWhereCls('about_us',$where);

		
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
		$result['NoticeList'] = $this->noticemodel->getAllActiveNoticeList();
		$page = "webview/dswv-home/notice_update";

		
		webview_helper($result, $page, $header, $session);
	
	}


	public function eventupdate()
	{

		$session = [];
		$header = [];
		$result = [];
		$result['EventsList'] = $this->eventsmodel->getAllActiveEventsList();
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
		$result['infoList'] = $this->impinfo->getAllActiveInfoList();
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