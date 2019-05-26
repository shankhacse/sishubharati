<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class classnotes extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		 $this->load->model('classnotesmodel','classnotesmodel',TRUE);
		
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			$result['classList'] = $this->classnotesmodel->classList($session['yid']); 
			$page = "dashboard/adminpanel_dashboard/classnotes/classnotes_upload_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}













		/* add result list */

	public function ClassnoteListUploadview()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{   $data=[];
			
			$mode = trim(htmlspecialchars($this->input->post('mode')));
			$data['classname']=$this->input->post('classname');
			$data['classnoteid']=$this->input->post('classnoteid');
			$data['year']=$this->input->post('year');

			$data['mode']=$mode;
			
			
				$page = "dashboard/adminpanel_dashboard/classnotes/classnotes_modal/classnotes_upload_partial_modal_view.php";
			
		$where_doc = array(
					'uploaded_exam_papers.upload_from_module_id' => $data['classnoteid'], 
					'uploaded_exam_papers.upload_from_module' => "ClassNotes"
				);
		$data['classNotesDocumenDtl'] = $this->commondatamodel->getAllRecordWhere('uploaded_exam_papers',$where_doc);

		

	   


				

				$documentDetailView = $this->load->view($page,$data);

		

			echo $documentDetailView;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}




/* save Result List*/

	public function saveClassNotes()
	{
		if($this->session->userdata('user_data'))
		{
			
			$session = $this->session->userdata('user_data');
			$classnotesID = trim($this->input->post('classnotesID'));
			$mode = trim($this->input->post('mode'));
			
			
		    $docType = $this->input->post('docType');
			$userFilename = $this->input->post('userFileName');
			$fileDesc = $this->input->post('fileDesc');

			
		

			$classnotes_array = array(
				"classnotesID" => $classnotesID,
				"mode" => $mode,
				
			
				"docType" => $docType,
				"userFilename" => $userFilename,
				"docFile" => $_FILES,
				"fileDesc" => $fileDesc
			);



			if($classnotesID>0 && $mode=="Edit")
			{
				$isFileChanged = $this->input->post('isChangedFile');
				$randomFileName = $this->input->post('randomFileName');
				$prvFilename = $this->input->post('prvFilename');
				$docDetailIDs = $this->input->post('docDetailIDs');
				
				$array_edit_info = array(
					'isChangedFile' => $isFileChanged ,
					'randomFileName' => $randomFileName, 
					'prvFilename' => $prvFilename, 
					'docDetailIDs' => $docDetailIDs 
				);

				$resultlist_array_new = array_merge($classnotes_array,$array_edit_info);

				$updateData = $this->classnotesmodel->updateClassNotesUpload($classnotesID,$resultlist_array_new,$session);
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

				$resultlist_array_new_add = array_merge($classnotes_array,$array_add_info);
				
				//$insertData = $this->publishresultmodel->inserIntoClassNotesUpload($publishID,$resultlist_array_new_add,$session);
				if(1)
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


	public function addClassNotesList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$classnotesID = 0;
				$result['resultPublishdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$classnotesID = $this->uri->segment(3);
				$result['classname'] = $this->uri->segment(4);
				$where_resultlist = array(
							"uploaded_exam_papers.upload_from_module_id" => $classnotesID,
							"uploaded_exam_papers.upload_from_module" => 'ClassNotes'
							);
				// getSingleRowByWhereCls(tablename,where params)
				$result['resultPublishdata'] = $this->commondatamodel->getAllRecordWhere('uploaded_exam_papers',$where_resultlist); 
				
				
			}

			$header = "";
			
			
			$page = "dashboard/adminpanel_dashboard/classnotes/classnotes_list_view.php";
			createbody_method($result, $page, $header,$session);
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
			$viewTemp = $this->load->view('dashboard/adminpanel_dashboard/classnotes/add_detail_document_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

}// end of class