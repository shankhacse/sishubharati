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


	/* certificate view*/		
	public function bonafide()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-student_action/bonafide_list_view';
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


	/* get student info for bonafied*/
	public function getStudentInfoBonafied()
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
							$data['academic_id'] =$academic_id=$dataArry['sel_student_id'];
							$data['studentdata'] = $this->studentaction->getStudentAdmissionInformationbyId($academic_id,$session['yid']);
			           
							}else{
									

				           $data['studentdata']=[];
							}

			}else{
				
					if (isset($dataArry['sel_student_name'])) {
							$data['academic_id'] = $academic_id=$dataArry['sel_student_name'];
							$data['studentdata'] = $this->studentaction->getStudentAdmissionInformationbyId($academic_id,$session['yid']);
			           
							}else{
									

				           $data['studentdata']=[];
							}
			}
			
				
		
				//pre($data['studentdata']);

			
			$page = "dashboard/adminpanel_dashboard/ds-student_action/student_bonafied_data";
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
			$result['nextclassline']  = $this->input->post('nextclassline');
			$result['nextclass']  = $this->input->post('nextclass');
			$result['printdate']  = $this->input->post('printdate');
			$result['needsign']  = $this->input->post('needsign');


			$tcrequest_array = array(
				'student_uniq_id' => $result['student_uniq_id'] ,
				'studentname' => $result['studentname'] ,
				'session_year' => $result['session'] ,
				'currentclass' => $result['currentclass'],
				'certificate_type' => 'TRANSFER',
				'created_by' => $session['userid'],
				'role' => $session['role'] 
				
				 );
               /* delete old data*/
				$delete_where = array(
										'transfer_certificate_request.student_uniq_id' => $result['student_uniq_id'],
										'certificate_type' => 'TRANSFER'
										 );

				$this->commondatamodel->DeleteData('transfer_certificate_request',$delete_where);

		$inserData=$this->commondatamodel->insertSingleTableData('transfer_certificate_request',$tcrequest_array);
		

		$page = 'dashboard/adminpanel_dashboard/ds-student_action/print_view_tc';

		
         //$result['studentInfo']=$this->marksmodel->getStudentInfo($academic_id);


		
			
		
		echo $this->load->view($page,$result,true);
		
        

			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	/* print character certifacate details*/
public function printCharacterCertificate()
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
			$result['years']  = strtolower($this->input->post('years'));
			$result['dob']  = strtolower($this->input->post('dob'));
			$academic_id  = strtolower($this->input->post('academic_id'));
			$result['needpicture']  = $this->input->post('needpicture');
			$result['currentclass']  = $this->input->post('currentclass');
			$result['session']  = $this->input->post('session');
			$result['needpicture']  = $this->input->post('needpicture');
			$result['printdate']  = $this->input->post('printdate');
			$result['needsign']  = $this->input->post('needsign');

			$result['studentdata'] = $this->studentaction->getStudentAdmissionInformationbyId($academic_id,$session['yid']);
			


			$tcrequest_array = array(
				'student_uniq_id' => $result['student_uniq_id'] ,
				'studentname' => $result['studentname'] ,
				'session_year' => $result['studentdata']->year ,
				'currentclass' => $result['studentdata']->current_class,
				'certificate_type' => 'CHARACTER',
				'created_by' => $session['userid'],
				'role' => $session['role'] 
				
				 );

				/* delete old data*/
				$delete_where = array(
										'transfer_certificate_request.student_uniq_id' => $result['student_uniq_id'],
										'certificate_type' => 'CHARACTER'
										 );

				$this->commondatamodel->DeleteData('transfer_certificate_request',$delete_where);

		$inserData=$this->commondatamodel->insertSingleTableData('transfer_certificate_request',$tcrequest_array);
		

		$page = 'dashboard/adminpanel_dashboard/ds-student_action/print_view_tc_character';

		
         //$result['studentInfo']=$this->marksmodel->getStudentInfo($academic_id);


		
			
		
		echo $this->load->view($page,$result,true);
		
        

			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



/* Leaving certificate view */

	public function leaving()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-student_action/leaving_list_view';
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

		/* get student info for leaving*/
	public function getStudentInfoLeaving()
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
							$data['academic_id'] =$academic_id=$dataArry['sel_student_id'];
							$data['studentdata'] = $this->studentaction->getStudentAdmissionInformationbyId($academic_id,$session['yid']);
			           
							}else{
									

				           $data['studentdata']=[];
							}

			}else{
				
					if (isset($dataArry['sel_student_name'])) {
							$data['academic_id'] = $academic_id=$dataArry['sel_student_name'];
							$data['studentdata'] = $this->studentaction->getStudentAdmissionInformationbyId($academic_id,$session['yid']);
			           
							}else{
									

				           $data['studentdata']=[];
							}
			}
			
				
		
				//pre($data['studentdata']);

			
			$page = "dashboard/adminpanel_dashboard/ds-student_action/student_leaving_data";
			$partial_view = $this->load->view($page,$data);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


		/* print Leaving Certificate details*/
public function printLeavingCertificate()
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
			$academic_id  = strtolower($this->input->post('academic_id'));
			$result['student_uniq_id']  = $this->input->post('student_uniq_id');
			$result['studentname']  = strtolower($this->input->post('studentname'));
			$result['fathername']  = strtolower($this->input->post('fathername'));
			$result['mothetname']  = strtolower($this->input->post('mothetname'));
			$result['village']  = strtolower($this->input->post('village'));
			$result['police_station']  = strtolower($this->input->post('police_station'));
			$result['districname']  = strtolower($this->input->post('districname'));
			$result['statename']  = strtolower($this->input->post('statename'));
			$result['statename']  = strtolower($this->input->post('statename'));
			$result['nationality']  = strtolower($this->input->post('nationality'));
			$result['category']  = strtolower($this->input->post('category'));
			$result['admission_dt']  = strtolower($this->input->post('admission_dt'));
			$result['admission_class']  = strtolower($this->input->post('admission_class'));
			$result['date_of_birth']  = strtolower($this->input->post('date_of_birth'));
			$result['current_class']  = strtolower($this->input->post('current_class'));
			$result['last_exam']  = strtolower($this->input->post('last_exam'));
			$result['subjects']  = strtolower($this->input->post('subjects'));
			$result['ispromote']  = strtolower($this->input->post('ispromote'));
			$result['promotion']  = strtolower($this->input->post('promotion'));
			$result['lastpaid']  = strtolower($this->input->post('lastpaid'));
			$result['games']  = strtolower($this->input->post('games'));
			$result['gencon']  = strtolower($this->input->post('gencon'));
			$result['dtaplcertificate']  = strtolower($this->input->post('dtaplcertificate'));
			$result['issuedate']  = strtolower($this->input->post('issuedate'));
			$result['leavingreason']  = strtolower($this->input->post('leavingreason'));
			$result['identification']  = strtolower($this->input->post('identification'));
			$result['otherremarks']  = strtolower($this->input->post('otherremarks'));
			$result['needpicture']  = $this->input->post('needpicture');
			$result['printdate']  = $this->input->post('printdate');
			$result['needsign']  = $this->input->post('needsign');
		//exit;
			

			$result['studentdata'] = $this->studentaction->getStudentAdmissionInformationbyId($academic_id,$session['yid']);
			


			$tcrequest_array = array(
				'student_uniq_id' => $result['student_uniq_id'] ,
				'studentname' => $result['studentname'] ,
				'session_year' => $result['studentdata']->year ,
				'currentclass' => $result['studentdata']->current_class,
				'certificate_type' => 'LEAVING',
				'created_by' => $session['userid'],
				'role' => $session['role'] 
				
				 );

				/* delete old data*/
				$delete_where = array(
										'transfer_certificate_request.student_uniq_id' => $result['student_uniq_id'],
										'certificate_type' => 'LEAVING'
										 );

				$this->commondatamodel->DeleteData('transfer_certificate_request',$delete_where);

		$inserData=$this->commondatamodel->insertSingleTableData('transfer_certificate_request',$tcrequest_array);
		

		$page = 'dashboard/adminpanel_dashboard/ds-student_action/print_view_tc_leaving_certificate';

		
         //$result['studentInfo']=$this->marksmodel->getStudentInfo($academic_id);


		
			
		
		echo $this->load->view($page,$result,true);
		
        

			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


}//end of class