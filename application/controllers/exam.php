<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class exam extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('exammodel','exammodel',TRUE);
	   $this->method_call_view =& get_instance();
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-exam/exam_marks_add_edit_view';
			$result = [];
			$header = "";
			$daymonth=date('m-d');
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


	public function studentList()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-exam/class_student_list_data';
			$result = [];
			$header = "";
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$sel_class = $dataArry['sel_class'];
			$session_id=$session['yid'];

			$where_class = array('class_master.id' => $sel_class );
				$classData=$this->commondatamodel->getSingleRowByWhereCls('class_master',$where_class);

				$result['classname']=$classData->name;
			
			$result['studentList']=$this->exammodel->getActiveStudentListByClass($sel_class,$session_id);
			//pre($result['studentList']);
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


/* add subject marks model data*/


	public function addSubjectmarks()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{   $data=[];
			
			$mode = trim(htmlspecialchars($this->input->post('mode')));
			$classid = trim(htmlspecialchars($this->input->post('classid')));
			$data['term']=$this->input->post('term');
			$data['classid']=$this->input->post('classid');
			$data['academicid']=$this->input->post('academicid');
			$data['mode']=$mode;
			
				$page = "dashboard/adminpanel_dashboard/ds-exam/exam_modal/add_marks_partial_modal_view";
				$where_class = array('class_subject_asign_master.class_master_id' => $classid );
				
				$classAssignMasterData=$this->commondatamodel->getSingleRowByWhereCls('class_subject_asign_master',$where_class);
				$asign_master_id=$classAssignMasterData->id;

				$data['subjestList']=$this->exammodel->getClassSubjectListDetails($asign_master_id);


				

				$documentDetailView = $this->load->view($page,$data);

		

			echo $documentDetailView;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}


/* edit subject marks model data*/


	public function editSubjectmarks()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{   $data=[];
			
			$mode = trim(htmlspecialchars($this->input->post('mode')));
			$classid = trim(htmlspecialchars($this->input->post('classid')));
			$data['term']=$this->input->post('term');
			$data['classid']=$this->input->post('classid');
			$data['academicid']=$this->input->post('academicid');
			$data['marksmasterid']=$this->input->post('marksmasterid');
			
			
				$page = "dashboard/adminpanel_dashboard/ds-exam/exam_modal/edit_marks_partial_modal_view";
			

		$data['subjestList']=$this->exammodel->getMarksDetails($data['marksmasterid']);

		$where_exam_mst = array('marks_master.marks_master_id' => $data['marksmasterid'] );
				$examMasterData=$this->commondatamodel->getSingleRowByWhereCls('marks_master',$where_exam_mst);

				$data['attendance']=$examMasterData->attendance;
				$data['sporting']=$examMasterData->sporting;
				$data['discipline']=$examMasterData->discipline;
				$data['cutural_effciency']=$examMasterData->cultural_efficiency;


				

				$documentDetailView = $this->load->view($page,$data);

		

			echo $documentDetailView;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}
public function getGrade()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
				$totalmarks=$this->input->post('totalmarks');
				$fullmarks=$this->input->post('totalfullmarks');
				
				
				
				$gradeData=$this->exammodel->getGrade($totalmarks,$fullmarks);

				if ($gradeData) {
					echo $grade=$gradeData->grade;
				}else{
					echo "";
				}
				
		
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}


 	/* save exam subject marks*/

 	public function saveExamMarks()
	{
		if($this->session->userdata('user_data'))
		{  
		    $formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			
		
			$session = $this->session->userdata('user_data');
			$marksmasterID = $dataArry['marksmasterID'];
			$academic_id = $dataArry['academic_id'];
			$class_id = $dataArry['class_id'];
			$subjectid = $dataArry['subjectid'];
			$term = $dataArry['term'];

			$totalfullmarks = $dataArry['totalfullmarks'];
			$totwrittenmarks = $dataArry['totwrittenmarks'];
			$totoralmarks = $dataArry['totoralmarks'];
			
			$obtainwrittenmarks = $dataArry['obtainwrittenmarks'];
			$obtainoralmarks = $dataArry['obtainoralmarks'];
			$obtaintotalmarks = $dataArry['obtaintotalmarks'];
			$grade = $dataArry['grade'];

			$attendance = $dataArry['attendance'];
			$sporting = $dataArry['sporting'];
			$discipline = $dataArry['discipline'];
			$cutural_effciency = $dataArry['cutural_effciency'];


			$tarmtotalmarks=0;
			
			$mode = $dataArry['mode'];
		    $arraysize=count($subjectid);

			if($marksmasterID>0 && $mode=="EDIT")
			{

					/* update marks master*/

					$marksmaster_array_upd = array(
					
					"attendance" => $attendance,
					"sporting" => $sporting,
					"discipline" => $discipline,
					"cultural_efficiency" => $cutural_effciency
				    );

					$where_marksmaster_updt = array("marks_master.marks_master_id" => $marksmasterID);

                $update_marksmaster=$this->commondatamodel->updateDataSingleTable('marks_master',$marksmaster_array_upd,$where_marksmaster_updt);


				$marksdetailsid = $dataArry['marksdetailsid'];
				for ($i=0; $i <$arraysize ; $i++) { 
					
				
				$marks_details_upd = array(
				'subject_id' => $subjectid[$i],
				'full_marks' => $totalfullmarks[$i],
				'full_written_marks' => $totwrittenmarks[$i],
				'full_oral_marks' => $totoralmarks[$i],
				'obtain_written_marks' => $obtainwrittenmarks[$i],
				'obtain_oral_marks' => $obtainoralmarks[$i],
				'obtain_total_marks' => $obtaintotalmarks[$i],
				'grade' => $grade[$i]
				
				
				  );

				$tarmtotalmarks=$tarmtotalmarks+$obtaintotalmarks[$i];
				$marksupd_where = array('marks_details.marks_details_id' =>$marksdetailsid[$i] );

		$updateMarksDetailsData=$this->commondatamodel->updateDataSingleTable('marks_details',$marks_details_upd,$marksupd_where);

				 
				}
					if ($term=='first') {
						$academic_details_upd = array(
							'first_term_total' => $tarmtotalmarks
							 );
			  		 }elseif ($term=='second') {
				  	 	$academic_details_upd = array(
							'second_term_total' => $tarmtotalmarks
							 );
					 }elseif ($term=='third') {
			   	  	    $academic_details_upd = array(
							'third_term_total' => $tarmtotalmarks
							 );
			         }	
			
                $where_acdm_upd = array("student_academic_details.academic_id" => $academic_id);

                $update=$this->commondatamodel->updateDataSingleTable('student_academic_details',$academic_details_upd,$where_acdm_upd);



				if($update)
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

				$marksmaster_array = array(
				"term" => $term,
				"academic_id" => $academic_id,
				"class_id" => $class_id,
				"session_id" => $session['yid'],
				"is_file_uploaded" => 'N',
				"attendance" => $attendance,
				"sporting" => $sporting,
				"discipline" => $discipline,
				"cultural_efficiency" => $cutural_effciency
			    );

			$insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('marks_master',$marksmaster_array);
				
				for ($i=0; $i <$arraysize ; $i++) { 
					
				
				$marks_details_array = array(
				'marks_master_id' => $insert_id ,
				'subject_id' => $subjectid[$i],
				'full_marks' => $totalfullmarks[$i],
				'full_written_marks' => $totwrittenmarks[$i],
				'full_oral_marks' => $totoralmarks[$i],
				'obtain_written_marks' => $obtainwrittenmarks[$i],
				'obtain_oral_marks' => $obtainoralmarks[$i],
				'obtain_total_marks' => $obtaintotalmarks[$i],
				'grade' => $grade[$i],
				'academic_id' => $academic_id,
				'session_id' => $session['yid'],
				'term' => $term,
				'class_id' => $class_id
				
				  );

				$tarmtotalmarks=$tarmtotalmarks+$obtaintotalmarks[$i];

		$insertMarksDetailsData=$this->commondatamodel->insertSingleTableData('marks_details',$marks_details_array);

				 
				}
				if ($term=='first') {
					
					$academic_details_array = array(
						'first_term_data' => 'Y',
						'first_term_master_id' => $insert_id,
						'first_term_total' => $tarmtotalmarks
						 );
			   }elseif ($term=='second') {
				   	$academic_details_array = array(
							'second_term_data' => 'Y',
							'second_term_master_id' => $insert_id,
							'second_term_total' => $tarmtotalmarks
							 );

			   }elseif ($term=='third') {
			   	    $academic_details_array = array(
							'third_term_data' => 'Y',
							'third_term_master_id' => $insert_id,
							'third_term_total' => $tarmtotalmarks
							 );
			   }



					$where_upd = array(
						"student_academic_details.academic_id" => $academic_id
					);

					$user_activity = array(
						"activity_date" => date("Y-m-d H:i:s"),
						"activity_module" => 'Exam',
						"action" => 'Update',
						"from_method" => 'exam/saveExamMarks',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform(),
						"login_time" => NULL,
						"logout_time" => NULL
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$insertData = $this->commondatamodel->updateData_WithUserActivity('student_academic_details',$academic_details_array,$where_upd,'user_activity_report',$user_activity);
					

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
			
				
			//header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;
			
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

/* exam marks total view*/

public function markstotal()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-exam/marks_total_view';
			$result = [];
			$header = "";
			$daymonth=date('m-d');
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}

public function marksTotalStudentList()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-exam/marks_total_class_student_list_data';
			$result = [];
			$header = "";
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$sel_class = $dataArry['sel_class'];
			$result['classid']=$dataArry['sel_class'];
			$session_id=$session['yid'];

			$where_class = array('class_master.id' => $sel_class );
				$classData=$this->commondatamodel->getSingleRowByWhereCls('class_master',$where_class);

				$result['classname']=$classData->name;
			
			$result['studentList']=$this->exammodel->getActiveStudentListByClass($sel_class,$session_id);
			//pre($result['studentList']);
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}
/* to add specoal marks student list*/
public function addspecialmarksStudentList()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-exam/add_special_marks_class_student_list_data';
			$result = [];
			$header = "";
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$sel_class = $dataArry['sel_class'];
			$result['classid']=$dataArry['sel_class'];
			$session_id=$session['yid'];

			$where_class = array('class_master.id' => $sel_class );
				$classData=$this->commondatamodel->getSingleRowByWhereCls('class_master',$where_class);

				$result['classname']=$classData->name;
			
			$result['studentList']=$this->exammodel->getActiveStudentListTotalMarks($sel_class,$session_id);
			//pre($result['studentList']);
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


public function calculatepercentage($marks,$persentage)
{
	$value=($marks*$persentage)/100;
	return round($value);
           
}


/* save special marks*/

public function saveSpecialMarks()
	{
		if($this->session->userdata('user_data'))
		{  
		    $formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$session = $this->session->userdata('user_data');
			$academic_id = $dataArry['academic_id'];
			$specialmarks = $dataArry['specialmarks'];
			$grandtotalmarks = $dataArry['grandtotalmarks'];
			
			
			$mode = $dataArry['mode'];
		    $arraysize=count($academic_id);

				for ($i=0; $i <$arraysize ; $i++) { 
					
				$specialmarks_details_upd = array(
				'special_marks' => $specialmarks[$i],
				'grand_total' => $grandtotalmarks[$i]
				  );

				$acdupd_where = array('student_academic_details.academic_id' =>$academic_id[$i] );

		$updateData=$this->commondatamodel->updateDataSingleTable('student_academic_details',$specialmarks_details_upd,$acdupd_where);

				 
				}
			
					
			

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


			
			
				
			//header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;
			
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

/* add details document view*/
public function adddetaildocument()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
		

			$row_no = $this->input->post('rowNo');
			$data['rowno'] = $row_no;
			$data['documentTypeList'] = $this->commondatamodel->getAllDropdownData('documents_upload_type');
			//$this->load->view('dashboard/equipment/equipment_detail_add_view');
			$viewTemp = $this->load->view('dashboard/adminpanel_dashboard/ds-exam/add_detail_document_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	/* add paper scan page*/

		public function exampaperScan()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{   $data=[];
			
			$mode = trim(htmlspecialchars($this->input->post('mode')));
			$classid = trim(htmlspecialchars($this->input->post('classid')));
			$data['term']=$this->input->post('term');
			$data['classid']=$this->input->post('classid');
			$data['academicid']=$this->input->post('academicid');
			$data['marksmasterid']=$this->input->post('marksmasterid');
			$data['mode']=$mode;
			
			
				$page = "dashboard/adminpanel_dashboard/ds-exam/exam_modal/paper_scan_partial_modal_view";
			
		$where_doc = array(
					'uploaded_exam_papers.upload_from_module_id' => $data['marksmasterid'], 
					'uploaded_exam_papers.upload_from_module' => "ExamPaper"
				);
		$data['studentDocumenDtl'] = $this->commondatamodel->getAllRecordWhere('uploaded_exam_papers',$where_doc);

		

	   


				

				$documentDetailView = $this->load->view($page,$data);

		

			echo $documentDetailView;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}

/* save  exam paper*/

	public function saveScanExamPaper()
	{
		if($this->session->userdata('user_data'))
		{
			
			$session = $this->session->userdata('user_data');
			$marksmasterID = trim($this->input->post('marksmasterID'));
			$mode = trim($this->input->post('mode'));
			
			
		    $docType = $this->input->post('docType');
			$userFilename = $this->input->post('userFileName');
			$fileDesc = $this->input->post('fileDesc');

			
		

			$paper_array = array(
				"marksmasterID" => $marksmasterID,
				"mode" => $mode,
				
			
				"docType" => $docType,
				"userFilename" => $userFilename,
				"docFile" => $_FILES,
				"fileDesc" => $fileDesc
			);



			if($marksmasterID>0 && $mode=="Edit")
			{
				$isFileChanged = $this->input->post('isChangedFile');
				$randomFileName = $this->input->post('randomFileName');
				$prvFilename = $this->input->post('prvFilename');
				$docDetailIDs = $this->input->post('docDetailIDs');
				
				$paper_array_edit_info = array(
					'isChangedFile' => $isFileChanged ,
					'randomFileName' => $randomFileName, 
					'prvFilename' => $prvFilename, 
					'docDetailIDs' => $docDetailIDs 
				);

				$paper_array_new = array_merge($paper_array,$paper_array_edit_info);

				$updateData = $this->exammodel->updatePaperUpload($marksmasterID,$paper_array_new,$session);
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
				
				
				$paper_array_add_info = array(
					'isChangedFile' => $isFileChanged 
				);

				$paper_array_new_add = array_merge($paper_array,$paper_array_add_info);
				
				$insertData = $this->exammodel->inserIntoPaperUpload($marksmasterID,$paper_array_new_add,$session);
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


	/* term performance model data*/


	public function termPerformanceData()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{   $data=[];
			
		
			$data['marksmasterid']=$this->input->post('marksmasterid');
			$data['term']=$this->input->post('term');
			
			
				$page = "dashboard/adminpanel_dashboard/ds-exam/exam_modal/term_performance_partial_view";
				
				$where_marks_mst= array('marks_master.marks_master_id' => $data['marksmasterid'] );
				
				$marksMasterData=$this->commondatamodel->getSingleRowByWhereCls('marks_master',$where_marks_mst);
				if ($marksMasterData) {
				$data['attendance']=$marksMasterData->attendance;
				$data['sporting']=$marksMasterData->sporting;
				$data['discipline']=$marksMasterData->discipline;
				$data['cultural_efficiency']=$marksMasterData->cultural_efficiency;
				}else{

				    		$result['attendance']="";
							$result['sporting']="";
							$result['discipline']="";
							$result['cultural_efficiency']="";

				    }

				


				

				$documentDetailView = $this->load->view($page,$data);

		

			echo $documentDetailView;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}

}// end of class