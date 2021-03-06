<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class studentdashboardmodel extends CI_Model{
    
	// getStudentAttendanceByMonth 
	// Count total no of days present in validity period month wise	
	public function getStudentAttendanceByMonth($studentId,$academicid)
	{
		$data = array();
		$sql = "SELECT COUNT(*) AS totalpresentDys,
 				DATE_FORMAT(attendance_details.taken_date,'%b') AS month_info,
 				DATE_FORMAT(attendance_details.taken_date, '%y') AS year_info,
                DATE_FORMAT(attendance_details.taken_date,'%Y' ) AS full_year_info 
				FROM `attendance_details` 
				WHERE attendance_details.student_uniq_id = '".$studentId."' 
				AND attendance_details.`academic_id`='".$academicid."' 
				AND attendance_details.`attendance_status`='P'
				GROUP BY DATE_FORMAT( attendance_details.taken_date,'%Y%m' )";
		
		$query = $this->db->query($sql);

		if($query->num_rows()>0)
			{
				foreach($query->result() as $rows):
					$data[] = array(
						"totalpresentDys" => $rows->totalpresentDys,
						"month_info" => $rows->month_info,
						"year_info" => $rows->year_info,
						"full_year" => $rows->full_year_info
					); 
				endforeach;
			}
			return $data;
		
	}



	// Fetch detail record of single month
	public function getStudentAttendanceDetailByMonthAndYear($studentId,$academicid,$month,$year)
	{
		$data = array();
		$sql = "SELECT *
					FROM `attendance_details` WHERE attendance_details.student_uniq_id = '".$studentId."' 
				AND attendance_details.`academic_id`='".$academicid."'
					AND DATE_FORMAT(attendance_details.taken_date,'%b')='".$month."' AND DATE_FORMAT(attendance_details.taken_date,'%Y')=".$year;
		
		$query = $this->db->query($sql);
		#q();
		if($query->num_rows()>0)
			{
				foreach($query->result() as $rows):
					$data[] = array(
						
						"attendance_status" => $rows->attendance_status,
						"att_date" => $rows->taken_date
						
					); 
				endforeach;
			}
			return $data;
		
	}


/* academic details*/

/*--------------------------------------------------*/
		public function getStudentAcademicDetailsbyId($academicid){

			$where = array('student_academic_details.academic_id' =>$academicid);
		
			$data = [];
			$query = $this->db->select("
								student_academic_details.*,
								class_master.name as class_name,
								session_year.year
								
								")
					->from('student_academic_details')
					->join('student_master','student_master.student_uniq_id=student_academic_details.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					->join('session_year','session_year.session_id = student_academic_details.session_id','INNER')

					->where($where)
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

public function getUploadedExamPapers($moduleID,$moduleTag)
	{
		$detailData = array();
		$where = array(
			"uploaded_exam_papers.upload_from_module_id" => $moduleID,
			"uploaded_exam_papers.upload_from_module" => $moduleTag
		);

		$this->db->select("*")
				->from('uploaded_exam_papers')
				->join('documents_upload_type','documents_upload_type.id = uploaded_exam_papers.document_type_id','INNER')
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


/* message list details*/

/*--------------------------------------------------*/
		public function getMessageByStudentID($student_uniq_id){

			$where = array('message.student_uniq_id' =>$student_uniq_id);
		
			$data = [];
			$query = $this->db->select("*")
					->from('message')
					->where($where);

					$query = $this->db->get();
				#q();
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

	/* highest marks 02.12.2018*/

	public function getHighestMarks($classid,$subjectid,$term,$sessionid){
		$data = "";
		
		$sql="SELECT MAX(marks_details.obtain_total_marks) AS highest
			FROM marks_details
			WHERE marks_details.term='".$term."'
			AND marks_details.class_id='".$classid."'
			AND marks_details.subject_id='".$subjectid."'
			AND marks_details.session_id='".$sessionid."'";
		
		$query = $this->db->query($sql);
		
			#echo $this->db->last_query();
		
		
			
			if($query->num_rows()> 0)
			{
                 $row = $query->row();
          
					$data = $row->highest;
				
	             
                        }
			
	        return $data;
	       
	}


	/*--------------------------------------------------*/
		public function getStudentOldClass($studentID,$academicID){

			$where = array(
							'student_academic_details.student_uniq_id' => $studentID,
							'student_academic_details.is_active' => 'Y',
						);
		
			$data = [];
			$query = $this->db->select("
								session_year.session_id,
								session_year.year,
								class_master.name,
								student_academic_details.academic_id
								")
					->from('student_academic_details')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					->join('session_year','session_year.session_id = student_academic_details.session_id','INNER')
					->where($where)
					->where_not_in('student_academic_details.academic_id',$academicID);

					$query = $this->db->get();
				#q();
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


		/* get all Notice List*/

	public function getAllNoticeList(){
		$data = [];
		$where = array(
						'uploaded_documents_all.upload_from_module' =>'Notice',
						'notice.is_active' =>'1'
						 );
		$query = $this->db->select("notice.*,
									uploaded_documents_all.random_file_name,
									uploaded_documents_all.id as docid
									")
				->from('notice')
				->join('uploaded_documents_all','uploaded_documents_all.upload_from_module_id = notice.notice_id','INNER')
				->where($where)
				->order_by('notice.notice_id','desc')
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



	/* get all Information List*/

	public function getAllInfoList(){
		$data = [];
		$where = array(
						'uploaded_documents_all.upload_from_module' =>'ImpotrtantInfo',
						'important_info.is_active' =>'1'
						 );
		$query = $this->db->select("important_info.*,
									uploaded_documents_all.random_file_name,
									uploaded_documents_all.id as docid
									")
				->from('important_info')
				->join('uploaded_documents_all','uploaded_documents_all.upload_from_module_id = important_info.info_id','INNER')
				->where($where)
				->order_by('important_info.info_id','desc')
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



/* get all atcive events List*/

	public function getAllActiveEventsList(){
		$data = [];
		$where = array(
						'uploaded_documents_all.upload_from_module' =>'Events',
						'events.is_active' =>1
						 );
		$query = $this->db->select("events.*,
									uploaded_documents_all.random_file_name,
									uploaded_documents_all.id as docid
									")
				->from('events')
				->join('uploaded_documents_all','uploaded_documents_all.upload_from_module_id = events.events_id','INNER')
				->where($where)
				->order_by('events.events_id')
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

}// end of class