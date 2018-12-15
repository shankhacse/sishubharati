<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admission extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('admissionmodel','admmodel',TRUE);
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$result['studentList'] = $this->admmodel->getAllStudentsbyYear($session['yid']);
			

			/*echo "<pre>";
			print_r($result['studentList']);
			echo "</pre>";*/
			//exit;

			$page = "dashboard/adminpanel_dashboard/ds-admission/student_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function addStudent()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$studentID = 0;
				$result['admissionEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$studentID = $this->uri->segment(3);
				
				$where = array(
								'student_master.student_id' => $studentID 
								,
					'student_academic_details.session_id' => $session['yid']
							);
				$where_doc = array(
					'uploaded_documents_all.upload_from_module_id' => $studentID, 
					'uploaded_documents_all.upload_from_module' => "Admission"
				);

				$result['documentTypeList'] = $this->commondatamodel->getAllDropdownData('documents_upload_type');
				// getSingleRowByWhereCls(tablename,where params)
				$result['admissionEditdata'] = $this->admmodel->getStudentDetailsbyId($where);
				
				
				$admtypeid=$result['admissionEditdata']->admission_type;
				$result['classList'] = $this->admmodel->getClassListByAdmType($admtypeid);
				$result['studentDocumenDtl'] = $this->commondatamodel->getAllRecordWhere('uploaded_documents_all',$where_doc);
				
				
			}

			$header = "";
			$result['admissiontypeList'] = $this->commondatamodel->getAllDropdownData('admisson_type'); 
			$result['bloodgroupList'] = $this->commondatamodel->getAllDropdownData('blood_group'); 
			$result['districtList'] = $this->commondatamodel->getAllDropdownData('district'); 
			$result['occupationList'] = $this->commondatamodel->getAllDropdownData('occupation_master'); 
			$result['qualificationList'] = $this->commondatamodel->getAllDropdownData('qualification_master'); 
			$wheresession = array('session_year.session_id' =>$session['yid']);
			$result['year']= $this->commondatamodel->getSingleRowByWhereCls('session_year',$wheresession);
			$result['categoryList'] = $this->commondatamodel->getAllDropdownData('category_master');

			
			$page = "dashboard/adminpanel_dashboard/ds-admission/admisson_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	public function getClass()
	{
		if($this->session->userdata('user_data'))
		{
				$admtypeid = $this->input->post('admtypeid');

       $data['classList'] = $this->admmodel->getClassListByAdmType($admtypeid);
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/ds-admission/class_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}


	public function getClassRoll()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
				$classid = $this->input->post('classid');

       $data['lastRollData'] = $this->admmodel->getLastClassRoll($classid,$session["yid"]);

     sizeof($data['lastRollData']);
     
     if (sizeof($data['lastRollData'])=='0') {
     	$classrole=1;
     }else{
     	foreach ($data['lastRollData'] as $value) {
         $lastroll=$value->class_roll;
       }

       $classrole=$lastroll+1;

     }
     
			echo $classrole;
		}
		else
		{
			redirect('login','refresh');
		}
	}


public function adddetaildocument()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
		

			$row_no = $this->input->post('rowNo');
			$data['rowno'] = $row_no;
			$data['documentTypeList'] = $this->commondatamodel->getAllDropdownData('documents_upload_type');
			//$this->load->view('dashboard/equipment/equipment_detail_add_view');
			$viewTemp = $this->load->view('dashboard/adminpanel_dashboard/ds-admission/add_detail_document_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

	public function saveStudent()
	{
		if($this->session->userdata('user_data'))
		{
			$student_array = array();
			$user_activity = array();
			$tbl_name = array();
		
			$session = $this->session->userdata('user_data');
			$studentID = trim($this->input->post('studentID'));
			$mode = trim($this->input->post('mode'));
			$admdt=$this->input->post('dtadm');
			$studentdob=$this->input->post('studentdob');
			if($admdt!=""){
				$admdt = str_replace('/', '-', $admdt);
				$admdt = date("Y-m-d",strtotime($admdt));
			 }
			 else{
				 $admdt = NULL;
			 }

			 if($studentdob!=""){
				$studentdob = str_replace('/', '-', $studentdob);
				$studentdob = date("Y-m-d",strtotime($studentdob));
			 }
			 else{
				 $studentdob = NULL;
		    }
			
			
		    $docType = $this->input->post('docType');
			$userFilename = $this->input->post('userFileName');
			$fileDesc = $this->input->post('fileDesc');

			
		

			$student_array = array(
				"studentID" => $studentID,
				"mode" => $mode,
				"admission_type" => $this->input->post('admtype'),
				"class_id" => $this->input->post('sel_class'),
				"admission_dt" => $admdt,
				"entrycls" => trim($this->input->post('entrycls')),
				"frmslno" => trim($this->input->post('frmslno')),
				"classroll" => trim($this->input->post('classroll')),
				"name" => trim($this->input->post('studentname')),
				"gender" => $this->input->post('studentgender'),
				"date_of_birth" => $studentdob,
				"category" => trim($this->input->post('category')),
				"blood_group" => $this->input->post('bloodgroup'),
				"previous_school" =>trim($this->input->post('previousschool')),
				"father_name" => trim($this->input->post('fathername')),
				"father_edu" => trim($this->input->post('fatheredu')),
				"father_occupation" => trim($this->input->post('fatheroccu')),
				"father_mobile" => trim($this->input->post('fathermob')),
				"mother_name" => trim($this->input->post('mothername')),
				"mother_edu" => trim($this->input->post('motheredu')),
				"mother_occupation" => trim($this->input->post('motherocc')),
				"mother_mobile" => trim($this->input->post('mothermob')),
				"distric_id" => trim($this->input->post('district')),
				"village" => $this->input->post('village'),
				"police_station" => trim($this->input->post('policest')),
				"pincode" => trim($this->input->post('pincode')),
				"address" => trim($this->input->post('address')),
				"email" => trim($this->input->post('email')),
				"aadhar_id" => trim($this->input->post('staadhar')),
				"ration_id" => trim($this->input->post('strationid')),
			
				"docType" => $docType,
				"userFilename" => $userFilename,
				"docFile" => $_FILES,
				"fileDesc" => $fileDesc
			);



			if($studentID>0 && $mode=="EDIT")
			{
				$isFileChanged = $this->input->post('isChangedFile');
				$randomFileName = $this->input->post('randomFileName');
				$prvFilename = $this->input->post('prvFilename');
				$docDetailIDs = $this->input->post('docDetailIDs');
				
				$student_array_edit_info = array(
					'isChangedFile' => $isFileChanged ,
					'randomFileName' => $randomFileName, 
					'prvFilename' => $prvFilename, 
					'docDetailIDs' => $docDetailIDs 
				);

				$student_array_new = array_merge($student_array,$student_array_edit_info);

				$updateData = $this->admmodel->updateStudent($student_array_new,$session);
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
				
				
				$student_array_add_info = array(
					'isChangedFile' => $isFileChanged 
				);

				$student_array_new_add = array_merge($student_array,$student_array_add_info);
				
				$insertData = $this->admmodel->inserIntoStudent($student_array_new_add,$session);
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
			redirect('login','refresh');
		}
	}

public function getDetailStudentModal()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$mid = trim(htmlspecialchars($this->input->post('mid')));
			$mode = trim(htmlspecialchars($this->input->post('mode')));
			$info = trim(htmlspecialchars($this->input->post('info')));
			
			
			if($mode=="DOCS")
			{
				$page = "dashboard/adminpanel_dashboard/ds-admission/admission-modal/admission_documents_partial_modal_view";
				$data['documentDetailData'] = $this->admmodel->getStudentUploadedDocuments($mid,"Admission");
				$data['studentname'] = $info;
				$data['uplodedFolder'] = "admission_upload" ;
				$documentDetailView = $this->load->view($page,$data);
			}

			echo $documentDetailView;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}


 	public function getAdmissionDetailStudent()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$student_id = trim(htmlspecialchars($this->input->post('studentid')));
			$mode = trim(htmlspecialchars($this->input->post('mode')));
			$info = trim(htmlspecialchars($this->input->post('studentname')));
			
			
			if($mode=="INFO")
			{
				$page = "dashboard/adminpanel_dashboard/ds-admission/admission-modal/student_information_partial_modal_view";
				$data['documentDetailData'] = $this->admmodel->getStudentProfilePicture($student_id,"Admission");
				$data['studentname'] = $info;
				$data['uplodedFolder'] = "admission_upload" ;

				$where = array(
								'student_master.student_id' => $student_id, 
								'student_academic_details.session_id' => $session['yid'] 
							);
				$data['studentdata'] = $this->admmodel->getStudentAdmissionInformationbyId($where);

				

				$documentDetailView = $this->load->view($page,$data);
			}

			echo $documentDetailView;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}


	public function class_students()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-admission/class_student_list_view';
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
				
			$result['studentList'] = $this->admmodel->getAllStudentsbyClass($session['yid'],$sel_class); 	
           
			}else{
					

           $result['studentList']=[];
			}


			
			$page = "dashboard/adminpanel_dashboard/ds-admission/class_student_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

} // end of class