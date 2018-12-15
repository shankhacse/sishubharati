<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class studentdashboard extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('admissionmodel','admmodel',TRUE);
	    $this->load->model('routinemodel','routinemodel',TRUE);
	    $this->load->model('studentdashboardmodel','studentdash',TRUE);
	    $this->load->model('paymentomodel','paymentomodel',TRUE);
	    $this->load->model('marksmodel','marksmodel',TRUE);

	      $this->highest_marks_method_call_view =& get_instance();
		
	}
		
	public function index()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/ds-home/student_home';
			
			$result = [];
			$header = "";
			$where = array('student_master.student_uniq_id' =>$session['studentID']);
			$result['studentData']= $this->commondatamodel->getSingleRowByWhereCls('student_master',$where);

			$result['academicData']=$this->studentdash->getStudentAcademicDetailsbyId($session['academicID']);
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}

	public function test()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/ds-home/test';
			
			$result = [];
			$header = "";
			$where = array('student_master.student_uniq_id' =>$session['studentID']);
			$result['studentData']= $this->commondatamodel->getSingleRowByWhereCls('student_master',$where);
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}

	public function profile()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$result = [];
			$header = "";

			$page = 'student/dashboard/profile/student_profile_view';
				$data['documentDetailData'] = $this->admmodel->getStudentProfilePicture($session['student_autoid'],"Admission");
				
				$data['uplodedFolder'] = "admission_upload" ;

				$where = array(
								'student_master.student_id' => $session['student_autoid'], 
								'student_academic_details.session_id' => $session['academic_session_id'] 
							);
				$data['studentdata'] = $this->admmodel->getStudentAdmissionInformationbyId($where);
			
			
			studentbody_method($data, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}


	public function class_routine()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/class_routine/class_routine_data.php';
			
			$result = [];
			$header = "";
			$where = array('student_academic_details.academic_id' =>$session['academicID']);
			$studentData= $this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where);

			$student_class=$studentData->class_id;
			$student_session_id=$studentData->session_id;


			$where_class = array('class_master.id' =>$student_class);
			$classData= $this->commondatamodel->getSingleRowByWhereCls('class_master',$where_class);
			$result['studentClass']=$classData->name;


			$where_session = array('session_year.session_id' =>$student_session_id);
			$sessionData= $this->commondatamodel->getSingleRowByWhereCls('session_year',$where_session);
			$result['year']=$sessionData->year;


			$result['routineList'] = $this->routinemodel->getRoutinebyClass($student_class,$student_session_id); 
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}


public function attendance()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/attendance/student_attendence_view';
			
			$result = [];
			$header = "";
			 
			$result['studentAttendance']= $this->studentdash->getStudentAttendanceByMonth($session['studentID'],$session['academicID']);
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}

	public function attendancedetailbymonth()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/attendance/student_attendence_detail_view';
			
			$result = [];
			$header = "";
			
			$month = $this->uri->segment(3);
			$year = $this->uri->segment(4);
			
			
			$result['studentAttDetail'] = $this->studentdash->getStudentAttendanceDetailByMonthAndYear($session['studentID'],$session['academicID'],$month,$year);
			$result['month'] = $month;
			$result['year'] = $year;
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}
 

/* get student paymeny history working on 30.09.2018*/
	public function payments()
	{
		$session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data') )
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			$header='';
			$result['paymentList'] = $this->paymentomodel->getPaymentList($session['academicID']);
			  
			//pre($result['paymentList']);exit;
			$page = "student/dashboard/payments/payment_history_list_data";
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}

	/* get bill details data*/		
	public function getBillDetailData()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$data = [];
			

			$page = 'student/dashboard/payments/bill_details_partial_modal_view.php';
			$paymentid = $this->input->post('paymentid');
			$paymentfor = $this->input->post('paymentfor');
			$data['billno'] = $this->input->post('billno');

			$where = array('payment_master.payment_master_id' => $paymentid);
			$paymentData=$this->commondatamodel->getSingleRowByWhereCls('payment_master',$where);

			$bill_master_id=$paymentData->bill_master_id;
			$data['student_uniq_id']=$paymentData->student_uniq_id;


			
			$data['billDetails']=$this->paymentomodel->getBillDetailsData($bill_master_id);
			$BillDetailView = $this->load->view($page,$data);
			

			echo $BillDetailView;
			
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}


public function exammarks()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/exam/exam_list_view';
			
			$result = [];
			$header = "";
			 
			$where = array(
								'result_publish.is_publish' => 'Y',
								'result_publish.session_id' => $session['academic_session_id']
								 );
			$orderby="result_publish.id";
			$result['termList'] = $this->commondatamodel->getAllRecordWhereOrderBy('result_publish',$where,$orderby);
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}

	/* for  individuals term marks*/
	public function getStudentTermMarks()
	{   $session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data'))
		{
				$formData = $this->input->post('formDatas');
		    	parse_str($formData, $dataArry);
		    	$result=[];
                $result['term'] = $dataArry['term'];
                /*if ($result['term']=='First') {
                	echo "string";
                }*/
			   
			    

			

                $academic_id=$session['academicID'];
			
				$where = array('student_academic_details.academic_id' => $academic_id);
					$result['academicData']=$this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where);
					$result['studentInfo']=$this->marksmodel->getStudentInfo($academic_id);

					
					if ($result['academicData']) {
						
					$first_term_data=$result['academicData']->first_term_data;	
					$first_term_master_id=$result['academicData']->first_term_master_id;

					$second_term_data=$result['academicData']->second_term_data;	
					$second_term_master_id=$result['academicData']->second_term_master_id;	

					$third_term_data=$result['academicData']->third_term_data;	
					$third_term_master_id=$result['academicData']->third_term_master_id;

						if ($result['term']=='First') {
							$result['term_marks']=$this->marksmodel->getMarksDetails($first_term_master_id);

							$where_marks_mst= array('marks_master.marks_master_id' => $first_term_master_id );
				
							$marksMasterData=$this->commondatamodel->getSingleRowByWhereCls('marks_master',$where_marks_mst);
							if ($marksMasterData) {
							
							$result['attendance']=$marksMasterData->attendance;
							$result['sporting']=$marksMasterData->sporting;
							$result['discipline']=$marksMasterData->discipline;
							$result['cultural_efficiency']=$marksMasterData->cultural_efficiency;
						    }else{
						    	$result['attendance']="";
								$result['sporting']="";
								$result['discipline']="";
								$result['cultural_efficiency']="";
						    }


						}elseif ($result['term']=='Second') {
							$result['term_marks']=$this->marksmodel->getMarksDetails($second_term_master_id);

							$where_marks_mst= array('marks_master.marks_master_id' => $second_term_master_id );
				
							$marksMasterData=$this->commondatamodel->getSingleRowByWhereCls('marks_master',$where_marks_mst);
							if ($marksMasterData) {
							
							$result['attendance']=$marksMasterData->attendance;
							$result['sporting']=$marksMasterData->sporting;
							$result['discipline']=$marksMasterData->discipline;
							$result['cultural_efficiency']=$marksMasterData->cultural_efficiency;
							}else{
						    	$result['attendance']="";
								$result['sporting']="";
								$result['discipline']="";
								$result['cultural_efficiency']="";
						    }

						}elseif ($result['term']=='Third') {
							$result['term_marks']=$this->marksmodel->getMarksDetails($third_term_master_id);

							$where_marks_mst= array('marks_master.marks_master_id' => $third_term_master_id );
				
							$marksMasterData=$this->commondatamodel->getSingleRowByWhereCls('marks_master',$where_marks_mst);
							if ($marksMasterData) {
							$result['attendance']=$marksMasterData->attendance;
							$result['sporting']=$marksMasterData->sporting;
							$result['discipline']=$marksMasterData->discipline;
							$result['cultural_efficiency']=$marksMasterData->cultural_efficiency;
							}else{
						    	$result['attendance']="";
								$result['sporting']="";
								$result['discipline']="";
								$result['cultural_efficiency']="";
						    }

						}else{
							$result['term_marks']=[];
							$result['attendance']="";
							$result['sporting']="";
							$result['discipline']="";
							$result['cultural_efficiency']="";
						}
					
					
					

					//pre($result['term_marks']);
				}else{
					$result['term_marks']=[];
					
				}

			
			
			


			//pre($result['paymentList']);exit;
			$page = "student/dashboard/exam/student_marks_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}


	public function exampaper()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/paper/paper_list_view';
			
			$result = [];
			$header = "";
			 
			$where = array(
								'result_publish.is_publish' => 'Y',
								'result_publish.session_id' => $session['academic_session_id']
								 );
			$orderby="result_publish.id";
			$result['termList'] = $this->commondatamodel->getAllRecordWhereOrderBy('result_publish',$where,$orderby);
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}


/**/
/* for  individuals term marks*/
	public function getStudentExamPapers()
	{   $session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data'))
		{
				$formData = $this->input->post('formDatas');
		    	parse_str($formData, $dataArry);
		    	$result=[];
                $result['term'] = $dataArry['term'];
                /*if ($result['term']=='First') {
                	echo "string";
                }*/
			   
			    

			
                $moduleTag='ExamPaper';
                $academic_id=$session['academicID'];
			
				$where = array('student_academic_details.academic_id' => $academic_id);
					$result['academicData']=$this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where);
					$result['studentInfo']=$this->marksmodel->getStudentInfo($academic_id);

					
					if ($result['academicData']) {
						
					$first_term_data=$result['academicData']->first_term_data;	
					$first_term_master_id=$result['academicData']->first_term_master_id;

					$second_term_data=$result['academicData']->second_term_data;	
					$second_term_master_id=$result['academicData']->second_term_master_id;	

					$third_term_data=$result['academicData']->third_term_data;	
					$third_term_master_id=$result['academicData']->third_term_master_id;

						if ($result['term']=='First') {

							$result['term_papers']=$this->studentdash->getUploadedExamPapers($first_term_master_id,$moduleTag);

						}elseif ($result['term']=='Second') {
							$result['term_papers']=$this->studentdash->getUploadedExamPapers($second_term_master_id,$moduleTag);

						}elseif ($result['term']=='Third') {
							$result['term_papers']=$this->studentdash->getUploadedExamPapers($third_term_master_id,$moduleTag);;
						}else{
							$result['term_papers']=[];
						}
					
					


					

					//pre($result['term_marks']);
				}else{
					$result['term_papers']=[];
					
				}

			
			
			


			//pre($result['paymentList']);exit;
			$page = "student/dashboard/paper/student_exam_paper_list_data";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}



public function message()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/message/message';
			
			$result = [];
			$header = "";
			

			$result['academicData']=$this->studentdash->getStudentAcademicDetailsbyId($session['academicID']);

			$result['student_uniq_id']=$result['academicData']->student_uniq_id;
			$result['academic_id']=$result['academicData']->academic_id;

			$result['messageList']=$this->studentdash->getMessageByStudentID($result['student_uniq_id']);
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}


	public function sendMessage()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$student_uniq_id = trim(htmlspecialchars($dataArry['student_uniq_id']));
			$academic_id = trim(htmlspecialchars($dataArry['academic_id']));
			$message = trim(htmlspecialchars($dataArry['message']));
			
			
			

					/*  ADD MODE
					 *	-----------------
					*/


					$array_insert = array(
						"academic_id" => $academic_id,
						"student_uniq_id" => $student_uniq_id,
						"student_message" => $message
						
					);

					

						
					$tbl_name = array('message');
					$insert_array = array($array_insert);
					$insertData = $this->commondatamodel->insertMultiTableData($tbl_name,$insert_array);

					if($insertData)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Saved successfully",
							"mode" => "ADD"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "There is some problem.Try again"
						);
					}

				



			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}

public function highestMarks($classid,$subjectid,$term,$sessionid)
	{
		
$result=$this->studentdash->getHighestMarks($classid,$subjectid,$term,$sessionid);

return $result;


	}

}// end of class