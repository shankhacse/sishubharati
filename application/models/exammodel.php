<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class exammodel extends CI_Model{

		public function getActiveStudentListByClass($class_id,$session_id){
			$where = array(
				'student_academic_details.class_id' => $class_id,
				'student_academic_details.session_id' =>$session_id, 
				'student_academic_details.is_active' =>'Y' 
			);
			$data = [];
			$query = $this->db->select("student_academic_details.*,
										student_master.name as student_name,
										class_master.name as class_name
								")
					->from('student_academic_details')
					->join('student_master','student_master.student_uniq_id = student_academic_details.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					
					->where($where)
				    ->order_by('student_academic_details.class_roll')
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

/* get subject list of class*/
	public function getClassSubjectListDetails($asign_master_id){
     $data = [];
    	$where = array(
			
			"class_subject_asign_details.asign_master_id"=>$asign_master_id
		);
        $data = array();
		$this->db->select("class_subject_asign_details.*,
							subject_master.subject,
							subject_master.id as subjectid
							")
				->from('class_subject_asign_details')
				->join('subject_master','subject_master.id = class_subject_asign_details.subject_id','INNER')
				->where($where);
		$query = $this->db->get();
		
		#echo $this->db->last_query();
		
		if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
		             
		        }
		
		
            return $data;
       
        
    }
	

	public function getGrade($totalmarks,$fullmarks)
	{
		$data = array();
		$sql="select 
				  * 
				from
				  `grade_master` 
				where '".$totalmarks."' between grade_master.from_marks 
				  and grade_master.to_marks 
				 and grade_master.fullmarks='".$fullmarks."' limit 1";
		
		$query = $this->db->query($sql);
		
		#echo $this->db->last_query();
		
		if($query->num_rows()> 0)
		{
           $row = $query->row();
           return $data = $row;
             
        }
		else
		{
            return $data;
        }
	}	


/* get marks details*/

	public function getMarksDetails($marks_master_id){
     $data = [];
    	$where = array(
			
			"marks_details.marks_master_id"=>$marks_master_id
		);
        $data = array();
		$this->db->select("marks_details.*,
							subject_master.subject,
							subject_master.id as subjectid
							")
				->from('marks_details')
				->join('subject_master','subject_master.id = marks_details.subject_id','INNER')
				->where($where);
		$query = $this->db->get();
		
		#echo $this->db->last_query();
		
		if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
		             
		        }
		
		
            return $data;
       
        
    }

    public function getActiveStudentListTotalMarks($class_id,$session_id){
			$where = array(
				'student_academic_details.class_id' => $class_id,
				'student_academic_details.session_id' =>$session_id, 
				'student_academic_details.is_active' =>'Y' 
			);
			$data = [];
			$query = $this->db->select("
										student_academic_details.student_uniq_id,
										student_academic_details.class_roll,
										student_academic_details.academic_id,
										student_academic_details.first_term_master_id,
										student_academic_details.second_term_master_id,
										student_academic_details.third_term_master_id,
										student_academic_details.first_term_data,
										student_academic_details.second_term_data,
										student_academic_details.third_term_data,
										
						
						IFNULL(student_academic_details.first_term_total, 0) AS first_term_total,	
						IFNULL(student_academic_details.second_term_total, 0) AS second_term_total,

						IFNULL(student_academic_details.third_term_total, 0) AS third_term_total,
						IFNULL(student_academic_details.special_marks, 0) AS special_marks,
						IFNULL(student_academic_details.grand_total, 0) AS grand_total,
						student_master.name as student_name,
						class_master.name as class_name
								",false)
					->from('student_academic_details')
					->join('student_master','student_master.student_uniq_id = student_academic_details.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					
					->where($where)
				    ->order_by('student_academic_details.class_roll')
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

public function inserIntoPaperUpload($marksmasterID,$data,$sesion_data)
	{
		try
		{  pre($data);
        	$this->db->trans_begin();
			$insert_student_data = array();
			$insert_user_activity = array();
			$is_file_uploaded = "N";
			if(isset($data['docFile']['fileName']))
			{
				if(sizeof($data['docFile']['fileName']['name'])>0)
				{
					$is_file_uploaded = "Y";
				}
				else
				{
					$is_file_uploaded = "N";
				}
			}
            

			$insert_marks_master_data = array(
				 
				'is_file_uploaded' => $is_file_uploaded,  
				 
			);
			$upd_where = array('marks_master.marks_master' =>$marksmasterID );
			
			$this->db->where($upd_where);
            $this->db->update('marks_master',$insert_marks_master_data);
			echo $this->db->last_query();
			
			
			$insert_where = array(
				"masterID" => $marksmasterID,
				"From" => "ExamPaper",
			);
			
			if($is_file_uploaded=="Y")
			{

				$detail_insert = $this->insertIntoUploadFile($data,$sesion_data,$insert_where);
			}
			
			$insert_user_activity = array(
				"activity_date" => date('Y-m-d'),  
				"activity_module" => 'Exam',
				
				"action" => "Insert",
				"from_method" => "exam/saveExamMarks",
				"user_id" => $sesion_data['userid'],
				
				"ip_address" => getUserIPAddress(),
				"user_browser" => getUserBrowserName(),
				"user_platform" => getUserPlatform()
			);
			
			$user_activity = $this->db->insert('user_activity_report', $insert_user_activity);
		    #echo $this->db->last_query();
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

/**/
public function updatePaperUpload($marksmasterID,$data,$sesion_data)
	{
		try
		{
        	$this->db->trans_begin();
			$insert_trainer_data = array();
			$insert_user_activity = array();
			$is_file_uploaded = "N";
			if(isset($data['docFile']['fileName']))
			{
				if(sizeof($data['docFile']['fileName']['name'])>0)
				{
					$is_file_uploaded = "Y";
				}
				else
				{
					$is_file_uploaded = "N";
				}
			}
			$upd_where = array("marks_master.marks_master_id" => $data['marksmasterID']);

				$insert_student_data = array(
				'is_file_uploaded' => $is_file_uploaded,  
				);

			
			$this->db->where($upd_where);
            $this->db->update('marks_master',$insert_student_data);

			$insert_where = array(
				"masterID" => $data['marksmasterID'],
				"From" => "ExamPaper",
			);
			
			if($is_file_uploaded=="Y")
			{
				$detail_insert = $this->insertIntoUploadFile($data,$sesion_data,$insert_where);
			}else{

				/* if delete all uploaded file for testing 08.10.2018*/
				if($data['mode']=="Edit" && $data['marksmasterID']>0)
					{

						$where_paper = array(
							"uploaded_exam_papers.upload_from_module_id" => $data['marksmasterID'],
							"uploaded_exam_papers.upload_from_module" => 'ExamPaper'
							);

							$this->db->where($where_paper);
							$this->db->delete('uploaded_exam_papers'); 
							#q();
					}

			}
			
			$insert_user_activity = array(
				"activity_date" => date('Y-m-d'),  
				"activity_module" => 'Exam',
				
				"action" => "Update",
				"from_method" => "exam/saveScanExamPaper",
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


/**/
public function insertIntoUploadFile($data,$session_data,$where_data)
	{ 
		if($data['mode']=="Edit" && $data['marksmasterID']>0)
		{

			$where_marks = array(
				"uploaded_exam_papers.upload_from_module_id" => $data['marksmasterID'],
				"uploaded_exam_papers.upload_from_module" => $where_data['From']
				);

				$this->db->where($where_marks);
				$this->db->delete('uploaded_exam_papers'); 

		}

		

		$dir1 = $_SERVER['DOCUMENT_ROOT'].'/application/assets/ds-documents/exam_papers_upload'; //server

		//$dir1 = $_SERVER['DOCUMENT_ROOT'].'/sishubharati/application/assets/ds-documents/exam_papers_upload'; //local
		
		//echo "<br>";
		//echo "Document ROOT : ". $dir ='http://prosikshan.in/images';
		//exit;
		
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
					"upload_from_module" => "ExamPaper",
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
					"upload_from_module" => "ExamPaper",
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
