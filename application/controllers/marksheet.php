<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class marksheet extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('marksheetmodel','marksheetmodel',TRUE);
		$this->load->model('marksmodel','marksmodel',TRUE);
	}
	
	
	public function index()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-marksheet/marksheet_list_view.php';
			$result = [];
			$header = "";
			
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			
			//pre($result['gradeList']);
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



public function classStudentListforMarksheet()
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
			$result['sel_class']=$sel_class;
			$result['studentList'] = $this->marksheetmodel->getAllStudentsbyClassMarksheet($session['yid'],$sel_class); 	
           
			}else{
					

           $result['studentList']=[];
           $result['sel_class']='';
			}


			
			$page = "dashboard/adminpanel_dashboard/ds-marksheet/marksheet_list_data";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	/* Print individuals Marksheet*/
public function printMarksheet()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			
		$academic_id = $this->uri->segment(3);
		
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

				    // rank master data
				    $where_rank = array(
				    				'rank_master.class_id' => $result['academicData']->class_id, 
				    				'rank_master.session_id' => $session['yid'] 
				    			);
				$rankData=$this->commondatamodel->getSingleRowByWhereCls('rank_master',$where_rank);
						if ($rankData) {
							$rank_master_id=$rankData->rank_master_id;
							$where_rank_details = array(
								'rank_details.rank_master_id' => $rank_master_id,
								'rank_details.academic_id' => $result['academicData']->academic_id
								 );
				$rankDetailsData=$this->commondatamodel->getSingleRowByWhereCls('rank_details',$where_rank_details);
				$result['rank']=$rankDetailsData->rank;
				$result['grand_total']=$rankDetailsData->grand_total;

				$topperData=$this->marksheetmodel->getTopper($rank_master_id);
				$result['topper_name']=$topperData->topper;

						}else{$result['rank']='';$result['grand_total']='';$result['topper_name']='';}
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
			
			
                    

			/*pre($result['paymentList']);exit;*/
			$page = "dashboard/adminpanel_dashboard/ds-marksheet/print_marksheet";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}




/* print payment details*/
public function printMarksheetFront()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$result=[];
		$where = array('session_year.session_id' =>$session['yid']);
			$result['sessionData']= $this->commondatamodel->getSingleRowByWhereCls('session_year',$where);
		$result['academicyear']=$result['sessionData']->year;
		$page = 'dashboard/adminpanel_dashboard/ds-marksheet/print_marksheet_front_page';

		
		
		echo $this->load->view($page,$result,true);
		
        

			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	/* print marksheet of a class*/

		/* Print individuals Marksheet*/
public function printMarksheetbyClass()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			
		$sel_class = $this->uri->segment(3);

		$result['studentList'] = $this->marksheetmodel->getAllStudentsbyClassMarksheet($session['yid'],$sel_class);
		if ($result['studentList']) {
			

		foreach ($result['studentList'] as  $value) {
			
		$academic_id=$value->academic_id;
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

				    // rank master data
				    $where_rank = array(
				    				'rank_master.class_id' => $result['academicData']->class_id, 
				    				'rank_master.session_id' => $session['yid'] 
				    			);
				$rankData=$this->commondatamodel->getSingleRowByWhereCls('rank_master',$where_rank);
						if ($rankData) {
							$rank_master_id=$rankData->rank_master_id;
							$where_rank_details = array(
								'rank_details.rank_master_id' => $rank_master_id,
								'rank_details.academic_id' => $result['academicData']->academic_id
								 );
				$rankDetailsData=$this->commondatamodel->getSingleRowByWhereCls('rank_details',$where_rank_details);
				$result['rank']=$rankDetailsData->rank;
				$result['grand_total']=$rankDetailsData->grand_total;

				$topperData=$this->marksheetmodel->getTopper($rank_master_id);
				$result['topper_name']=$topperData->topper;

						}else{$result['rank']='';$result['grand_total']='';$result['topper_name']='';}
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
			
			
                    

			/*pre($result['paymentList']);exit;*/
			$page = "dashboard/adminpanel_dashboard/ds-marksheet/print_marksheet";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;

		}
		}//end of main loop
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}
}//end of class