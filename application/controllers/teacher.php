<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class teacher extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
			$this->load->model('loginmodel','',TRUE);
		$this->load->model('teachermodel','teachermodel',TRUE);
		 $this->load->model('attendancemodel','attmodel',TRUE);
	}

public function login()
 {
    $page = 'loginpanel/teacher_login';
	$result['year'] = $this->loginmodel->getAcademicYear();
	
	$this->load->view($page,$result);
 }

public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$result['teacherList'] = $this->teachermodel->getAllTeachersList();
			

			/*echo "<pre>";
			print_r($result['NoticeList']);
			echo "</pre>";*/
			//exit;

			$page = "dashboard/adminpanel_dashboard/ds-teacher/teachers_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}// teacher index

	public function nonstaff()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$result['nonstaffList'] = $this->teachermodel->getAllNonStaffList();
			

			/*echo "<pre>";
			print_r($result['NoticeList']);
			echo "</pre>";*/
			//exit;

			$page = "dashboard/adminpanel_dashboard/ds-teacher/nonstaff_list_view.php";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}// teacher index


public function addTeacher()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$teacherID = 0;
				$result['teacherEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$teacherID = $this->uri->segment(3);
				
				$result['teacherEditdata']=$this->teachermodel->getTeachersByTeacherId($teacherID);

			
			}

			$header = "";
			
			$page = "dashboard/adminpanel_dashboard/ds-teacher/teachers_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}//add teacher close


	public function saveTeacher()
	{
		if($this->session->userdata('user_data'))
		{


			$user_activity = array();
			$tbl_name = array();
		
			$session = $this->session->userdata('user_data');
			$teacherID = trim($this->input->post('teacherID'));
			$mode = trim($this->input->post('mode'));
		
			
		
			
		    $docType = '2';
			$userFilename = $this->input->post('userFileName');
			$fileDesc = $this->input->post('fileDesc');

			$teacherdob=$this->input->post('teacherdob');
			 if($teacherdob!=""){
				$teacherdob = str_replace('/', '-', $teacherdob);
				$teacherdob = date("Y-m-d",strtotime($teacherdob));
			 }
			 else{
				 $teacherdob = NULL;
		    }
		

			$teacher_array = array(
				"teacherID" => $teacherID,
				"mode" => $mode,
				"teacher" => $this->input->post('teacher'),
				"subject" => $this->input->post('subject'),
				"employee_type" => $this->input->post('sel_emptype'),
				"date_of_birth" => $teacherdob,
				"password" => md5($teacherdob),
				
			
			
				"docType" => $docType,
				"userFilename" => $userFilename,
				"docFile" => $_FILES,
				"fileDesc" => $fileDesc
			);


			if($teacherID>0 && $mode=="EDIT")
			{
				$isFileChanged = $this->input->post('isChangedFile');
				$randomFileName = $this->input->post('randomFileName');
				$prvFilename = $this->input->post('prvFilename');
				$docDetailIDs = $this->input->post('docDetailIDs');
				
				$teacher_array_edit_info = array(
					'isChangedFile' => $isFileChanged ,
					'randomFileName' => $randomFileName, 
					'prvFilename' => $prvFilename, 
					'docDetailIDs' => $docDetailIDs 
				);
//pre($teacher_array_edit_info);exit;
				$teacher_array_new = array_merge($teacher_array,$teacher_array_edit_info);

				$updateData = $this->teachermodel->updateTeacher($teacher_array_new,$session);

				
				if($updateData)
				{
					$json_response = array(
						"msg_status" => 1,
						"msg_data" => "Updated successfully"
					);
				}
				else
				{
					$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : There is some problem while saving ...Please try again."
					);
				}		
			}
			else
			{
				
				$isFileChanged = $this->input->post('isChangedFile');
				
				
				$teacher_array_add_info = array(
					'isChangedFile' => $isFileChanged 
				);
				

				$teacher_array_new_add = array_merge($teacher_array,$teacher_array_add_info);
				
				$insertData = $this->teachermodel->inserIntoTeacher($teacher_array_new_add,$session);
				if($insertData)
				{
					$json_response = array(
						"msg_status" => 1,
						"msg_data" => "Saved successfully"
					);
				}
				else
				{
					$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : There is some problem while saving ...Please try again."
					);
				}				
					
				
				    
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



public function setStatus(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$updID = trim($this->input->post('uid'));
			$setstatus = trim($this->input->post('setstatus'));
			
			$update_array  = array(
				"is_active" => $setstatus
				);
				
			$where = array(
				"teachers.teacher_id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Teacher',
					"action" => "Update",
					"from_method" => "teacher/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('teachers',$update_array,$where,'user_activity_report',$user_activity);
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


public function attendance()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$where = array(
						'teachers.is_active' =>1,
						'teachers.employee_type' =>'TEACHER' 
					);
			$result['teacherList'] = $this->commondatamodel->getAllRecordWhere('teachers',$where);

			$wherenonstaff = array(
						'teachers.is_active' =>1,
						'teachers.employee_type' =>'NONSTAFF' 
					);
			$result['nonstaffList'] = $this->commondatamodel->getAllRecordWhere('teachers',$wherenonstaff);
			

			// echo "<pre>";
			// print_r($result['teacherList']);
			// echo "</pre>";
			//exit;

			$page = "dashboard/adminpanel_dashboard/ds-teacher/teacher_entry_attendance_view.php";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}// teacher attendance


  public function getTeacherDetails()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result['mode'] = "EDIT";
			$result['btnText'] = "Save";
			$result['btnTextLoader'] = "Saving...";

			$result['view_by'] = $dataArry['view_by'];
			if ($dataArry['view_by']=='T') {
				$result['teacherID'] = $dataArry['sel_teacher'];
			}else{
				$result['teacherID'] = $dataArry['sel_nonstaff'];
			}
			
			$result['teacherattendID'] = 0;
			$session_id=$session['yid'];
			$result['teacherEditdata']=$this->teachermodel->getTeachersByTeacherId($result['teacherID']);
		
			$page = "dashboard/adminpanel_dashboard/ds-teacher/teachers_attendance_partial_view";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

public function saveAttendance()
	{
		if($this->session->userdata('user_data'))
		{
			$notice_array = array();
			$user_activity = array();
			$tbl_name = array();
		
			$session = $this->session->userdata('user_data');
			$teacherattendID = trim($this->input->post('teacherattendID'));
			$teacherID = trim($this->input->post('teacherID'));
			$mode = trim($this->input->post('mode'));
			$attdate = trim($this->input->post('attdate'));

			 if($attdate!=""){
				$attdate = str_replace('/', '-', $attdate);
				$attdate = date("Y-m-d",strtotime($attdate));
			 }
			 else{
				 $attdate = NULL;
			 }
			
		    $attdate;
			$intime = trim($this->input->post('intime'));
			$outtime = trim($this->input->post('outtime'));

			$whereatt = array(
								'teacher_attendance.att_date' => $attdate,
								'teacher_attendance.teacher_master_id' => $teacherID
								 );


			$check = $this->commondatamodel->duplicateValueCheck('teacher_attendance',$whereatt);
		

			$att_array = array(

				"teacher_master_id" => $teacherID,
				"att_date" => $attdate,
				"in_time" => $intime,
				"out_time" => $outtime,
				"created_by" => $session['userid'],
				"role" => $session['role']
				
			);

			if(!$check){
			if($teacherattendID>0)
			{
				
				
				

				$updateData = 1;
				if($updateData)
				{
					$json_response = array(
						"msg_status" => 1,
						"msg_data" => "Updated successfully"
					);
				}
				else
				{
					$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : There is some problem while saving ...Please try again."
					);
				}		
			}
			else
			{
				
				
				
				$insertData = $this->commondatamodel->insertSingleTableData('teacher_attendance',$att_array);
				if($insertData)
				{
					$json_response = array(
						"msg_status" => 1,
						"msg_data" => "Saved successfully"
					);
				}
				else
				{
					$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : There is some problem while saving ...Please try again."
					);
				}				
					
				
				    
			}


		}else{

			$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : Already exist..."
					);

		}

			
				
			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;
			
			
		}
		else
		{
			redirect('login','refresh');
		}
	}


	public function register()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-teacher/attendance_register_view';
			$result = [];
			$header = "";
			$where = array('teachers.is_active' => '1' );
			$result['teacherList'] = $this->commondatamodel->getAllRecordWhere('teachers',$where);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


//get attendance details
public function getTeacherAttendanceList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$sel_teacher = $dataArry['sel_teacher'];;
			$session_id=$session['yid'];
			$fromdate = $dataArry['fromdate'];
			$todate = $dataArry['todate'];


			 if($fromdate!=""){
				$fromdate = str_replace('/', '-', $fromdate);
				$fromdate = date("Y-m-d",strtotime($fromdate));
				$result['fromdate']=date("d-m-Y",strtotime($fromdate));
			 }
			 else{
				 $fromdate = NULL;
				 $result['fromdate']="";
			 }

			 if($todate!=""){
				$todate = str_replace('/', '-', $todate);
				$todate = date("Y-m-d",strtotime($todate));
				$result['todate']=date("d-m-Y",strtotime($todate));
			 }
			 else{
				 $todate = NULL;
				 $todate['fromdate']="";
			 }

            $result['teacherAttendance']=[];
            $result['teacherAttendanceCount']=[];

            $result['schoolOpenData']=$this->teachermodel->getSchoolOpenDates($fromdate,$todate);
			if ($sel_teacher!=0) {
			$result['teacherAttendance'] = $this->teachermodel->getTeacherAttendanceById($sel_teacher,$fromdate,$todate);
			
			}else{
				$result['teacherAttendanceCount'] = $this->teachermodel->getTeacherAttendanceCount($fromdate,$todate);
			}

			$page = "dashboard/adminpanel_dashboard/ds-teacher/teacher_register_partial_view";


			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	public function deleteTeacherAttendance()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$teacherattid = trim($this->input->post('teacherattid'));
			
			
				
			$where_delete = array(
				"teacher_attendance.id" => $teacherattid
				);
			
			
			
			
				$delete = $this->commondatamodel->DeleteData('teacher_attendance',$where_delete);
				
			if($delete)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Successfully deleted"
				);
			}
			else
			{
				$json_response = array(
					"msg_status" => 0,
					"msg_data" => "Failed to delete"
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



}//teacher controller close