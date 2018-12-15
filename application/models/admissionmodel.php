<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class admissionmodel extends CI_Model{

	public function getAllStudentsbyYear($session_id)
	{
	
		$data = array();
		$where = array(
			           'student_academic_details.session_id' => $session_id,
			           'student_academic_details.is_active' => 'Y'

			             );
		
			$query = $this->db->select("
										student_master.*,
										class_master.name as class_name,
										student_academic_details.class_roll
										")
					->from('student_master')
					
					->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					->where($where)
					->get();

		#echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = array(
					"studentMasterData" => $rows,
					"studentUploadedDocsData" => $this->getStudentUploadedDocuments($rows->student_id,"Admission")
				); 
				
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

/* Get all student by class*/

public function getAllStudentsbyClass($session_id,$sel_class)
	{
	
		$data = array();
		$where = array(
						'student_academic_details.session_id' => $session_id, 
						'student_academic_details.class_id' => $sel_class,
						'student_academic_details.is_active' =>'Y' 
					  );
		
			$query = $this->db->select("
										student_master.*,
										class_master.name as class_name,
										student_academic_details.class_roll
										")
					->from('student_master')
					
					->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					->where($where)
					->get();

		#echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
				
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}




/*--------------------------------------------------*/
		public function getStudentDetailsbyId($where){
		
			$data = [];
			$query = $this->db->select("
								student_master.*,
								student_academic_details.class_roll
								")
					->from('student_master')
					->join('student_academic_details','student_academic_details.student_uniq_id=student_master.student_uniq_id','INNER')

					->where($where)
				    ->order_by('student_master.student_id')
				    ->limit(1);
					$query = $this->db->get();
				#q();
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


		public function getStudentAdmissionInformationbyId($where){
		
			$data = [];
			$query = $this->db->select("student_master.*,
										amcl.name as admission_class,
										cucl.name as current_class,
										student_academic_details.class_roll,
										category_master.category as student_category,
										blood_group.blood_group as student_blood_group,
										district.name as student_district,
										father_edu.qualification_type as father_education,
										mother_edu.qualification_type as mother_education,
										father_occ.occupation_type as father_occu,
										mother_occ.occupation_type as mother_occu
										")
					->from('student_master')
					->join('student_academic_details','student_academic_details.student_uniq_id=student_master.student_uniq_id','INNER')
					->join('class_master as amcl','amcl.id=student_master.class_id','INNER')
					->join('class_master as cucl','cucl.id=student_academic_details.class_id','INNER')
					->join('category_master','category_master.id=student_master.category','INNER')
					->join('blood_group','blood_group.id=student_master.blood_group','INNER')
					->join('district','district.id=student_master.distric_id','INNER')
					->join('qualification_master as father_edu','father_edu.qualification_id=student_master.father_edu','LEFT')
					->join('qualification_master as mother_edu','mother_edu.qualification_id=student_master.mother_edu','LEFT')
					->join('occupation_master as father_occ','father_occ.occupation_id=student_master.father_occupation','LEFT')

					->join('occupation_master as mother_occ','mother_occ.occupation_id=student_master.mother_occupation','LEFT')

					->where($where)
				    ->order_by('student_master.student_id')
				    ->limit(1);
					$query = $this->db->get();
				#q();
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

		public function getClassListByAdmType($admtypeid){
			$where = array('class_master.admisson_type_id' => $admtypeid );
			$data = [];
			$query = $this->db->select("*")
					->from('class_master')
					->where($where)
				    ->order_by('class_master.id')
					->get();
				
				if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
		             
		        }
				
		        return $data;
	       
		
	}

		public function getLastClassRoll($classid,$session_id){
			$where = array(
							'student_academic_details.class_id' => $classid,
							'student_academic_details.session_id' => $session_id
							 );
			$data = [];
			$query = $this->db->select("*")
					->from('student_academic_details')
					->where($where)
				    ->order_by('student_academic_details.academic_id','desc')
				    ->limit(1)
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

public function getLatestSerialNumber($from){
        $lastnumber = (int)(0);
        $serialno="";
        $sql="SELECT *
            FROM serial_master
            WHERE serial_master.type='".$from."'
			LOCK IN SHARE MODE";
        $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			  $row = $query->row(); 
			  $lastnumber = $row->next_serial_no;
        }
        $digit = (int)(log($lastnumber,10)+1) ; 
      
       
        if($digit==5){
            $serialno ="0".$lastnumber;
        }
		elseif($digit==4){
              $serialno = "00".$lastnumber;
        }
		elseif($digit==3){
            $serialno = "000".$lastnumber;
        }
		elseif($digit==2){
            $serialno = "0000".$lastnumber;
        }
		elseif($digit==1){
            $serialno = "00000".$lastnumber;
        }
        $lastnumber = $lastnumber + 1;
        
        //update
        $upddata = [
			'serial_master.next_serial_no' => $lastnumber,
        ];
        $where = [
			'serial_master.type' => $from
			];
        $this->db->where($where); 
        $this->db->update('serial_master', $upddata);
        return $serialno;
    }

	public function inserIntoStudent($data,$sesion_data)
	{
		try
		{
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
             $latest_serial = $this->getLatestSerialNumber("REG"); //it will change
			 $studentUniqID = "PSB".$latest_serial;

			 $insert_into_academic = array(
			 	'student_uniq_id' => $studentUniqID, 
			 	'class_id' => $data['class_id'], 
			 	'class_roll' => $data['classroll'], 
			 	'rank' => $data['classroll'], 
			 	'session_id' => $sesion_data['yid'], 
			 	 
			 	'created_by' => $sesion_data['userid'] 
			 );

			$academic_insert = $this->db->insert('student_academic_details', $insert_into_academic);
			#echo $this->db->last_query();
			$academic_insert_ID = $this->db->insert_id();

			$insert_student_data = array(
				'student_uniq_id' => $studentUniqID,  
				'admission_type' => $data['admission_type'],  
				'class_id' => $data['class_id'],  
				'admission_dt' => $data['admission_dt'],  
				'name' => $data['name'],  
				'gender' => $data['gender'],  
				'date_of_birth' => $data['date_of_birth'],  
				'category' => $data['category'],  
				'blood_group' => $data['blood_group'],  
				'previous_school' => $data['previous_school'],  
				'father_name' => $data['father_name'],  
				'father_edu' => $data['father_edu'],  
				'father_occupation' => $data['father_occupation'],  
				'father_mobile' => $data['father_mobile'], 
				'mother_name' => $data['mother_name'],  
				'mother_edu' => $data['mother_edu'],  
				'mother_occupation' => $data['mother_occupation'],  
				'mother_mobile' => $data['mother_mobile'],   
				'distric_id' => $data['distric_id'],   
				'village' => $data['village'],   
				'police_station' => $data['police_station'],   
				'pincode' => $data['pincode'],   
				'address' => $data['address'],   
				'email' => $data['email'],   
				'aadhar_id' => $data['aadhar_id'],   
				'ration_id' => $data['ration_id'],   
				'entry_class' => $data['entrycls'], 
				'frm_slno' => $data['frmslno'], 
				'is_file_uploaded' => $is_file_uploaded,  
				'academic_master_id' => $academic_insert_ID,  
				'created_by' => $sesion_data['userid'],  
				'is_active' => 1,  
				'password' => $data['date_of_birth']  
			);
			
			$student_insert = $this->db->insert('student_master', $insert_student_data);
			#echo $this->db->last_query();
			$student_insert_ID = $this->db->insert_id();
			
			#$student_insert_ID = 100;
			
			$insert_where = array(
				"masterID" => $student_insert_ID,
				"From" => "Admission",
			);
			
			if($is_file_uploaded=="Y")
			{

				$detail_insert = $this->insertIntoUploadFile($data,$sesion_data,$insert_where);
			}
			
			$insert_user_activity = array(
				"activity_date" => date('Y-m-d'),  
				"activity_module" => 'Admission',
				
				"action" => "Insert",
				"from_method" => "admission/saveStudent",
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

	public function updateStudent($data,$sesion_data)
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
			$upd_where = array("student_master.student_id" => $data['studentID']);

				$insert_student_data = array(
				
				
				'admission_dt' => $data['admission_dt'],  
				'name' => $data['name'],  
				'gender' => $data['gender'],  
				'date_of_birth' => $data['date_of_birth'],  
				'category' => $data['category'],  
				'blood_group' => $data['blood_group'],  
				'previous_school' => $data['previous_school'],  
				'father_name' => $data['father_name'],  
				'father_edu' => $data['father_edu'],  
				'father_occupation' => $data['father_occupation'],  
				'father_mobile' => $data['father_mobile'], 
				'mother_name' => $data['mother_name'],  
				'mother_edu' => $data['mother_edu'],  
				'mother_occupation' => $data['mother_occupation'],  
				'mother_mobile' => $data['mother_mobile'],   
				'distric_id' => $data['distric_id'],   
				'village' => $data['village'],   
				'police_station' => $data['police_station'],   
				'pincode' => $data['pincode'],   
				'address' => $data['address'],   
				'email' => $data['email'],   
				'aadhar_id' => $data['aadhar_id'],   
				'ration_id' => $data['ration_id'],   
				'entry_class' => $data['entrycls'], 
				'frm_slno' => $data['frmslno'],   
				
				'is_file_uploaded' => $is_file_uploaded,  
				 
				'created_by' => $sesion_data['userid'],  
				'is_active' => 1
				
			);

			
			$this->db->where($upd_where);
            $this->db->update('student_master',$insert_student_data);

			$insert_where = array(
				"masterID" => $data['studentID'],
				"From" => "Admission",
			);
			
			if($is_file_uploaded=="Y")
			{
				$detail_insert = $this->insertIntoUploadFile($data,$sesion_data,$insert_where);
			}else{

				/* if delete all uploaded file for testing 08.10.2018*/
				if($data['mode']=="EDIT" && $data['studentID']>0)
					{

						$where_student = array(
							"uploaded_documents_all.upload_from_module_id" => $data['studentID'],
							"uploaded_documents_all.upload_from_module" => 'Admission'
							);

							$this->db->where($where_student);
							$this->db->delete('uploaded_documents_all'); 
							#q();
					}

			}
			
			$insert_user_activity = array(
				"activity_date" => date('Y-m-d'),  
				"activity_module" => 'Admission',
				
				"action" => "Update",
				"from_method" => "admission/saveStudent",
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
		if($data['mode']=="EDIT" && $data['studentID']>0)
		{

			$where_student = array(
				"uploaded_documents_all.upload_from_module_id" => $data['studentID'],
				"uploaded_documents_all.upload_from_module" => $where_data['From']
				);

				$this->db->where($where_student);
				$this->db->delete('uploaded_documents_all'); 

		}

		//$dir = APPPATH . 'assets/document/trainerUpload/'; //FCPATH . '/posts';
		//$dir = APPPATH . 'assets/application_extension/';
		//$dir1 = $_SERVER['DOCUMENT_ROOT'].'/img';

		$dir1 = $_SERVER['DOCUMENT_ROOT'].'/application/assets/ds-documents/admission_upload'; //server

		//$dir1 = $_SERVER['DOCUMENT_ROOT'].'/sishubharati/application/assets/ds-documents/admission_upload'; //local
		
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
					"upload_from_module" => "Admission",
					"upload_from_module_id" => $where_data['masterID'],
					"upload_srl_no" => $srl_no++,
					
					"uploaded_by_user" => $session_data['userid'],
					"is_active" => 'Y'
				); 

             	$this->db->insert('uploaded_documents_all',$detail_array);	
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
					"upload_from_module" => "Admission",
					"upload_from_module_id" => $where_data['masterID'],
					"upload_srl_no" => $srl_no++,
					
					"uploaded_by_user" => $session_data['userid'],
					"is_active" => 'Y'
				); 

				$this->db->insert('uploaded_documents_all',$detail_array_edit);
				#echo $this->db->last_query();	
			}
        }

	}


		/* -------------------------------
	*	getStudentUploadedDocuments(studentid)
	* --------------------------------
	*/


	public function getStudentUploadedDocuments($moduleID,$moduleTag)
	{
		$detailData = array();
		$where = array(
			"uploaded_documents_all.upload_from_module_id" => $moduleID,
			"uploaded_documents_all.upload_from_module" => $moduleTag
		);

		$this->db->select("*")
				->from('uploaded_documents_all')
				->join('documents_upload_type','documents_upload_type.id = uploaded_documents_all.document_type_id','INNER')
				->where($where);

		$query = $this->db->get();
		#echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$detailData[] = $rows;
				
            }
            return $detailData;
        }
		else
		{
             return $detailData;
        }
	}


	/* -------------------------------
	*	getStudentProfilePicture(studentid)
	* --------------------------------
	*/


	public function getStudentProfilePicture($moduleID,$moduleTag)
	{
		$detailData = array();
		$where = array(
			"uploaded_documents_all.upload_from_module_id" => $moduleID,
			"uploaded_documents_all.upload_from_module" => $moduleTag,
			"uploaded_documents_all.document_type_id" => 1
		);

		$this->db->select("*")
				->from('uploaded_documents_all')
				->join('documents_upload_type','documents_upload_type.id = uploaded_documents_all.document_type_id','INNER')
				->where($where)
				->order_by("uploaded_documents_all.id", "desc")
				->limit(1); 

		$query = $this->db->get();
		#echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
           
				foreach ($query->result() as $rows)
			{
				$detailData = $rows;
				
            }
				
           
            return $detailData;
        }
		else
		{
             return $detailData;
        }
	}

}//end of class