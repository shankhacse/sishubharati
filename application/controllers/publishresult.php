<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class publishresult extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		 $this->load->model('publishresultmodel','publishresultmodel',TRUE);
		  $this->load->model('exammodel','exammodel',TRUE);
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			$result['termList'] = $this->publishresultmodel->termList($session['yid']); 
			$page = "dashboard/adminpanel_dashboard/ds-result_publish/term_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


  public function resultlist()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			$result['termList'] = $this->publishresultmodel->termList($session['yid']); 
			$page = "dashboard/adminpanel_dashboard/ds-result_publish/result_upload_term_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function setStatus(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$updID = trim($this->input->post('uid'));
			$setstatus = trim($this->input->post('setstatus'));
			
			$update_array  = array(
				"is_publish" => $setstatus
				);
				
			$where = array(
				"result_publish.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Result Publish',
					"action" => "Update",
					"from_method" => "publishresult/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('result_publish',$update_array,$where,'user_activity_report',$user_activity);
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



		public function setStatusWebPublish(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$updID = trim($this->input->post('uid'));
			$setstatus = trim($this->input->post('setstatus'));
			
			$update_array  = array(
				"is_visable_web" => $setstatus
				);
				
			$where = array(
				"result_publish.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Result Publish',
					"action" => "Update",
					"from_method" => "publishresult/setStatusWebPublish",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('result_publish',$update_array,$where,'user_activity_report',$user_activity);
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


	/* exam marks total view*/

public function markstotal()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-result_publish/marks_total_view';
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
			$page = 'dashboard/adminpanel_dashboard/ds-result_publish/marks_total_class_student_list_data';
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


		/* add result list */

		public function ResultListUploadview()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{   $data=[];
			
			$mode = trim(htmlspecialchars($this->input->post('mode')));
			$data['term']=$this->input->post('term');
			$data['publishid']=$this->input->post('publishid');
			$data['year']=$this->input->post('year');

			$data['mode']=$mode;
			
			
				$page = "dashboard/adminpanel_dashboard/ds-result_publish/result_publish_modal/resultlist_upload_partial_modal_view.php";
			
		$where_doc = array(
					'uploaded_exam_papers.upload_from_module_id' => $data['publishid'], 
					'uploaded_exam_papers.upload_from_module' => "ResultList"
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




/* save Result List*/

	public function saveResultList()
	{
		if($this->session->userdata('user_data'))
		{
			
			$session = $this->session->userdata('user_data');
			$publishID = trim($this->input->post('publishID'));
			$mode = trim($this->input->post('mode'));
			
			
		    $docType = $this->input->post('docType');
			$userFilename = $this->input->post('userFileName');
			$fileDesc = $this->input->post('fileDesc');

			
		

			$resultlist_array = array(
				"publishID" => $publishID,
				"mode" => $mode,
				
			
				"docType" => $docType,
				"userFilename" => $userFilename,
				"docFile" => $_FILES,
				"fileDesc" => $fileDesc
			);



			if($publishID>0 && $mode=="Edit")
			{
				$isFileChanged = $this->input->post('isChangedFile');
				$randomFileName = $this->input->post('randomFileName');
				$prvFilename = $this->input->post('prvFilename');
				$docDetailIDs = $this->input->post('docDetailIDs');
				
				$resultlist_array_edit_info = array(
					'isChangedFile' => $isFileChanged ,
					'randomFileName' => $randomFileName, 
					'prvFilename' => $prvFilename, 
					'docDetailIDs' => $docDetailIDs 
				);

				$resultlist_array_new = array_merge($resultlist_array,$resultlist_array_edit_info);

				$updateData = $this->publishresultmodel->updateResultListUpload($publishID,$resultlist_array_new,$session);
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
				
				
				$resultlist_array_add_info = array(
					'isChangedFile' => $isFileChanged 
				);

				$resultlist_array_new_add = array_merge($resultlist_array,$resultlist_array_add_info);
				
				$insertData = $this->publishresultmodel->inserIntoResultListUpload($publishID,$resultlist_array_new_add,$session);
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


		public function addResultList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$publishID = 0;
				$result['resultPublishdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$publishID = $this->uri->segment(3);
				$where_resultlist = array(
							"uploaded_exam_papers.upload_from_module_id" => $publishID,
							"uploaded_exam_papers.upload_from_module" => 'ResultList'
							);
				// getSingleRowByWhereCls(tablename,where params)
				$result['resultPublishdata'] = $this->commondatamodel->getAllRecordWhere('uploaded_exam_papers',$where_resultlist); 
				
				
			}

			$header = "";
			
			
			$page = "dashboard/adminpanel_dashboard/ds-result_publish/result_publish_list_view.php";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

}// end of class