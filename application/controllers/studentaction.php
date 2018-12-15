<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class studentaction extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('studentactionmodel','studentaction',TRUE);
	}
	
	
	public function index()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-student_action/priented_transfer_certificate_list_view.php';
			$result = [];
			$header = "";
			
			$result['studentList']=$this->commondatamodel->getAllDropdownData('transfer_certificate_request');
			
			//pre($result['gradeList']);
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function studentclassview()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-student_action/class_student_list_view';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			//pre($result['classList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}

	public function classStudentList()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			

			$result=[];
			
			if (isset($dataArry['sel_class'])) {
				$sel_class = $dataArry['sel_class'];
				
			$result['studentList'] = $this->studentaction->getAllStudentsbyClass($session['yid'],$sel_class); 	
           
			}else{
					

           $result['studentList']=[];
			}


			
			$page = "dashboard/adminpanel_dashboard/ds-student_action/class_student_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function resetpassword(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$studentid = trim($this->input->post('studentid'));
			$defaultpass = trim($this->input->post('defaultpass'));
			
			$update_array  = array(
				"password" => $defaultpass
				);
				
			$where = array(
				"student_master.student_id" => $studentid
				);
			
			
			$user_activity = array(
					"activity_module" => 'Studentaction',
					"action" => "Update",
					"from_method" => "studentaction/resetpassword",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('student_master',$update_array,$where,'activity_log',$user_activity);
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Status updated"
				);
			}
			else
			{
				$json_response = array(
					"msg_status" => 0,
					"msg_data" => "Failed to update"
				);
			}


		header('Content-Type: application/json');
		echo json_encode( $json_response );
		exit;

		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



/* certificate view*/		
	public function certificate()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-student_action/certificate_list_view';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['StudentIdList']=$this->studentaction->getStudentIdList($session['yid']);
			//pre($result['StudentIdList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


	/* get student info for tc*/
	public function getStudentInfo()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			$sel_type_searchby=$dataArry['sel_type_searchby'];
			if ($sel_type_searchby=='SID') {
				
				if (isset($dataArry['sel_student_id'])) {
							$academic_id=$dataArry['sel_student_id'];
							$data['studentdata'] = $this->studentaction->getStudentAdmissionInformationbyId($academic_id,$session['yid']);
			           
							}else{
									

				           $data['studentdata']=[];
							}

			}else{
				
					if (isset($dataArry['sel_student_name'])) {
							$academic_id=$dataArry['sel_student_name'];
							$data['studentdata'] = $this->studentaction->getStudentAdmissionInformationbyId($academic_id,$session['yid']);
			           
							}else{
									

				           $data['studentdata']=[];
							}
			}
			
				
		
				//pre($data['studentdata']);

			
			$page = "dashboard/adminpanel_dashboard/ds-student_action/student_tc_data";
			$partial_view = $this->load->view($page,$data);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

/* print payment details*/
public function printTC()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			
			$result['gender'] = $this->input->post('gender');
			if ($result['gender']=='M') {
				$result['sondaughter']='Son';
				$result['heshe']='He';
				$result['hisher']='his';
				$result['hisherb']='His';
			}else{
				$result['sondaughter']='Daughter';
				$result['heshe']='She';
				$result['hisher']='her';
				$result['hisherb']='Her';
			}
			$result['student_uniq_id']  = $this->input->post('student_uniq_id');
			$result['studentname']  = strtolower($this->input->post('studentname'));
			$result['fathername']  = strtolower($this->input->post('fathername'));
			$result['mothetname']  = strtolower($this->input->post('mothetname'));
			$result['admclassname']  = $this->input->post('admclassname');
			$result['admissiondt']  = $this->input->post('admissiondt');
			$result['dob']  = $this->input->post('dob');
			$result['nationality']  = $this->input->post('nationality');
			$result['state']  = $this->input->post('state');
			$result['district']  = $this->input->post('district');
			$result['village']  = strtolower($this->input->post('village'));
			$result['caste']  = $this->input->post('caste');
			$result['currentclass']  = $this->input->post('currentclass');
			$result['session']  = $this->input->post('session');


			$tcrequest_array = array(
				'student_uniq_id' => $result['student_uniq_id'] ,
				'studentname' => $result['studentname'] ,
				'session_year' => $result['session'] ,
				'currentclass' => $result['currentclass'] 
				
				 );

				

		$inserData=$this->commondatamodel->insertSingleTableData('transfer_certificate_request',$tcrequest_array);
		

		//$page = 'dashboard/adminpanel_dashboard/ds-student_action/print_view_tc';
		$page = 'dashboard/adminpanel_dashboard/ds-student_action/print_view_tc_water';

		
         //$result['studentInfo']=$this->marksmodel->getStudentInfo($academic_id);


		
			
		
		echo $this->load->view($page,$result,true);
		
        

			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

}//end of class