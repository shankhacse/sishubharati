<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class marks extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('paymentomodel','paymentomodel',TRUE);
	   $this->load->model('marksmodel','marksmodel',TRUE);
	   $this->highest_marks_method_call_view =& get_instance();
		
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-marks/marks_individuals_list_view';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['StudentIdList']=$this->paymentomodel->getStudentIdList($session['yid']);
			//pre($result['studentList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}



/* for  individuals term marks*/
	public function getStudentName()
	{   $session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
				$classid = $this->input->post('classid');

       $data['studentlist'] = $this->paymentomodel->getStudentsIdbyClass($session['yid'],$classid);
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/ds-marks/student_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('administratorpanel','refresh');
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

			$sel_type_searchby=$dataArry['sel_type_searchby'];
			if ($sel_type_searchby=='SID') {
				
				if (isset($dataArry['sel_student_id'])) {
							     $academic_id=$dataArry['sel_student_id'];
							}else{
				          		 $academic_id="";
							}

			}else{
				
					if (isset($dataArry['sel_student_name'])) {
							    $academic_id=$dataArry['sel_student_name'];
							}else{
								$academic_id="";
							}
			}


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
			$page = "dashboard/adminpanel_dashboard/ds-marks/student_marks_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

/* for  individuals term marks*/
	public function getStudentExamPapers()
	{   $session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
				$formData = $this->input->post('formDatas');
		    	parse_str($formData, $dataArry);

			$result=[];
			$result['studentInfo']=[];
			$result['first_term_papers']=[];
			$result['second_term_papers']=[];
			$result['third_term_papers']=[];

			$sel_type_searchby=$dataArry['sel_type_searchby'];
			if ($sel_type_searchby=='SID') {
				
				if (isset($dataArry['sel_student_id'])) {
							     $academic_id=$dataArry['sel_student_id'];
							}else{
				          		 $academic_id="";
							}

			}else{
				
					if (isset($dataArry['sel_student_name'])) {
							    $academic_id=$dataArry['sel_student_name'];
							}else{
								$academic_id="";
							}
			}
			   
			    

			
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
			redirect('administratorpanel','refresh');
		}
	}



public function highestMarks($classid,$subjectid,$term,$sessionid)
	{
		
$result=$this->marksmodel->getHighestMarks($classid,$subjectid,$term,$sessionid);

return $result;


	}
}// end of class