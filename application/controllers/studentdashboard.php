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
	    $this->load->model('holidaysmodel','holidaysmodel',TRUE);
	    $this->load->model('grademodel','grademodel',TRUE);
        $this->load->library('pdfl');//load PHPExcel library
	      $this->highest_marks_method_call_view =& get_instance();
	       $this->payment_method_call_view =& get_instance();
		
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
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
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


	public function previousresults()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/oldresults/old_list_view';
			
			$result = [];
			$header = "";
			 
			$where = array(
								'session_year.is_active' => 'Y'
								
								 );
			$orderby="session_year.session_id";
			$result['yearList'] = $this->studentdash->getStudentOldClass($session['studentID'],
$session['academicID']);
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}



	/* for  individuals term marks*/
	public function getStudentAllMarks()
	{   $session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
				$formData = $this->input->post('formDatas');
		    	parse_str($formData, $dataArry);

			        $result=[];
			        $result['studentInfo']=[];
			        $result['first_term_marks']=[];
					$result['second_term_marks']=[];
					$result['third_term_marks']=[];

					$result['attendanceT1']="";
					$result['sportingT1']="";
					$result['disciplineT1']="";
					$result['cultural_efficiencyT1']="";
					
					$result['attendanceT2']="";
					$result['sportingT2']="";
					$result['disciplineT2']="";
					$result['cultural_efficiencyT2']="";

					$result['attendanceT3']="";
					$result['sportingT3']="";
					$result['disciplineT3']="";
					$result['cultural_efficiencyT3']="";

			
        $academic_id=$dataArry['select_class'];

			if ($academic_id!="") {
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

					$result['first_term_marks']=$this->marksmodel->getMarksDetails($first_term_master_id);
					$result['second_term_marks']=$this->marksmodel->getMarksDetails($second_term_master_id);
					$result['third_term_marks']=$this->marksmodel->getMarksDetails($third_term_master_id);
					/* term 1 performance*/
					$where_marks_mstT1= array('marks_master.marks_master_id' => $first_term_master_id );
				
					$marksMasterDataT1=$this->commondatamodel->getSingleRowByWhereCls('marks_master',$where_marks_mstT1);
					if ($marksMasterDataT1) {
							
							$result['attendanceT1']=$marksMasterDataT1->attendance;
							$result['sportingT1']=$marksMasterDataT1->sporting;
							$result['disciplineT1']=$marksMasterDataT1->discipline;
							$result['cultural_efficiencyT1']=$marksMasterDataT1->cultural_efficiency;
				    }else{
				    	   $result['attendanceT1']="";
							$result['sportingT1']="";
							$result['disciplineT1']="";
							$result['cultural_efficiencyT1']="";

				    }
					/* term 2 performance*/
					$where_marks_mstT2= array('marks_master.marks_master_id' => $second_term_master_id );
				
					$marksMasterDataT2=$this->commondatamodel->getSingleRowByWhereCls('marks_master',$where_marks_mstT2);
					if ($marksMasterDataT2) {
							$result['attendanceT2']=$marksMasterDataT2->attendance;
							$result['sportingT2']=$marksMasterDataT2->sporting;
							$result['disciplineT2']=$marksMasterDataT2->discipline;
							$result['cultural_efficiencyT2']=$marksMasterDataT2->cultural_efficiency;
					}else{
							$result['attendanceT2']="";
							$result['sportingT2']="";
							$result['disciplineT2']="";
							$result['cultural_efficiencyT2']="";

					}
					/* term 3 performance*/
					$where_marks_mstT3= array('marks_master.marks_master_id' => $third_term_master_id );
				
					$marksMasterDataT3=$this->commondatamodel->getSingleRowByWhereCls('marks_master',$where_marks_mstT3);
					if ($marksMasterDataT3) {
							$result['attendanceT3']=$marksMasterDataT3->attendance;
							$result['sportingT3']=$marksMasterDataT3->sporting;
							$result['disciplineT3']=$marksMasterDataT3->discipline;
							$result['cultural_efficiencyT3']=$marksMasterDataT3->cultural_efficiency;
				    }else{

				    		$result['attendanceT3']="";
							$result['sportingT3']="";
							$result['disciplineT3']="";
							$result['cultural_efficiencyT3']="";

				    }
					//pre($result['first_term_marks']);
				}else{
					$result['first_term_marks']=[];
					$result['second_term_marks']=[];
					$result['third_term_marks']=[];

					$result['attendanceT1']="";
					$result['sportingT1']="";
					$result['disciplineT1']="";
					$result['cultural_efficiencyT1']="";
					
					$result['attendanceT2']="";
					$result['sportingT2']="";
					$result['disciplineT2']="";
					$result['cultural_efficiencyT2']="";

					$result['attendanceT3']="";
					$result['sportingT3']="";
					$result['disciplineT3']="";
					$result['cultural_efficiencyT3']="";
					
				}

			}
			
			
                    

			//pre($result['paymentList']);exit;
			$page = 'student/dashboard/oldresults/student_marks_list_data.php';
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


/* for  individuals term marks*/
	public function getStudentExamPapersAll()
	{   $session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data'))
		{
				$formData = $this->input->post('formDatas');
		    	parse_str($formData, $dataArry);

			$result=[];
			$result['studentInfo']=[];
			$result['first_term_papers']=[];
			$result['second_term_papers']=[];
			$result['third_term_papers']=[];

			   
			    
$academic_id=$dataArry['select_class'];
			
                $moduleTag='ExamPaper';
               
			if ($academic_id!="") {
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

						

					$result['first_term_papers']=$this->marksmodel->getUploadedExamPapers($first_term_master_id,$moduleTag);

					
					$result['second_term_papers']=$this->marksmodel->getUploadedExamPapers($second_term_master_id,$moduleTag);

						
					$result['third_term_papers']=$this->marksmodel->getUploadedExamPapers($third_term_master_id,$moduleTag);;
						
					
					
					

					//pre($result['first_term_papers']);
				}else{
					$result['first_term_papers']=[];
					$result['second_term_papers']=[];
					$result['third_term_papers']=[];
					
				}


			}

			
			
			


			//pre($result['paymentList']);exit;
			$page = "dashboard/adminpanel_dashboard/ds-marks/student_exam_paper_list_data";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}


	/* print payment details*/
public function printPaymentReceipt()
	{
		$session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data'))
		{
			
		$paymentid = $this->uri->segment(3);
		
		$pdf = $this->pdfl->load();
		
		$page = "student/dashboard/payments/print_receipt_view";

		$where = array('payment_master.payment_master_id' => $paymentid);
			$paymentData=$this->commondatamodel->getSingleRowByWhereCls('payment_master',$where);
		$bill_master_id=$paymentData->bill_master_id;

		$where_billdetails = array('bill_master.bill_master_id' => $bill_master_id);
			$billdetailsData=$this->commondatamodel->getSingleRowByWhereCls('bill_master',$where_billdetails);
		$result['billno']=$billdetailsData->bill_no;
		$result['paymentdate']=$paymentData->payment_dt;
		$result['payment_for']=$paymentData->payment_for;
		$result['for_month']=$paymentData->for_month;
		$result['fine_amount']=$paymentData->fine_amount;
		

		$where_session = array('session_year.session_id' => $paymentData->session_id);
			$sessionData=$this->commondatamodel->getSingleRowByWhereCls('session_year',$where_session);

			$result['year']=$sessionData->year;
			
			$result['student_uniq_id']=$paymentData->student_uniq_id;
			$academic_id=$paymentData->academic_id;

$result['studentInfo']=$this->marksmodel->getStudentInfo($academic_id);


			
			$result['billDetails']=$this->paymentomodel->getBillDetailsData($bill_master_id);



		$result['data']="Hello";
		$this->load->view($page,$result,true);
		ini_set('memory_limit', '256M'); 
                 
       echo $html = $this->load->view($page, $result, true);
       /*$pdf->WriteHTML($html); 
       $output = 'payment_receipt' . date('Y_m_d_H_i_s') . '_.pdf'; 
               $pdf->Output("$output", 'I');*/
               // $pdf->Output();
                exit();

			
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}


	public function no_to_words($no) {
        $words = array('0' => '', 
            '1' => 'one',
            '2' => 'two', 
            '3' => 'three', 
            '4' => 'four', 
            '5' => 'five', 
            '6' => 'six', 
            '7' => 'seven', 
            '8' => 'eight', 
            '9' => 'nine', 
            '10' => 'ten', 
            '11' => 'eleven',
            '12' => 'twelve', 
            '13' => 'thirteen', 
            '14' => 'fourteen', 
            '15' => 'fifteen', 
            '16' => 'sixteen', 
            '17' => 'seventeen', 
            '18' => 'eighteen', 
            '19' => 'nineteen', 
            '20' => 'twenty', 
            '30' => 'thirty', 
            '40' => 'fourty', 
            '50' => 'fifty', 
            '60' => 'sixty',
            '70' => 'seventy', 
            '80' => 'eighty', 
            '90' => 'ninty',
            '100' => 'hundred', 
            '1000' => 'thousand', 
            '100000' => 'lakh', 
            '10000000' => 'crore');
        if ($no == 0)
            return ' ';
        else {
            $novalue = '';
            $highno = $no;
            $remainno = 0;
            $value = 100;
            $value1 = 1000;
            while ($no >= 100) {
                if (($value <= $no) && ($no < $value1)) {
                    $novalue = $words["$value"];
                    $highno = (int) ($no / $value);
                    $remainno = $no % $value;
                    break;
                }
                $value = $value1;
                $value1 = $value * 100;
            }
            if (array_key_exists("$highno", $words))
                return $words["$highno"] . " " . $novalue . " " .$this->no_to_words($remainno);
            else {
                $unit = $highno % 10;
                $ten = (int) ($highno / 10) * 10;
                return $words["$ten"] . " " . $words["$unit"] . " " . $novalue . " " .$this->no_to_words($remainno);
            }
        }
    }


    /* notice list */


    public function notice()
	{ 
		$session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data'))
		{       
			
			$header = "";
			$result['NoticeList'] = $this->studentdash->getAllNoticeList();
			

			/*echo "<pre>";
			print_r($result['NoticeList']);
			echo "</pre>";*/
			//exit;

			$page = 'student/dashboard/notice/notice_list.php';
			studentbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}


	public function importantinfo()
	{ 
		$session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data'))
		{       
			
			$header = "";
			$result['infoList'] = $this->studentdash->getAllInfoList();
			

			/*echo "<pre>";
			print_r($result['NoticeList']);
			echo "</pre>";*/
			//exit;

			$page = 'student/dashboard/important_info/important_info_list.php';
			studentbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}


	public function events()
	{ 
		$session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data'))
		{       
			
			$header = "";
			$result['EventsList'] = $this->studentdash->getAllActiveEventsList();
			

			$page = 'student/dashboard/events/events_list.php';
			studentbody_method($result, $page, $header, $session);
			
			
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}


	public function holidays()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
		
			$result = [];
			$header = "";
			
			$result['holidaysList']=$this->holidaysmodel->getHolidaysList($session['academic_session_id']);
			//pre($result['holidaysList']);
			
			$page = 'student/dashboard/holidays/holidays_list.php';
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}


	public function getMydocuments()
 	{ 
 		$session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data'))
		{   $header='';
			$mid = trim(htmlspecialchars($this->input->post('mid')));
			$mode = "DOCS";
			$info = trim(htmlspecialchars($this->input->post('info')));

			$where = array('student_master.student_uniq_id' =>$session['studentID']);
			$result['studentData']= $this->commondatamodel->getSingleRowByWhereCls('student_master',$where);

			$mid=$result['studentData']->student_id;
			
			if($mode=="DOCS")
			{
				 $page = 'student/dashboard/documents/documents_list.php';
				
				$data['documentDetailData'] = $this->admmodel->getStudentUploadedDocuments($mid,"Admission");
				
				$data['uplodedFolder'] = "admission_upload" ;
				//$documentDetailView = $this->load->view($page,$data);
			}
			
			studentbody_method($data, $page, $header, $session);
			//echo $documentDetailView;
		}
		else
		{
			redirect('studentlogin','refresh');
		}
 	}

 	public function gradelist()
	{ 
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			
			 $page = 'student/dashboard/exam/grade_list_view';
			$result = [];
			$header = "";
			
			$result['gradeList']=$this->grademodel->getGradeList();
			
			//pre($result['gradeList']);
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}





/* class notes by student class*/



	public function classnotes()
	{
		$session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data'))
		{
			
			$where = array('student_academic_details.academic_id' =>$session['academicID']);
			$studentData= $this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where);

			$classnotesID=$studentData->class_id;
				
				$where_classnotes = array(
							"uploaded_exam_papers.upload_from_module_id" => $classnotesID,
							"uploaded_exam_papers.upload_from_module" => 'ClassNotes'
							);
				// getSingleRowByWhereCls(tablename,where params)
				$result['resultPublishdata'] = $this->commondatamodel->getAllRecordWhere('uploaded_exam_papers',$where_classnotes); 
				
				
			

			$header = "";
			
			
			$page = "student/dashboard/classnotes/classnotes_list_view.php";
			studentbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}

}// end of class