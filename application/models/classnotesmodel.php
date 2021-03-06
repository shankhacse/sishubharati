<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class classnotesmodel extends CI_Model{
	
	public function classList($session_id){
		$data = [];
		$where = array('class_notes.session_id' =>$session_id);
		$query = $this->db->select("class_notes.*,class_master.name as classname, session_year.year")
				->from('class_notes')
				->join('session_year','session_year.session_id = class_notes.session_id','INNER')
				->join('class_master','class_master.id = class_notes.class_id','INNER')
				->where($where)
				->order_by('class_notes.id')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}






/**/
public function updateClassNotesUpload($publishID,$data,$sesion_data)
	{
		try
		{
        	$this->db->trans_begin();
			$insert_trainer_data = array();
			$insert_user_activity = array();
			$is_file_uploaded = "N";
			$totalfilesupload = 0;
			if(isset($data['docFile']['fileName']))
			{
				if(sizeof($data['docFile']['fileName']['name'])>0)
				{
					$is_file_uploaded = "Y";
					$totalfilesupload = sizeof($data['docFile']['fileName']['name']);
				}
				else
				{
					$is_file_uploaded = "N";
					$totalfilesupload = 0;
				}
			}
			$upd_where = array("class_notes.id" => $data['classnotesID']);

				$insert_student_data = array(
				'is_file_uploaded' => $is_file_uploaded,  
				'fileupload_count' => $totalfilesupload, 
				);

			
			$this->db->where($upd_where);
            $this->db->update('class_notes',$insert_student_data);

			$insert_where = array(
				"masterID" => $data['classnotesID'],
				"From" => "ClassNotes",
			);
			
			if($is_file_uploaded=="Y")
			{
				$detail_insert = $this->insertIntoUploadFile($data,$sesion_data,$insert_where);
			}else{

				/* if delete all uploaded file for testing 08.10.2018*/
				if($data['mode']=="Edit" && $data['classnotesID']>0)
					{

						$where_resultlist = array(
							"uploaded_exam_papers.upload_from_module_id" => $data['classnotesID'],
							"uploaded_exam_papers.upload_from_module" => 'ClassNotes'
							);

	
							$this->db->where($where_resultlist);
							$this->db->delete('uploaded_exam_papers'); 
							#q();
					}

			}
			
			$insert_user_activity = array(
				"activity_date" => date('Y-m-d'),  
				"activity_module" => 'Upload Class Notes',
				
				"action" => "Update",
				"from_method" => "classnotes/saveclassnotes",
				"user_id" => $sesion_data['userid'],
				
				"ip_address" => getUserIPAddress(),
				"user_browser" => getUserBrowserName(),
				"user_platform" => getUserPlatform()
			);
			
			$user_activity = $this->db->insert('user_activity_report', $insert_user_activity);
		
		if($this->db->trans_status() === FALSE) 
		{
            $this->db->trans_rollback();
            return false;
        } 
		else 
			{
	            $this->db->trans_commit();
	            return true;
	        }
        }
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}



public function insertIntoUploadFile($data,$session_data,$where_data)
	{ 




		if($data['mode']=="Edit" && $data['classnotesID']>0)
		{

			$where_resultlist = array(
				"uploaded_exam_papers.upload_from_module_id" => $data['classnotesID'],
				"uploaded_exam_papers.upload_from_module" => $where_data['From']
				);


	

				$this->db->where($where_resultlist);
				$this->db->delete('uploaded_exam_papers'); 

		}

		

		$dir1 = $_SERVER['DOCUMENT_ROOT'].'/application/assets/ds-documents/class_notes'; //server

		//$dir1 = $_SERVER['DOCUMENT_ROOT'].'/sishubharati/application/assets/ds-documents/class_notes'; //local
		
		
		
		$config = array(
			'upload_path' => $dir1,
			'allowed_types' => 'docx|doc|pdf|jpg|png|txt|xls|xlsx',
			'max_size' => '5120', // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_filename' => '255',
			'encrypt_name' => TRUE,
			);

		$this->load->library('upload', $config);
		$images = array();
        $detail_array = array();	
       $count_docs = sizeof($data['docFile']['fileName']['name']);
       $srl_no=1;
       	for($i=0;$i<sizeof($data['docFile']['fileName']['name']);$i++)
        {
      		$_FILES['images[]']['name']= $_FILES['fileName']['name'][$i];
            $_FILES['images[]']['type']= $_FILES['fileName']['type'][$i];
            $_FILES['images[]']['tmp_name']= $_FILES['fileName']['tmp_name'][$i];
            $_FILES['images[]']['error']= $_FILES['fileName']['error'][$i];
            $_FILES['images[]']['size']= $_FILES['fileName']['size'][$i];
			$this->upload->initialize($config);
			if ($this->upload->do_upload('images[]'))
			{
               $file_detail = $this->upload->data();
               $file_name = $file_detail['file_name']; 
               $detail_array =array(
					"random_file_name" => $file_name,
					"document_type_id" => $data['docType'][$i],
					"user_file_name" => $data['userFilename'][$i],
					"uploaded_file_desc" => $data['fileDesc'][$i],
					"uploaded_on" => date('Y-m-d'),
					"modified_on" => date('Y-m-d'),
					"upload_from_module" => "ClassNotes",
					"upload_from_module_id" => $where_data['masterID'],
					"upload_srl_no" => $srl_no++,
					
					"uploaded_by_user" => $session_data['userid'],
					"is_active" => 'Y'
				); 

             	$this->db->insert('uploaded_exam_papers',$detail_array);	
             	#echo $this->db->last_query();
            }
        }

        // If File Not Changed Then insert Info
        $countChanged = sizeof($data['isChangedFile']);

       // echo "Count Changed ".$countChanged;
      //  exit;

        for($k=0;$k<$countChanged;$k++)
        {
        	$detail_array_edit = array();

        	if($data['isChangedFile'][$k]=="N")
        	{   
				$detail_array_edit =array(
					"random_file_name" => $data['randomFileName'][$k],
					"document_type_id" => $data['docType'][$k],
					"user_file_name" => $data['prvFilename'][$k],
					"uploaded_file_desc" => $data['fileDesc'][$k],
					"uploaded_on" => date('Y-m-d'),
					"modified_on" => date('Y-m-d'),
					"upload_from_module" => "ClassNotes",
					"upload_from_module_id" => $where_data['masterID'],
					"upload_srl_no" => $srl_no++,
					
					"uploaded_by_user" => $session_data['userid'],
					"is_active" => 'Y'
				); 

				$this->db->insert('uploaded_exam_papers',$detail_array_edit);
				#echo $this->db->last_query();	
			}
        }

	}




}// end of class