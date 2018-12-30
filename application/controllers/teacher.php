<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class teacher extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		
		$this->load->model('teachermodel','teachermodel',TRUE);
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
			
			$page = "dashboard/adminpanel_dashboard/ds-teacher/teachers_add_edit_view2";
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

			
		

			$teacher_array = array(
				"teacherID" => $teacherID,
				"mode" => $mode,
				"teacher" => $this->input->post('teacher'),
				"subject" => $this->input->post('subject'),
			
			
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
			redirect('login','refresh');
		}
	}// saveEvent Close

	}//teacher controller close