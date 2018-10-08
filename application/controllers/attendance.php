<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class attendance extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('attendancemodel','attmodel',TRUE);
		
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-attendance/attendance_register_view';
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



	public function addattendance()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$attendanceID = 0;
				$result['attendanceEditdata'] = [];
				$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$attendanceID = $this->uri->segment(3);
				
				$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			}

			$header = "";
			$wheresession = array('session_year.session_id' =>$session['yid']);
			
			
			$page = 'dashboard/adminpanel_dashboard/ds-attendance/entry_attendance_view';
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function getStudentList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$sel_class = $dataArry['sel_class'];
			$session_id=$session['yid'];
			$where = array('class_master.id' => $sel_class);
			$result['classname']=$this->commondatamodel->getSingleRowByWhereCls('class_master',$where);
			$result['studentlistData'] = $this->attmodel->getStudentListByClass($sel_class,$session_id);
			
			//pre($result['studentlistData']);
			$page = "dashboard/adminpanel_dashboard/ds-attendance/student_list_partial_view";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

//get attendance details
public function getRegisterStudentList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$sel_class = $dataArry['sel_class'];
			$session_id=$session['yid'];
			$attendance_date = $dataArry['attendance_date'];


			 if($attendance_date!=""){
				$attendance_date = str_replace('/', '-', $attendance_date);
				$attendance_date = date("Y-m-d",strtotime($attendance_date));
				$result['attdate']=date("d-m-Y",strtotime($attendance_date));
			 }
			 else{
				 $attendance_date = NULL;
				 $result['attdate']="";
			 }





		$where = array('class_master.id' => $sel_class);
			$result['classname']=$this->commondatamodel->getSingleRowByWhereCls('class_master',$where);
		$result['studentlistData'] = $this->attmodel->getAttendanceStudentListByDate($sel_class,$session_id,$attendance_date);
			
			//pre($result['studentlistData']);
			$page = "dashboard/adminpanel_dashboard/ds-attendance/student_register_partial_view";
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
		    $formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			
		
			$session = $this->session->userdata('user_data');
			
			$class_id = $dataArry['sel_class'];
			$studentId = $dataArry['student'];
			$attendance_status = $dataArry['attendance'];
			$class_roll = $dataArry['class_roll'];
			$attendance_date = $dataArry['attendance_date'];
			$no_of_student=count($studentId);

			 if($attendance_date!=""){
				$attendance_date = str_replace('/', '-', $attendance_date);
				$attendance_date = date("Y-m-d",strtotime($attendance_date));
			 }
			 else{
				 $attendance_date = NULL;
			 }
					
				$chk_array = array(
									'attendance_master.taken_date' => $attendance_date, 
									'attendance_master.class_id' => $class_id, 
									'attendance_master.session_id' => $session['yid']
								);
				$check_insert=$this->commondatamodel->checkExistanceData('attendance_master',$chk_array);

				if($check_insert) {
					$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Attendance already submitted for this class and date"
					);
					
				}else{

				$attendance_array = array(
				"taken_date" => $attendance_date,
				"class_id" => $class_id,
				"session_id" => $session['yid'],
				"created_by" => $session['userid']
			    );

			$insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('attendance_master',$attendance_array);
				for ($i=0; $i <$no_of_student ; $i++) { 
					$where_ac = array(
									  'student_academic_details.student_uniq_id' => $studentId[$i],
									  'student_academic_details.session_id' => $session['yid']
									   );

				$academicData=$this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where_ac);
				
				$attendance_details_array = array(
				'attendance_master_id' => $insert_id ,
				'student_uniq_id' => $studentId[$i],
				'attendance_status' => $attendance_status[$i],
				"taken_date" => $attendance_date,
				'class_roll' => $class_roll[$i],
				"academic_id" =>$academicData->academic_id
				
				  );

$insertData=$this->commondatamodel->insertSingleTableData('attendance_details',$attendance_details_array);

				 
				}
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
					
				
				}//end of else    
			
			
				
			//header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;
			
			
		}
		else
		{
			redirect('login','refresh');
		}
	}

public function updateAttendance()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$attdetailsid = $this->input->post('attdetailsid');
			$attendance_status = $this->input->post('attUpdt');
			
			$update_array  = array(
				"attendance_status" => $attendance_status,
				"created_on" => date("Y-m-d")
				);
				
			$where = array(
				"attendance_details.id" => $attdetailsid
				);
			
			
			$user_activity = array(
					"activity_date" => date("Y-m-d H:i:s"),
					"activity_module" => 'Attendance',
					"action" => "Update",
					"from_method" => "attendance/updateAttendance",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform(),
					"login_time" => NULL,
					"logout_time" => NULL
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('attendance_details',$update_array,$where,'user_activity_report',$user_activity);
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Attendance Updated"
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

public function percentage()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-attendance/attendance_percentage_view.php';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['monthList']=$this->commondatamodel->getAllDropdownData('months_master');
			//pre($result['classList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


	//get attendance details with percentage
public function getPescentageStudentList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$sel_class = $dataArry['sel_class'];
			$session_id=$session['yid'];
			$view_by = $dataArry['view_by'];
			$sel_month = $dataArry['sel_month'];
			
			$length = strlen((string)$sel_month);

			if ($length==1) {
				$sel_month="0".$sel_month;
				$result['sel_month']=$sel_month;
			}else{
				$result['sel_month'] = $dataArry['sel_month'];
			}

			$result['session_id']=$session_id;
			$result['sel_class']=$sel_class;
			

             $montlyCount = $this->attmodel->getMonthlyAttendance($sel_month,$sel_class,$session_id);
            
             	$result['monthlyopendays'] = $montlyCount->total;
          

            
             //pre($result['studentlistData']);
             $where = array('class_master.id' => $sel_class);
			$result['classname']=$this->commondatamodel->getSingleRowByWhereCls('class_master',$where);
		    if ($view_by=="M") {
		    	
		     $result['studentlistData']=$this->attmodel->getSudentMonthlyAttendance($sel_month,$sel_class,$session_id);
			$page = "dashboard/adminpanel_dashboard/ds-attendance/attendance_percentage_partial_view";
			}else{

		    $result['studentlistData']=$this->attmodel->getSudentYearlyAttendance($sel_class,$session_id);
			$page = "dashboard/adminpanel_dashboard/ds-attendance/attendance_percentage_partial_view_yearly";
		}
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


public function getAttendanceDetailStudent()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$student_id = trim(htmlspecialchars($this->input->post('studentid')));
			$studentname = trim(htmlspecialchars($this->input->post('studentname')));
			$selectclass = trim(htmlspecialchars($this->input->post('selectclass')));
			$selectmonth = trim(htmlspecialchars($this->input->post('selectmonth')));
			$session_id=$session['yid'];
			
		 $where = array(
		 				'student_academic_details.student_uniq_id' => $student_id,
		 				'student_academic_details.session_id' => $session_id
		 			);

			$result['academicDtl']=$this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where);		
				$academic_id=$result['academicDtl']->academic_id;
		$data['studentattendancedata'] = $this->attmodel->getAttendanceDtlbyStudent($selectmonth,$student_id,$academic_id);
		
		$page = "dashboard/adminpanel_dashboard/ds-attendance/attendance-modal/attendance_information_partial_modal_view";		

				$documentDetailView = $this->load->view($page,$data);
			

			echo $documentDetailView;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}

}//end of class